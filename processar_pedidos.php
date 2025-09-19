<?php
include 'config.php';

// Verificar se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Sanitizar dados do cliente
        $nome_completo = sanitizar($_POST['customerName']);
        $telefone = sanitizar($_POST['customerPhone']);
        $email = sanitizar($_POST['customerEmail']);
        $endereco_entrega = sanitizar($_POST['deliveryAddress']);
        $forma_pagamento = sanitizar($_POST['paymentMethod']);
        $observacoes = sanitizar($_POST['orderNotes']);

        // Pegar itens do carrinho (JSON)
        $cart_items = isset($_POST['cart_items']) ? json_decode($_POST['cart_items'], true) : [];
        $total = 0;

        // Calcular total
        foreach ($cart_items as $item) {
            $preco = converterPreco($item['price']);
            $quantidade = intval($item['quantity']);
            $total += $preco * $quantidade;
        }

        // Iniciar transação
        $pdo->beginTransaction();

        // Inserir ou buscar cliente
        $stmt = $pdo->prepare("SELECT id FROM clientes WHERE telefone = ? LIMIT 1");
        $stmt->execute([$telefone]);
        $cliente = $stmt->fetch();

        if ($cliente) {
            $cliente_id = $cliente['id'];
            // Atualizar dados do cliente existente
            $stmt = $pdo->prepare("UPDATE clientes SET nome_completo = ?, email = ? WHERE id = ?");
            $stmt->execute([$nome_completo, $email, $cliente_id]);
        } else {
            // Inserir novo cliente
            $stmt = $pdo->prepare("INSERT INTO clientes (nome_completo, telefone, email) VALUES (?, ?, ?)");
            $stmt->execute([$nome_completo, $telefone, $email]);
            $cliente_id = $pdo->lastInsertId();
        }

        // Inserir pedido
        $stmt = $pdo->prepare("INSERT INTO pedidos (cliente_id, endereco_entrega, forma_pagamento, observacoes, total) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$cliente_id, $endereco_entrega, $forma_pagamento, $observacoes, $total]);
        $pedido_id = $pdo->lastInsertId();

        // Inserir itens do pedido
        foreach ($cart_items as $item) {
            $nome_pizza = sanitizar($item['name']);
            $preco = converterPreco($item['price']);
            $quantidade = intval($item['quantity']);
            $subtotal = $preco * $quantidade;

            $stmt = $pdo->prepare("INSERT INTO itens_pedido (pedido_id, nome_pizza, preco, quantidade, subtotal) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$pedido_id, $nome_pizza, $preco, $quantidade, $subtotal]);
        }

        // Confirmar transação
        $pdo->commit();

        // Resposta de sucesso
        $response = [
            'success' => true,
            'message' => 'Pedido realizado com sucesso!',
            'pedido_id' => $pedido_id,
            'total' => number_format($total, 2, ',', '.')
        ];

    } catch (Exception $e) {
        // Reverter transação em caso de erro
        $pdo->rollback();
        $response = [
            'success' => false,
            'message' => 'Erro ao processar pedido: ' . $e->getMessage()
        ];
    }

    // Retornar resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Redirecionar se acessado diretamente
    header('Location: index.php');
    exit();
}
?>
<?php
include 'config.php';

$pedido_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($pedido_id <= 0) {
    die("ID do pedido inválido");
}

try {
    // Buscar dados do pedido e cliente
    $stmt = $pdo->prepare("
        SELECT 
            p.*,
            c.nome_completo,
            c.telefone,
            c.email
        FROM pedidos p 
        JOIN clientes c ON p.cliente_id = c.id 
        WHERE p.id = ?
    ");
    $stmt->execute([$pedido_id]);
    $pedido = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$pedido) {
        die("Pedido não encontrado");
    }
    
    // Buscar itens do pedido
    $stmt = $pdo->prepare("SELECT * FROM itens_pedido WHERE pedido_id = ?");
    $stmt->execute([$pedido_id]);
    $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (Exception $e) {
    die("Erro ao buscar pedido: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido #<?php echo $pedido['id']; ?> - Pizzaria Primicia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #c41e3a;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .pedido-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        .info-section {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }
        .info-section h3 {
            color: #c41e3a;
            margin-top: 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .itens-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .itens-table th {
            background: #c41e3a;
            color: white;
            padding: 12px;
            text-align: left;
        }
        .itens-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        .total-row {
            background: #f0f0f0;
            font-weight: bold;
        }
        .status {
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
            margin-top: 10px;
        }
        .status-pendente { background: #fff3cd; color: #856404; }
        .status-preparando { background: #cce5ff; color: #004085; }
        .status-entrega { background: #d4edda; color: #155724; }
        .status-finalizado { background: #d1ecf1; color: #0c5460; }
        .status-cancelado { background: #f8d7da; color: #721c24; }
        .print-btn {
            background: #2e7d32;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 20px 10px 0 0;
        }
        .print-btn:hover {
            background: #1b5e20;
        }
        @media print {
            body { background: white; }
            .print-btn { display: none; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pizzaria Primicia</h1>
            <h2>Detalhes do Pedido #<?php echo $pedido['id']; ?></h2>
            <p><strong>Data:</strong> <?php echo date('d/m/Y H:i:s', strtotime($pedido['created_at'])); ?></p>
            <div class="status status-<?php echo strtolower($pedido['status']); ?>">
                <?php echo $pedido['status']; ?>
            </div>
        </div>

        <div class="pedido-info">
            <div class="info-section">
                <h3>Dados do Cliente</h3>
                <p><strong>Nome:</strong> <?php echo htmlspecialchars($pedido['nome_completo']); ?></p>
                <p><strong>Telefone:</strong> <?php echo htmlspecialchars($pedido['telefone']); ?></p>
                <p><strong>E-mail:</strong> <?php echo htmlspecialchars($pedido['email'] ?? 'Não informado'); ?></p>
            </div>

            <div class="info-section">
                <h3>Dados de Entrega</h3>
                <p><strong>Endereço:</strong><br><?php echo nl2br(htmlspecialchars($pedido['endereco_entrega'])); ?></p>
                <p><strong>Forma de Pagamento:</strong> <?php echo ucfirst(str_replace('-', ' ', $pedido['forma_pagamento'])); ?></p>
            </div>
        </div>

        <?php if ($pedido['observacoes']): ?>
        <div class="info-section">
            <h3>Observações Especiais</h3>
            <p><?php echo nl2br(htmlspecialchars($pedido['observacoes'])); ?></p>
        </div>
        <?php endif; ?>

        <h3>Itens do Pedido</h3>
        <table class="itens-table">
            <thead>
                <tr>
                    <th>Pizza</th>
                    <th>Preço Unit.</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($itens as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['nome_pizza']); ?></td>
                    <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                    <td><?php echo $item['quantidade']; ?></td>
                    <td>R$ <?php echo number_format($item['subtotal'], 2, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="3"><strong>TOTAL GERAL</strong></td>
                    <td><strong>R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <button onclick="window.print()" class="print-btn">Imprimir Pedido</button>
        <button onclick="window.close()" class="print-btn" style="background: #666;">Fechar</button>
    </div>
</body>
</html>
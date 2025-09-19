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
    <link rel="stylesheet" href="style.css">
    <style>
        .order-container {
            max-width: 1000px;
            margin: 100px auto 50px;
            padding: 0 20px;
        }
        
        .order-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--accent-gold);
        }
        
        .order-status {
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
            margin-top: 15px;
            font-size: 0.9rem;
        }
        
        .order-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .info-card {
            background: var(--pure-white);
            padding: 25px;
            border-radius: 8px;
            box-shadow: var(--shadow-light);
            border: 1px solid var(--medium-gray);
        }
        
        .info-card h3 {
            color: var(--accent-gold);
            margin-top: 0;
            margin-bottom: 20px;
            font-family: "Source Serif Pro", serif;
            border-bottom: 1px solid var(--medium-gray);
            padding-bottom: 10px;
        }
        
        .info-item {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
        
        .info-value {
            color: var(--text-secondary);
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            background: var(--pure-white);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
        }
        
        .items-table th {
            background: var(--accent-gold);
            color: var(--primary-dark);
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        
        .items-table td {
            padding: 15px;
            border-bottom: 1px solid var(--medium-gray);
        }
        
        .total-row {
            background: var(--light-gray);
            font-weight: bold;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        
        .action-btn {
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background: var(--primary-dark);
            color: var(--pure-white);
        }
        
        .btn-primary:hover {
            background: var(--accent-gold);
            color: var(--primary-dark);
        }
        
        .btn-secondary {
            background: var(--medium-gray);
            color: var(--text-primary);
        }
        
        .btn-secondary:hover {
            background: var(--dark-gray);
            color: var(--pure-white);
        }
        
        @media (max-width: 768px) {
            .order-info-grid {
                grid-template-columns: 1fr;
            }
            
            .order-container {
                margin-top: 80px;
            }
        }
    </style>
</head>
<body>
    <header id="header">
        <nav>
            <a href="index.php" class="logo">
                <img src="img/logo.png" alt="Logo Pizzaria Primicia" style="height: 60px" />
            </a>
            <ul class="nav-links">
                <li><a href="index.php">Voltar ao Site</a></li>
            </ul>
        </nav>
    </header>

    <div class="order-container">
        <div class="order-header">
            <h1 class="serif">Pizzaria Primicia</h1>
            <h2>Detalhes do Seu Pedido #<?php echo $pedido['id']; ?></h2>
            <p>Data: <?php echo date('d/m/Y H:i:s', strtotime($pedido['created_at'])); ?></p>
            <div class="order-status" style="
                background: 
                <?php 
                    switch($pedido['status']) {
                        case 'Pendente': echo '#fff3cd'; break;
                        case 'Preparando': echo '#cce5ff'; break;
                        case 'Entrega': echo '#d4edda'; break;
                        case 'Finalizado': echo '#d1ecf1'; break;
                        case 'Cancelado': echo '#f8d7da'; break;
                        default: echo '#f0f0f0';
                    }
                ?>; 
                color: 
                <?php 
                    switch($pedido['status']) {
                        case 'Pendente': echo '#856404'; break;
                        case 'Preparando': echo '#004085'; break;
                        case 'Entrega': echo '#155724'; break;
                        case 'Finalizado': echo '#0c5460'; break;
                        case 'Cancelado': echo '#721c24'; break;
                        default: echo '#333';
                    }
                ?>;">
                <?php echo $pedido['status']; ?>
            </div>
        </div>

        <div class="order-info-grid">
            <div class="info-card">
                <h3><i class="fa-solid fa-user"></i> Dados do Cliente</h3>
                <div class="info-item">
                    <span class="info-label">Nome</span>
                    <span class="info-value"><?php echo htmlspecialchars($pedido['nome_completo']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Telefone</span>
                    <span class="info-value"><?php echo htmlspecialchars($pedido['telefone']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">E-mail</span>
                    <span class="info-value"><?php echo htmlspecialchars($pedido['email'] ?? 'Não informado'); ?></span>
                </div>
            </div>

            <div class="info-card">
                <h3><i class="fa-solid fa-truck"></i> Dados de Entrega</h3>
                <div class="info-item">
                    <span class="info-label">Endereço</span>
                    <span class="info-value"><?php echo nl2br(htmlspecialchars($pedido['endereco_entrega'])); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Forma de Pagamento</span>
                    <span class="info-value"><?php echo ucfirst(str_replace('-', ' ', $pedido['forma_pagamento'])); ?></span>
                </div>
                <?php if ($pedido['observacoes']): ?>
                <div class="info-item">
                    <span class="info-label">Observações</span>
                    <span class="info-value"><?php echo nl2br(htmlspecialchars($pedido['observacoes'])); ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <h3 class="serif"><i class="fa-solid fa-pizza-slice"></i> Itens do Pedido</h3>
        <table class="items-table">
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

        <div class="action-buttons">
            <button onclick="window.print()" class="action-btn btn-primary">
                <i class="fa-solid fa-print"></i> Imprimir Pedido
            </button>
            <a href="index.php" class="action-btn btn-secondary">
                <i class="fa-solid fa-home"></i> Voltar para o Início
            </a>
        </div>
    </div>

    <script>
        // Header scroll effect
        window.addEventListener("scroll", function () {
            const header = document.getElementById("header");
            if (window.scrollY > 50) {
                header.classList.add("scrolled");
            } else {
                header.classList.remove("scrolled");
            }
        });
    </script>
</body>
</html>
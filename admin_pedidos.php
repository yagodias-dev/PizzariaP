<?php
include 'config.php';
session_start();

// Buscar todos os pedidos com informações do cliente
try {
    $stmt = $pdo->query("
        SELECT 
            p.id as pedido_id,
            p.total,
            p.status,
            p.forma_pagamento,
            p.endereco_entrega,
            p.observacoes,
            p.created_at,
            c.nome_completo,
            c.telefone,
            c.email
        FROM pedidos p 
        JOIN clientes c ON p.cliente_id = c.id 
        ORDER BY p.created_at DESC
    ");
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Erro ao buscar pedidos: " . $e->getMessage());
}

// Atualizar status do pedido
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $pedido_id = intval($_POST['pedido_id']);
    $novo_status = sanitizar($_POST['status']);
    
    try {
        $stmt = $pdo->prepare("UPDATE pedidos SET status = ? WHERE id = ?");
        $stmt->execute([$novo_status, $pedido_id]);
        header('Location: admin_pedidos.php?msg=Status atualizado com sucesso');
        exit();
    } catch (Exception $e) {
        $error = "Erro ao atualizar status: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Pizzaria Primicia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-container {
            max-width: 1800px;
            margin: 120px auto 50px;
            padding: 0 20px;
        }
        .admin-header {
            text-align: center;
            margin-bottom: 40px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-light);
        }
        
        /* Cards em vez de tabela */
        .pedidos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .pedido-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow-medium);
            border: 1px solid var(--medium-gray);
            transition: var(--transition);
        }
        
        .pedido-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-heavy);
        }
        
        .pedido-header {
            display: flex;
            justify-content: space-between; /* Alterado para space-between */
            align-items: flex-start; /* Alterado para flex-start */
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
            gap: 20px; /* Adicionado espaçamento */
        }
        
        .pedido-info-left {
            flex: 1;
        }
        
        .pedido-info-right {
            flex-shrink: 0;
        }
        
        .pedido-numero {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 5px; /* Adicionado espaçamento */
        }
        
        .pedido-data {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }
        
        .pedido-status {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            display: inline-block;
            margin-top: 5px; /* Adicionado espaçamento */
        }
        
        .status-pendente { background: #fff3cd; color: #856404; }
        .status-preparando { background: #cce5ff; color: #004085; }
        .status-entrega { background: #d4edda; color: #155724; }
        .status-finalizado { background: #d1ecf1; color: #0c5460; }
        .status-cancelado { background: #f8d7da; color: #721c24; }
        
        .pedido-info {
            margin-bottom: 15px;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 8px;
            align-items: flex-start;
        }
        
        .info-label {
            font-weight: 600;
            color: var(--text-primary);
            min-width: 120px;
            font-size: 0.9rem;
        }
        
        .info-value {
            color: var(--text-secondary);
            flex: 1;
            font-size: 0.9rem;
        }
        
        .pedido-total {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            text-align: right;
            margin: 15px 0;
            padding-top: 15px;
            border-top: 2px solid var(--light-gray);
        }
        
        .pedido-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .action-select {
            flex: 1;
            padding: 10px;
            border: 1px solid var(--medium-gray);
            border-radius: 6px;
            font-size: 0.9rem;
            min-width: 150px;
        }
        
        .action-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-update {
            background: var(--accent-gold);
            color: var(--primary-dark);
        }
        
        .btn-update:hover {
            background: var(--accent-gold-dark);
            transform: translateY(-2px);
        }
        
        .btn-details {
            background: var(--primary-dark);
            color: white;
        }
        
        .btn-details:hover {
            background: #2c3e50;
            transform: translateY(-2px);
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        
        /* Responsividade */
        @media (max-width: 1200px) {
            .pedidos-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .admin-container {
                margin: 100px auto 20px;
                padding: 0 15px;
            }
            
            .pedido-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .info-row {
                flex-direction: column;
                gap: 5px;
            }
            
            .info-label {
                min-width: auto;
            }
            
            .pedido-actions {
                flex-direction: column;
            }
            
            .pedido-status {
                align-self: flex-start;
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
                <li><a href="admin_pedidos.php">Pedidos</a></li>
            </ul>
        </nav>
    </header>

    <div class="admin-container">
        <div class="admin-header">
            <h1 class="serif">Administração - Pedidos</h1>
            <p>Gerencie todos os pedidos da pizzaria</p>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert"><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert error"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="pedidos-grid">
            <?php foreach ($pedidos as $pedido): ?>
            <div class="pedido-card">
                <div class="pedido-header">
                    <div class="pedido-info-left">
                        <div class="pedido-numero">Pedido #<?php echo $pedido['pedido_id']; ?></div>
                        <div class="pedido-data"><?php echo date('d/m/Y H:i', strtotime($pedido['created_at'])); ?></div>
                    </div>
                    <div class="pedido-info-right">
                        <span class="pedido-status status-<?php echo strtolower($pedido['status']); ?>">
                            <?php echo ucfirst($pedido['status']); ?>
                        </span>
                    </div>
                </div>
                
                <div class="pedido-info">
                    <div class="info-row">
                        <span class="info-label">Cliente:</span>
                        <span class="info-value"><?php echo htmlspecialchars($pedido['nome_completo']); ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Telefone:</span>
                        <span class="info-value"><?php echo htmlspecialchars($pedido['telefone']); ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value"><?php echo htmlspecialchars($pedido['email']); ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Pagamento:</span>
                        <span class="info-value"><?php echo ucfirst(str_replace('-', ' ', $pedido['forma_pagamento'])); ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Endereço:</span>
                        <span class="info-value"><?php echo htmlspecialchars($pedido['endereco_entrega']); ?></span>
                    </div>
                    
                    <?php if ($pedido['observacoes']): ?>
                    <div class="info-row">
                        <span class="info-label">Observações:</span>
                        <span class="info-value"><?php echo htmlspecialchars($pedido['observacoes']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="pedido-total">
                    Total: R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?>
                </div>
                
                <div class="pedido-actions">
                    <form method="POST" style="display: flex; gap: 10px; flex: 1;">
                        <input type="hidden" name="pedido_id" value="<?php echo $pedido['pedido_id']; ?>">
                        <select name="status" class="action-select" required>
                            <option value="">Alterar Status</option>
                            <option value="Pendente" <?php echo $pedido['status'] == 'Pendente' ? 'selected' : ''; ?>>Pendente</option>
                            <option value="Preparando" <?php echo $pedido['status'] == 'Preparando' ? 'selected' : ''; ?>>Preparando</option>
                            <option value="Entrega" <?php echo $pedido['status'] == 'Entrega' ? 'selected' : ''; ?>>Em Entrega</option>
                            <option value="Finalizado" <?php echo $pedido['status'] == 'Finalizado' ? 'selected' : ''; ?>>Finalizado</option>
                            <option value="Cancelado" <?php echo $pedido['status'] == 'Cancelado' ? 'selected' : ''; ?>>Cancelado</option>
                        </select>
                        <button type="submit" name="update_status" class="action-btn btn-update">
                            <i class="fas fa-sync-alt"></i> Atualizar
                        </button>
                    </form>
                    
                    <button onclick="verDetalhes(<?php echo $pedido['pedido_id']; ?>)" class="action-btn btn-details">
                        <i class="fas fa-eye"></i> Detalhes
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($pedidos)): ?>
            <div style="text-align: center; padding: 50px; background: white; border-radius: 12px; box-shadow: var(--shadow-light);">
                <i class="fas fa-shopping-cart" style="font-size: 3rem; color: var(--medium-gray); margin-bottom: 20px;"></i>
                <h3>Nenhum pedido encontrado</h3>
                <p>Quando os clientes fizerem pedidos, eles aparecerão aqui.</p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function verDetalhes(pedidoId) {
            // Abrir página de detalhes do pedido
            window.open(`detalhes_pedido.php?id=${pedidoId}`, '_blank', 'width=1000,height=700,scrollbars=yes');
        }

        // Auto-refresh da página a cada 30 segundos
        setTimeout(() => {
            window.location.reload();
        }, 30000);
    </script>
</body>
</html>
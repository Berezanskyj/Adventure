<link rel="stylesheet" href="assets/css/perfil_usuario.css">

<div class="painel-container">
    <!-- Barra Lateral -->
    <aside class="sidebar">
        <h2>Bem-vindo, <?= $_SESSION['nome'] ?></h2>
        <nav class="menu">
            <ul>
                <li><a href="?a=user_account"><i class='bx bx-user'></i> Perfil</a></li>
                <li><a href="?a=user_pedidos"><i class='bx bx-receipt'></i> Pedidos</a></li>
                <li><a href="?a=user_config"><i class='bx bx-cog'></i> Configurações</a></li>
                <li><a href="?a=logout"><i class='bx bx-log-out'></i> Sair</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Conteúdo Principal -->
    <main class="conteudo">
        <!-- Seção Pedidos -->
        <section id="pedidos" class="painel-secao">
            <h1><i class='bx bx-receipt'></i> Resumo dos Pedidos</h1>

            <?php if (!empty($pedidos) && is_array($pedidos)): ?>
                <?php foreach ($pedidos as $pedido): ?>
                    <div class="order-card">
                        <h2><i class='bx bx-package'> <a href="?a=pedido&id=<?= $pedido->id ?>"></i> Pedido #<?= $pedido->id ?></a></h2>
                        <p><strong>Data:</strong> <?= date('d/m/Y', strtotime($pedido->data_pedido)) ?></p>
                        <p><strong>Total:</strong> R$ <?= number_format($pedido->total_pedido, 2, ',', '.') ?></p>
                        <p><strong>Status:</strong> <?= ucfirst($pedido->status_pedido) ?></p>
                        <div class="status-bar">
                            <div class="status-step <?= $pedido->status_pedido ?>">
                                <i class='bx bx-loader-circle'></i> <?= ucfirst($pedido->status_pedido) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Não há pedidos registrados.</p>
            <?php endif; ?>
        </section>
    </main>
</div>
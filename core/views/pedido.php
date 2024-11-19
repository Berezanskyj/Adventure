<link rel="stylesheet" href="assets/css/pedido.css">

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
        <!-- Seção do Pedido -->
        <section class="pedido-detalhe">
            <h1><i class='bx bx-package'></i> Detalhes do Pedido</h1>
            
            <!-- Informações do Pedido -->
            <div class="pedido-info">
                <p><strong>Pedido ID:</strong> #<?= $pedido->id ?></p>
                <p><strong>Data do Pedido:</strong> <?= date('d/m/Y', strtotime($pedido->data_pedido)) ?></p>
                <p><strong>Status:</strong> <span class="status <?= strtolower($pedido->status_pedido) ?>"><?= $pedido->status_pedido ?></span></p>
                <p><strong>Total:</strong> R$ <?= number_format($pedido->total_pedido, 2, ',', '.') ?></p>
            </div>

            <!-- Produtos do Pedido -->
            <div class="produtos">
                <h2>Produtos Comprados</h2>
                <?php foreach ($itens as $index => $item): ?>
                    <div class="produto-item">
                        <img src="assets/images/produtos/<?= $produtos[$index]->imagem_produto ?>" alt="<?= $produtos[$index]->nome_produto ?>" class="produto-img">
                        <div class="produto-detalhes">
                            <h3><?= $produtos[$index]->nome_produto ?></h3>
                            <p><strong>Quantidade:</strong> <?= $item->quantidade ?></p>
                            <p><strong>Preço Unitário:</strong> R$ <?= number_format($item->preco_unitario, 2, ',', '.') ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Informações de Entrega -->
            <div class="entrega-info">
                <h2>Informações de Entrega</h2>
                <p><strong>Endereço:</strong>  <?= $_SESSION['cidade']?>, <?= $_SESSION['bairro']?>, <?= $_SESSION['rua']?>, <?= $_SESSION['numero']?>, <?= $_SESSION['complemento']?> - <?= $_SESSION['apelido']?></p>
                <p><strong>CEP:</strong> <?= $_SESSION['cep']?></p>
                <p><strong>Telefone:</strong> <?= $_SESSION['telefone']?></p>
            </div>
        </section>
    </main>
</div>
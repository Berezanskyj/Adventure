<?php

$total_produtos = 0;

if (isset($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $quantidade) {
        $total_produtos += $quantidade;
    }
}

?>

<link rel="stylesheet" href="assets/css/produtos_loja.css">

<div class="page-container">
    <!-- Header Fixo no Topo -->
    <header class="header">
    </header>

    <!-- Conteúdo Principal -->
    <div class="container content">
        <!-- Barra Lateral de Filtros -->
        <aside class="sidebar">
            <form action="?a=filtrar_produtos" method="POST">
                <h4>Filtros</h4>
                <div class="filter-group">
                    <label for="categoria" id="nome_categoria">Categoria:</label>
                    <select id="categoria" name="id_categoria">
                        <option value="null">Todas</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria->id ?>">
                                <?= htmlspecialchars($categoria->nome_categoria) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="tamanho">Tamanho:</label>
                    <select id="tamanho" name="id_tamanho">
                        <option value="null">Todos</option>
                        <?php foreach ($tamanhos as $tamanho): ?>
                            <option value="<?= $tamanho->id ?>">
                                <?= htmlspecialchars($tamanho->tamanho) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="cor">Cores:</label>
                    <select id="cor" name="id_cor">
                        <option value="null">Todas</option>
                        <?php foreach ($cores as $cor): ?>
                            <option value="<?= $cor->id ?>">
                                <?= htmlspecialchars($cor->cor) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Número de itens no carrinho -->
                <button type="submit" class="btn">Aplicar Filtros</button>
                <div class="cart-container">
                    <a href="?a=carrinho" class="cart-link">
                        <i class='bx bx-cart'></i> 
                        <span id="carrinho">Itens: <?= $total_produtos ?></span>
                    </a>
                </div>
            </form>

        </aside>

        <!-- Produtos -->
        <main class="products">
            <?php foreach ($produtos as $produto): ?>
                <div class="product-card">
                    <img src="assets/images/produtos/<?= $produto->imagem_produto ?>" alt="<?= htmlspecialchars($produto->nome_produto) ?>">
                    <h5><?= htmlspecialchars($produto->nome_produto) ?></h5>
                    <h4>R$ <?= preg_replace("/\./", ",", $produto->preco) ?></h4>
                    <?php 
                    $quantidade_disponivel = isset($estoques[$produto->id]) && !empty($estoques[$produto->id]) 
                        ? $estoques[$produto->id][0]->quantidade_disponivel 
                        : 0;
                    ?>
                    <?php if ($quantidade_disponivel <= 0): ?>
                        <button class="btn-sem-estoque" onclick="alerta_estoque()">Sem estoque</button>
                    <?php else: ?>
                        <button class="btn" onclick="adicionar_carrinho(<?= $produto->id ?>)">Adicionar ao carrinho</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </main>
    </div>
</div>

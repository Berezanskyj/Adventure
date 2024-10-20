<?php 
$produto = $produtos[0];
$categoria = $categorias[0];
$tamanho = $tamanhos[0];
$cor = $cores[0];

?>

<link rel="stylesheet" href="assets/css/produtos_loja.css">

<div class="page-container">
    <!-- Header Fixo no Topo -->
    <header class="header">
        <h3>Loja Online</h3>
    </header>

    <!-- Conteúdo Principal -->
    <div class="container content">
        <!-- Barra Lateral de Filtros -->
        <aside class="sidebar">
            <h4>Filtros</h4>
            <form action="?a=filtrar_produtos" method="POST">
            <div class="filter-group">
                <label for="categoria">Categoria:</label>
                <select id="categoria" name="id_categoria">
                    <option value="null">Todas</option>
                    <?php foreach($categorias as $categoria): ?>
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
                    <?php foreach($tamanhos as $tamanho): ?>
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
                    <?php foreach($cores as $cor): ?>
                        <option value="<?= $cor->id ?>">
                            <?= htmlspecialchars($cor->cor) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn">Aplicar Filtros</button>
        </form>
        </aside>

        <!-- Produtos -->
        <main class="products">
            <?php foreach ($produtos as $produto): ?>
                <div class="product-card">
                    <img src="assets/images/<?= $produto->imagem_produto ?>" alt="<?= $produto->nome_produto ?>">
                    <h5><?= $produto->nome_produto ?></h5>
                    <h4>R$ <?= $produto->preco ?></h4>
                    <a href="#" class="btn">Adicionar ao carrinho</a>
                </div>
            <?php endforeach; ?>
        </main>
    </div>

</div>
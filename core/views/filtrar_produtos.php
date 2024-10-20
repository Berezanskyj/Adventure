<?php 

$categoria = $categorias;
$tamanho = $tamanhos;
$cor = $cores;
$filtro = $filtros[0];


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
            <form onsubmit="redirecionar(); return false;">
            <div class="filter-group">
                <label for="categoria">Categoria:</label>
                <select id="categoria" name="id_categoria" disabled>
                    <option value="null"><?=$categoria?></option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="tamanho">Tamanho:</label>
                <select id="tamanho" name="id_tamanho" disabled>
                    <option value="null"><?=$tamanho?></option>
                    
                </select>
            </div>
            
            <div class="filter-group">
                <label for="cor">Cores:</label>
                <select id="cor" name="id_cor" disabled>
                    <option value="null"><?=$cor?></option>
                </select>
            </div>

            <button type="submit" class="btn">Remover Filtros</button>
        </form>
        </aside>

        <!-- Produtos -->
        <main class="products">
            <?php foreach ($filtros as $filtro): ?>
                <div class="product-card">
                    <img src="assets/images/<?= $filtro->imagem_produto ?>" alt="<?= $filtro->nome_produto ?>">
                    <h5><?= $filtro->nome_produto ?></h5>
                    <h4>R$ <?= $filtro->preco ?></h4>
                    <a href="#" class="btn">Adicionar ao carrinho</a>
                </div>
            <?php endforeach; ?>
        </main>
    </div>

</div>

<script>
function redirecionar() {
            // Altere a URL para a qual deseja redirecionar
            window.location.href = "?a=loja";
        }

</script>
<?php 

// Verifica se $categorias é um objeto e se contém a propriedade nome_categoria
$categoria = (is_object($categorias) && isset($categorias->nome_categoria)) ? htmlspecialchars($categorias->nome_categoria) : "TODOS";
$tamanho = (isset($tamanhos) && !empty($tamanhos)) ? htmlspecialchars($tamanhos) : "TODOS";
$cor = (isset($cores) && !empty($cores)) ? htmlspecialchars($cores) : "TODOS";
$filtro = $filtros[0];

?>

<link rel="stylesheet" href="assets/css/produtos_loja.css">

<div class="page-container">

    <!-- Conteúdo Principal -->
    <div class="container content">
        <!-- Barra Lateral de Filtros -->
        <aside class="sidebar">
            <form onsubmit="redirecionar();">
                <div class="filter-group">
                    <label for="categoria">Categoria:</label>
                    <select id="categoria" name="id_categoria" disabled>
                        <option value="null"><?= $categoria ?></option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="tamanho">Tamanho:</label>
                    <select id="tamanho" name="id_tamanho" disabled>
                        <option value="null"><?= $tamanho ?></option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="cor">Cores:</label>
                    <select id="cor" name="id_cor" disabled>
                        <option value="null"><?= $cor ?></option>
                    </select>
                </div>

                <button type="submit" class="btn">Remover Filtros</button>
            </form>
        </aside>

        <!-- Produtos -->
        <main class="products">
            <?php foreach ($filtros as $filtro): ?>
                <div class="product-card">
                    <img src="assets/images/produtos/<?= htmlspecialchars($filtro->imagem_produto) ?>" alt="<?= htmlspecialchars($filtro->nome_produto) ?>">
                    <h5><?= htmlspecialchars($filtro->nome_produto) ?></h5>
                    <h4>R$ <?= preg_replace("/\./", ",", $filtro->preco) ?></h4>
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

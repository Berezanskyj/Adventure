<?php 

// Define valores para categoria, tamanho, e cor com base nos parâmetros recebidos
$categoria = isset($categoria) && !empty($categoria) && $categoria !== "TODOS" ? htmlspecialchars($categoria) : "TODOS";
$tamanho = isset($tamanho) && !empty($tamanho) && $tamanho !== "TODOS" ? htmlspecialchars($tamanho) : "TODOS";
$cor = isset($cor) && !empty($cor) && $cor !== "TODOS" ? htmlspecialchars($cor) : "TODOS";

$total_produtos = 0;

if (isset($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $quantidade) {
        $total_produtos += $quantidade;
    }
}

?>

<link rel="stylesheet" href="assets/css/produtos_loja.css">

<div class="page-container">

    <!-- Conteúdo Principal -->
    <div class="container content">
        <!-- Barra Lateral de Filtros -->
        <aside class="sidebar">
            <form action="?a=filtrar_produtos" method="POST">
                <h4>Filtros</h4>
                <div class="filter-group">
                    <label for="categoria">Categoria:</label>
                    <select id="categoria" name="id_categoria">
                        <option><?=$_SESSION['categoria']?></option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="tamanho">Tamanho:</label>
                    <select id="tamanho" name="id_tamanho">
                        <option><?=$_SESSION['tamanho']?></option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="cor">Cores:</label>
                    <select id="cor" name="id_cor">
                        <option><?=$_SESSION['cor']?></option>
                    </select>
                </div>

                <!-- Número de itens no carrinho -->
                <button type="button" class="btn" onclick="redirecionar()">Remover Filtros</button>
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
            <?php if (!empty($filtros)): ?>
                <?php foreach ($filtros as $produto): ?>
                    <div class="product-card">
                        <img src="assets/images/produtos/<?= htmlspecialchars($produto->imagem_produto) ?>" alt="<?= htmlspecialchars($produto->nome_produto) ?>">
                        <h5><?= htmlspecialchars($produto->nome_produto) ?></h5>
                        <p><?= htmlspecialchars($produto->descricao) ?></p>
                        <h4>R$ <?= preg_replace("/\./", ",", $produto->preco) ?></h4>
                        <button class="btn" onclick="adicionar_carrinho(<?= $produto->id ?>)">Adicionar ao carrinho</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum produto encontrado com os filtros selecionados.</p>
            <?php endif; ?>
        </main>
    </div>

</div>

<script>
function redirecionar() {
    // Redireciona para a página de loja com filtros removidos
    window.location.href = "?a=loja";
}
</script>

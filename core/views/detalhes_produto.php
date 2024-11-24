<link rel="stylesheet" href="assets/css/detalhes_produto.css">

<div class="product-details-container">
    <!-- Canvas para Preview -->
    <div class="product-image" id="product-preview">
        <img src="assets/images/produtos/<?=$_SESSION['img_produto_det']?>" alt="Visualização do Produto">
    </div>

    <!-- Informações do Produto -->
    <div class="product-info">
        <h1><?= $_SESSION['nome_produto_det'] ?></h1>
        <p class="description">
            <?= $_SESSION['desc_produto_det'] ?>
        </p>

        <!-- Informações adicionais com Boxicons -->
        <div class="product-details">
            <div class="detail-item">
                <i class="bx bx-category"></i>
                <span><strong>Categoria:</strong> <?= $_SESSION['categoria_produto_det'] ?></span>
            </div>
            <div class="detail-item">
                <i class="bx bxs-color-fill"></i>
                <span><strong>Cores Disponíveis:</strong> <?= $_SESSION['cores_produto_det'] ?></span>
            </div>
            <div class="detail-item">
                <i class="bx bxs-ruler"></i>
                <span><strong>Tamanhos:</strong> <?= $_SESSION['tamanhos_produto_det'] ?></span>
            </div>
        </div>

        <!-- Preço -->
        <h2 class="price">
            <strong>Preço:</strong> R$<?= number_format($_SESSION['valor_produto_det'], 2, ',', '.') ?>
        </h2>

        <!-- Botão de Personalização -->
        <div>
            <a href="?a=personalizacao_produto&id=<?= $_SESSION['id_produto_det'] ?>" class="btn-customize">Simular Personalização</a>
        </div>
    </div>
</div>

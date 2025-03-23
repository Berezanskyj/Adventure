<link rel="stylesheet" href="assets/css/cadastro_produto.css">
<link rel="stylesheet" href="assets/css/home.css">

<div class="container">
    <aside>
        <div class="top">
            <div class="logo">
                <!-- <img src="images/logo-adventure-preto.png" alt=""> -->
                <div>

                    <h2>Adventure </h2>
                </div>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>

        </div>
        <div class="sidebar">
            <a href="?a=index">
                <span class="material-icons-sharp">dashboard</span>
                <h3>Dashboard</h3>
            </a>
            <a href="?a=usuario_admin">
                <span class="material-icons-sharp">people</span>
                <h3>Usuários</h3>
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">
                    <span class="material-icons-sharp" id="inventory">inventory</span>
                    <h3>Produtos</h3>
                    <span class="material-icons-sharp arrow">arrow_drop_down</span>
                </a>
                <div class="dropdown-content" style="display: none;">
                    <a href="?a=gerencia_produtos">Gerenciar Produtos</a>
                    <a href="?a=produtos_categorias">Categorias</a>
                    <a href="?a=produtos_tamanhos">Tamanhos</a>
                    <a href="?a=produtos_cores">Cores</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">
                    <span class="material-icons-sharp" id="inventory">shopping_cart</span>
                    <h3>Pedidos</h3>
                    <span class="material-icons-sharp arrow">arrow_drop_down</span>
                </a>
                <div class="dropdown-content" style="display: none;">
                    <a href="#">Listar Pedidos</a>
                </div>
            </div>
            <a href="">
                <span class="material-icons-sharp">credit_card</span>
                <h3>Pagamentos</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp">store</span>
                <h3>Estoque</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp">tune</span>
                <h3>Personalizações</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp">poll</span>
                <h3>Relatórios</h3>
            </a>
            <a href="?a=logout">
                <span class="material-icons-sharp">logout</span>
                <h3>Sair</h3>
            </a>
        </div>

    </aside>


    <style>

    </style>
    </head>

    <body>

        <main>
            <div class="titulo-cadastro">

                <h1>Cadastro de Produto</h1>
            </div>
            <form id="product-form" class="product-form" method="POST" action="?a=processa_cadastro_produto" enctype="multipart/form-data">
                <div class="full-width">
                    <input type="hidden" name="imagem_atual" value="<?= $produto->imagem_produto ?>">
                    <label for="nome_produto">Nome do Produto</label>
                    <input type="text" id="nome_produto" name="nome_produto" required value="<?= $produto->nome_produto ?>">
                </div>
                <div>
                    <label for="preco">Preço</label>
                    <input type="text" id="preco" name="preco" required value="R$ <?= $produto->preco ?>">
                </div>
                <div>
                    <label for="categoria">Categoria</label>
                    <select id="categoria" name="categoria" required>
                        <?php foreach ($categoria as $cat): ?>
                            <option value="<?= $cat->id ?>" <?= ($produto->nome_categoria == $cat->nome_categoria) ? 'selected' : '' ?>>
                                <?= $cat->nome_categoria ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="tamanho">Tamanho</label>
                    <select id="tamanho" name="tamanho" required>
                        <?php foreach ($tamanho as $tamanho): ?>
                            <option value="<?= $tamanho->id ?>" <?= ($produto->tamanho == $tamanho->tamanho) ? 'selected' : '' ?>>
                                <?= $tamanho->tamanho ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="cor">Cor</label>
                    <select id="cor" name="cor" required>
                        <?php foreach ($cor as $cor): ?>
                            <option value="<?= $cor->id ?>" <?= ($produto->cor == $cor->cor) ? 'selected' : '' ?>>
                                <?= $cor->cor ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="full-width">
                    <label for="imagem">Imagem do Produto <span>(*jpg, jpeg, png, tiff, jfif, webp)</span> </label>
                    <input type="file" id="imagem" name="imagem" accept="image/*">
                    <div class="image-preview" id="imagePreview">
                        <?php if (!empty($produto->imagem_produto)): ?>
                            <img src="../assets/images/produtos/<?= $produto->imagem_produto ?>" alt="Imagem do Produto" id="previewImage">
                        <?php else: ?>
                            <span>Pré-visualização da imagem</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="full-width">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" required"><?= $produto->descricao ?></textarea>
                </div>
                <div class="full-width">
                    <label for="visivel">Visivel no site</label>
                    <select name="visivel" id="visivel">
                        <option value="1" <?= ($produto->visivel == 1) ? 'selected' : '' ?>>Sim</option>
                        <option value="0" <?= ($produto->visivel == 0) ? 'selected' : '' ?>>Não</option>
                    </select>
                </div>
                <button class="full-width" type="submit" name="submit">Cadastrar Produto</button>
            </form>
            <?php if (isset($_SESSION['erro'])): ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: '<?= $_SESSION['erro'] ?>',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                </script>
                <?php unset($_SESSION['erro']); // Remove a sessão para não exibir o alerta novamente 
                ?>
            <?php endif; ?>
        </main>


        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Olá, <b><?= $_SESSION['nome_admin'] ?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <!-- <div class="profile-photo">
                        <img src="images/logo-adventure-preto.png" alt="">
                    </div> -->
                </div>
            </div>
        </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js"></script>
<script src="assets/js/editar-produto.js"></script>
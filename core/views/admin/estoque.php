<link rel="stylesheet" href="assets/css/estoque.css">

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
                    <a href="?a=pedidos">Listar Pedidos</a>
                </div>
            </div>
            <a href="?a=pagamentos">
                <span class="material-icons-sharp">credit_card</span>
                <h3>Pagamentos</h3>
            </a>
            <a href="?a=estoque">
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

    <main>
        <h1>Gerenciamento de Produtos</h1>

        <div class="date">
            <input type="date" id="date-input" disabled>
        </div>

        <div class="recent-orders">
            <!-- CRUD Section -->
            <div class="crud-header">
                <h2>Lista de Produtos</h2>
                <input type="text" id="search-input" placeholder="Pesquisar por Produto, Cor, Tamanho..." onkeyup="searchOrders()">
                <span></span>
                <!-- <button class="btn btn-primary" id="create-payment-method" ></button> -->
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID Produto</th>
                        <th>Produto</th>
                        <th>Cor</th>
                        <th>Tamanho</th>
                        <th>Quantidade</th>
                        <th>Registrar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($produtos as $p): ?>
                            <td><?= $p->id_produto  ?></td>
                            <td><?= $p->nome_produto ?></td>
                            <td><?= $p->nome_cor ?></td>
                            <td><?= $p->nome_tamanho ?></td>
                            <td><?= $p->quantidade_disponivel ?></td>
                            <td>
                                <button id="botao-entrada" class="btn btn-success add-user"
                                data-id="<?= $p->id_produto ?>"
                                data-nome_produto="<?= $p->nome_produto ?>"
                                data-nome_cor="<?= $p->nome_cor ?>"
                                data-nome_tamanho="<?= $p->nome_tamanho ?>"
                                data-quantidade_disponivel="<?= $p->quantidade_disponivel ?>" 
                                onclick="modalEntrada(this)">Entrada</button>

                                <button id="botao-saida" class="btn btn-warning add-user" 
                                data-id="<?= $p->id_produto ?>"
                                data-nome_produto_saida="<?= $p->nome_produto ?>"
                                data-nome_cor_saida="<?= $p->nome_cor ?>"
                                data-nome_tamanho_saida="<?= $p->nome_tamanho ?>"
                                data-quantidade_disponivel_saida="<?= $p->quantidade_disponivel ?>" 
                                onclick="modalSaida(this)">Saida</button>
                            </td>
                </tbody>
            <?php endforeach; ?>
            </table>
        </div>

        <div class="modal" id="entrada-modal" style="display: none;">
            <div class="modal-content">
                <span class="close-modal" onclick="fecharModalEntrada()">&times;</span>
                <h2 id="modal-title">Cadastrar entrada do Estoque</h2>
                <form id="entrada-form" method="post" action="?a=adicionar_entrada">
                    <label for="produto">Produto</label>
                    <input type="text" name="produto" id="nome_produto" readonly>

                    <label for="cor">Cor</label>
                    <input type="text" name="cor" id="produto_cor" readonly>

                    <label for="tamanho">Tamanho</label>
                    <input type="text" name="tamanho" id="produto_tamanho" readonly>

                    <label for="name">Quantidade da entrada</label>
                    <input type="text" name="qtdEntrada" id="qtdEntrada">
                    <button type="button" class="btn btn-primary" onclick="cadastrarEntrada()">Salvar</button>
                </form>
            </div>
        </div>

        <div class="modal" id="saida-modal" style="display: none;">
            <div class="modal-content">
                <span class="close-modal" onclick="fecharModalSaida()">&times;</span>
                <h2 id="modal-title">Cadastrar saida do Estoque</h2>
                <form id="saida-form" method="post" action="?a=adicionar_saida">
                    <label for="produto">Produto</label>
                    <input type="text" name="produto" id="nome_produto_saida" readonly>

                    <label for="cor">Cor</label>
                    <input type="text" name="cor" id="produto_cor_saida" readonly>

                    <label for="tamanho">Tamanho</label>
                    <input type="text" name="tamanho" id="produto_tamanho_saida" readonly>

                    <label for="name">Quantidade da Saida</label>
                    <input type="text" name="qtdSaida" id="qtdSaida_saida">
                    <button type="button" class="btn btn-primary" onclick="cadastrarSaida()">Salvar</button>
                </form>
            </div>
        </div>



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
<!-- <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/gerenciarEstoque.js"></script>
<link rel="stylesheet" href="assets/css/home.css">
<link rel="stylesheet" href="assets/css/crud-usuario.css">

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
                    <a href="#">Gerenciar Produtos</a>
                    <a href="?a=produtos_categorias">Categorias</a>
                    <a href="?a=produtos_tamanhos">Tamanhos</a>
                    <a href="#">Cores</a>
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
                    <a href="#">Listar Clientes</a>
                </div>
            </div>
            <a href="?a=pagamentos">
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

    <main>
        <h1>Dashboard</h1>

        <div class="date">
            <input type="date" id="date-input" disabled>
        </div>

        <div class="recent-orders">
            <!-- CRUD Section -->
            <div class="crud-header">
                <h2>Lista de Tamanhos</h2>
                <button class="btn btn-primary" id="create-payment-method" onclick="abrirModalRegistro()">Cadastrar tamanho</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tamanho</th>
                        <th>Data de criação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>



                    <?php foreach ($tamanho as $tamanho): ?>
                        <tr>
                            <td><?= $tamanho->id ?></td>
                            <td><?= ucfirst($tamanho->tamanho) ?></td>
                            <td><?= date("d/m/Y", strtotime($tamanho->data_criacao)) ?></td>
                            <td>
                                <button id="botao-editar" class="btn btn-success add-user" onclick="abrirModalEditar('<?=$tamanho->id?>', '<?=$tamanho->tamanho?>')">Editar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <!-- Add/Edit User Modal -->
        <div class="modal" id="register-modal" style="display: none;">
            <div class="modal-content">
                <span class="close-modal" onclick="fecharModalRegistro()">&times;</span>
                <h2 id="modal-title">Cadastrar tamanho</h2>
                <form id="register-form" method="post" action="?a=criar_tamanho_produto">
                    <label for="name">Tamanho</label>
                    <input type="text" name="nameCategory" id="nameCategoryModal">
                    <button type="button" class="btn btn-primary" onclick="cadastrarTamanho()">Salvar</button>
                </form>
            </div>
        </div>


        <!-- Change order status modal -->
        <div class="modal" id="change-size-modal" style="display: none;">
            <div class="modal-content">
                <span class="close-modal" onclick="fecharModalEditar()">&times;</span>
                <h2 id="modal-title">Editar tamanho</h2>
                <form id="register-form" method="post" action="?a=editar_tamanho_produto">
                    <label for="id">ID</label>
                    <input type="text" name="id" id="id" disabled>
                    <label for="tamanho">Tamanho</label>
                    <input type="text" name="tamanho" id="tamanho">
                    <button type="button" class="btn btn-primary" onclick="editarTamanho()">Salvar</button>
                </form>
            </div>
        </div>
        </tbody>
        </table>
        </section>





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
<script src="assets/js/modal-tamanhos.js"></script>
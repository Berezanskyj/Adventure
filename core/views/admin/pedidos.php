<link rel="stylesheet" href="assets/css/home.css">
<link rel="stylesheet" href="assets/css/crud.css">

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
                    <a href="#">Categorias</a>
                    <a href="#">Tamanhos</a>
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

    <main>
        <h1>Dashboard</h1>

        <div class="date">
            <input type="date" id="date-input" disabled>
        </div>

        <div class="recent-orders">
            <div class="recent-orders">
                <h2>Lista de Pedidos</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Pedido</th>
                            <th>Cliente</th>
                            <th>Status</th>
                            <th>Total Pedido</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr>
                                <td><?= $pedido->pedido_id ?></td>
                                <td><?= $pedido->nome_usuario ?></td>
                                <td class="success" id="status"><?= $pedido->status_pedido ?></td>
                                <td>R$<?= number_format($pedido->total_pedido, 2, ',', '.') ?></td>
                                <td>
                                    <button class="btn btn-success add-user">Editar</button>
                                    <button class="btn btn-danger">Excluir</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="?a=pedidos">Mostrar mais</a>
            </div>



        </div>
        <!-- Add/Edit User Modal -->
        <div class="modal" id="user-modal" style="display: none;">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <h2 id="modal-title">Editar Usuário</h2>
                <form id="user-form" method="post">
                    <input type="hidden" name="id" id="idUsuarioModal"">
                    <label for=" name">Nome</label>
                    <input type="text" id="name" name="name">
                    <label for="surname">Sobrenome</label>
                    <input type="text" id="surname" name="surname">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone">
                    <button type="submit" class="btn btn-primary">Salvar</button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/modal-pedidos.js"></script>
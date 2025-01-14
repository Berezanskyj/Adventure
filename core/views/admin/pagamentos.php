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
                <h2>Lista de Pagamentos</h2>
                <button class="btn btn-primary" id="create-payment-method" onclick="abrirModal()">Criar Status de Pagamento</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>Método de Pagamento</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pagamento as $pagamentos):?>
                        

                    <tr>
                        <td><?= $pagamentos->pedido_id ?></td>
                        <td><?= $pagamentos->metodo_pagamento ?></td>
                        <td id="statusPagamento"><?= ucwords(str_replace('_', ' ', $pagamentos->status_pagamento)); ?></td>
                        <td>
                            <button id="botao-editar" class="btn btn-success add-user" onclick="abrirChangeModal('<?=$pagamentos->pedido_id?>', '<?=$pagamentos->metodo_pagamento?>')">Editar</button>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <!-- Add/Edit User Modal -->
        <div class="modal" id="register-modal" style="display: none;">
            <div class="modal-content">
                <span class="close-modal" onclick="fecharModal()">&times;</span>
                <h2 id="modal-title">Criar Status</h2>
                <form id="register-form" method="post" action="?a=criar_status_pagamento">
                    <label for="name">Nome</label>
                    <input type="text" name="nameStatusRegister" id="nomeStatusModal">
                    <button type="button" class="btn btn-primary" onclick="registerStatus()">Salvar</button>
                </form>
            </div>
        </div>


        <!-- Change order status modal -->
        <div class="modal" id="change-order-modal" style="display: none;">
            <div class="modal-content">
                <span class="close-modal" onclick="fecharChangeModal()">&times;</span>
                <h2 id="modal-title">Criar Status</h2>
                <form id="register-form" method="post" action="?a=editar_pagamento">
                    <label for="pedido">Pedido</label>
                    <input type="text" name="pedido" id="pedido" disabled>
                    <label for="metodo">Método de Pagamento</label>
                    <input type="text" name="metodo" id="metodo" disabled>
                    <label for="status_pagamento">Status do Pagamento</label>
                    <select id="status_pagamento" name="status_pagamento">
                    <?php foreach ($status as $statusPagamento):?>
                        <option value="<?=$statusPagamento->id?>"><?=ucfirst(str_replace('_', ' ',$statusPagamento->nome_status))?></option>
                    <?php endforeach;?>
                    </select>
                    <button type="button" class="btn btn-primary" onclick="changePaymentStatus()">Salvar</button>
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
<script src="assets/js/modal-pagamentos.js"></script>
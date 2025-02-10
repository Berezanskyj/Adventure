<link rel="stylesheet" href="assets/css/home.css">
<link rel="stylesheet" href="assets/css/crud-pedidos.css">

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
        <h1>Dashboard</h1>

        <div class="date">
            <input type="date" id="date-input" disabled>
        </div>

        <div class="recent-orders">
            <div class="recent-orders-header">
                <h2>Lista de Pedidos</h2>
                <a href="?a=pedidos" class="btn">Pedidos</a>
            </div>
            <div class="search-box">
                <input type="text" id="search-input" placeholder="Pesquisar por Pedido, Cliente, Status..." onkeyup="searchOrders()">
            </div>
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
                            <td class="success" id="status"><?= ucwords($pedido->status_pedido) ?></td>
                            <td>R$<?= number_format($pedido->total_pedido, 2, ',', '.') ?></td>
                            <td>
                                <button class="btn btn-warning" onclick="ativarPedido(<?= $pedido->pedido_id ?>)">Ativar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>



</div>
<!-- Update Order Modal -->
<div class="modal" id="order-modal" style="display: none;">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2 id="modal-title">Atualizar Pedido</h2>
        <form id="order-form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="idPedidoModal">
            <input type="hidden" name="idUsuario" id="idUsuario">

            <label for="nome_usuario">Nome do Usuário</label>
            <input type="text" id="nome_usuario" name="nome_usuario" readonly>

            <label for="status_pedido">Status do Pedido</label>
            <select id="status_pedido" name="status_pedido">
                <option value="pendente">Pendente</option>
                <option value="enviado">Enviado</option>
                <option value="entregue">Entregue</option>
            </select>

            <label for="total_pedido">Total do Pedido (R$)</label>
            <input type="text" id="total_pedido" name="total_pedido" readonly>

            <label for="data_pedido">Data do Pedido</label>
            <input type="text" id="data_pedido" name="data_pedido" readonly>

            <label for="itens_pedido">Itens do Pedido</label>
            <table id="itens_pedido" class="order-items-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Cor</th>
                        <th>Tamanho</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário (R$)</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <label for="metodo_pagamento">Método de pagamento</label>
            <input type="text" id="metodo_pagamento" name="metodo_pagamento" readonly>

            <label for="status_pagamento">Status do Pagamento</label>
            <select id="status_pagamento" name="status_pagamento">
                <option value="1">Pendente</option>
                <option value="pendente">Em Processamento</option>
                <option value="3">Pago</option>
                <option value="4">Recusado</option>
                <option value="6">Cancelado</option>
                <option value="7">Reembolsado</option>
            </select>

            <label for="mensagem">Mensagem</label>
            <textarea id="mensagem" name="mensagem" rows="4" placeholder="Digite uma mensagem..."></textarea>

            <label for="anexos">Anexar Arquivos</label>
            <input type="file" id="anexos" name="anexos" multiple>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>


</tbody>
</table>
</section>





</main>


</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/modal-pedidos.js"></script>
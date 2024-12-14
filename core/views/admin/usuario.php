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
                        <a href="#">Listar Pedidos</a>
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
                <h2>Usuários Cadastrados</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>E-mail</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?=$usuario->id?></td>
                            <td><?=$usuario->nome?></td>
                            <td><?=$usuario->sobrenome?></td>
                            <td><?=$usuario->email?></td>
                            <td><?=$usuario->cpf?></td>
                            <td><?=$usuario->telefone?></td>
                            <td class="primary"><a href="">Detalhes</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
                        <p>Olá, <b><?=$_SESSION['nome_admin']?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <!-- <div class="profile-photo">
                        <img src="images/logo-adventure-preto.png" alt="">
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



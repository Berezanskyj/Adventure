

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
                <a href="">
                    <span class="material-icons-sharp">dashboard</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="">
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
                <a href="">
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

            <div class="insights">
                <div class="sales">
                    <span class="material-icons-sharp">query_stats</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total de Vendas</h3>
                            <h1>R$1.000,00</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Últimas 24hrs</small>
                </div>

                <div class="income">
                    <span class="material-icons-sharp">query_stats</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total de Estoque</h3>
                            <h1>+999</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>100%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Últimas 24hrs</small>
                </div>

                <div class="expenses">
                    <span class="material-icons-sharp">query_stats</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total de Despesas</h3>
                            <h1>R$10.000,00</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>50%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Últimas 24hrs</small>
                </div>
            </div>





            <div class="recent-orders">
                <h2>Últimos Pedidos</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Pedido</th>
                            <th>Cliente</th>
                            <th>Pagamento</th>
                            <th>Status</th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>132</td>
                            <td>Joao Carlos</td>
                            <td>Pix</td>
                            <td class="success">Enviado</td>
                            <td class="primary">Detalhes</td>
                        </tr>
                    </tbody>
                </table>
                <a href="">Mostrar Todos</a>
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
                        <p>Olá, <b>USUARIO</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <!-- <div class="profile-photo">
                        <img src="images/logo-adventure-preto.png" alt="">
                    </div> -->
                </div>
            </div>
        </div>
    </div>




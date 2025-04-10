<link rel="stylesheet" href="assets/css/relatorios.css">

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
            <a href="?a=relatorios">
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

        <div class="report-cards">
            <div class="report-card">
                <span class="material-icons-sharp" id="categoria">category</span>
                <div class="card-content">
                    <h3>Relatório de Vendas por Categoria de Produto</h3>
                    <p>Apresenta o total de vendas agrupadas por categoria de produto, permitindo identificar quais tipos de produtos geram mais receita.</p>
                    <form action="?a=relatorio_vendas_categoria" method="post" target="_blank">

                        <button class="report-btn">Gerar Relatório</button>

                    </form>
                </div>
            </div>

            <div class="report-card">
                <span class="material-icons-sharp" id="resumo">assignment</span>
                <div class="card-content">
                    <h3>Resumo de Pedidos por Status</h3>
                    <p>Mostra a quantidade de pedidos em cada status (Pendente, Processando, Enviado, Concluído, Cancelado), facilitando o acompanhamento do fluxo de vendas.

                    </p>
                    <form action="?a=relatorio_pedidos_status" method="post" target="_blank">

                        <button class="report-btn">Gerar Relatório</button>

                    </form>
                </div>
            </div>

            <div class="report-card">
                <span class="material-icons-sharp" id="estrela">star</span>
                <div class="card-content">
                    <h3>Top 5 Produtos Mais Vendidos</h3>
                    <p>Lista os cinco produtos com maior volume de vendas, auxiliando na análise de popularidade e desempenho de produtos.</p>
                    <form action="?a=top_cinco" method="post" target="_blank">

                        <button class="report-btn">Gerar Relatório</button>

                    </form>
                </div>
            </div>

            <div class="report-card">
                <span class="material-icons-sharp" id="cartao">credit_card</span>
                <div class="card-content">
                    <h3>Relatório de Pagamentos por Método e Status</h3>
                    <p>Exibe a distribuição dos pagamentos realizados, segmentando por método (cartão, boleto, pix etc.) e por status (aprovado, recusado, pendente).</p>
                    <form action="?a=pagamento_met_status" method="post" target="_blank">

                        <button class="report-btn">Gerar Relatório</button>

                    </form>
                </div>
            </div>
            <div class="report-card">
                <span class="material-icons-sharp" id="emoji">emoji_people</span>
                <div class="card-content">
                    <h3>Clientes que Mais Compraram</h3>
                    <p>Destaca os clientes com maior número de compras e/ou maior valor gasto, permitindo ações de fidelização ou marketing direcionado.</p>
                    <form action="?a=cliente_mais_compra" method="post" target="_blank" target="_blank">

                        <button class="report-btn">Gerar Relatório</button>

                    </form>
                </div>
            </div>
            <div class="report-card">
                <span class="material-icons-sharp" id="inventario">inventory_2</span>
                <div class="card-content">
                    <h3>Estoque Atual por Produto</h3>
                    <p>Apresenta o saldo atual de cada produto em estoque, com alertas para níveis baixos e necessidade de reposição.</p>
                    <form action="?a=estoque_atual" method="post" target="_blank">

                        <button class="report-btn">Gerar Relatório</button>

                    </form>
                </div>
            </div>
            <div class="report-card">
                <span class="material-icons-sharp" id="barra">bar_chart</span>
                <div class="card-content">
                    <h3>Vendas por Mês</h3>
                    <p>Traz um panorama mensal das vendas ao longo do tempo, permitindo identificar tendências, sazonalidades e crescimento.</p>
                    <form action="?a=vendas_mes" method="post" target="_blank">

                        <button class="report-btn">Gerar Relatório</button>

                    </form>
                </div>
            </div>

    </main>














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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
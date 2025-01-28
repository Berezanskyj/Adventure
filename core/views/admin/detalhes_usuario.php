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
        <h1>Gerenciar Usuários</h1>

        <div class="date">
            <input type="date" id="date-input" disabled>
        </div>

        <form id="user-details-form" class="form-container">
            <label for="user-id" class="form-label">ID do Usuário</label>
            <input type="number" id="user-id" name="user-id" placeholder="ID" readonly class="form-input form-input-readonly">

            <label for="user-name" class="form-label">Nome</label>
            <input type="text" id="user-name" name="user-name" placeholder="Digite o nome" class="form-input">

            <label for="user-email" class="form-label">Email</label>
            <input type="email" id="user-email" name="user-email" placeholder="Digite o email" class="form-input">

            <label for="user-description" class="form-label">Descrição</label>
            <textarea id="user-description" name="user-description" placeholder="Digite uma descrição" class="form-textarea"></textarea>

            <div class="form-actions">
                <button type="button" class="btn btn-save">Salvar</button>
                <button type="button" class="btn btn-delete">Excluir</button>
                <button type="button" class="btn btn-cancel">Cancelar</button>
            </div>
        </form>



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
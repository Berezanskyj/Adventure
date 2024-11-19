
<link rel="stylesheet" href="assets/css/perfil_usuario.css">

<div class="painel-container">
        <!-- Barra Lateral -->
        <aside class="sidebar">
            <h2>Bem-vindo, <?=$_SESSION['nome']?></h2>
            <nav class="menu">
                <ul>
                    <li><a href="?a=user_account"><i class='bx bx-user'></i> Perfil</a></li>
                    <li><a href="?a=user_pedidos"><i class='bx bx-receipt'></i> Pedidos</a></li>
                    <li><a href="?a=user_config"><i class='bx bx-cog'></i> Configurações</a></li>
                    <li><a href="?a=logout"><i class='bx bx-log-out'></i> Sair</a></li>
                </ul>
            </nav>
        </aside>
    
        <!-- Conteúdo Principal -->
        <main class="conteudo">
            <!-- Seção Perfil -->
            <section id="perfil" class="painel-secao">
                <h1><i class='bx bx-user'></i>Perfil do Usuário</h1>
                <div class="user-info">
                    <div class="avatar-container">
                        <img src="assets/images/neymar.jfif" alt="Avatar do Usuário" class="user-avatar">
                        <div class="overlay">
                            <label for="avatar-upload"><i class='bx bx-camera'></i>Trocar imagem</label>
                            <input type="file" id="avatar-upload" accept="image/*">
                        </div>
                    </div>
                    <div class="user-details">
                        <h2><?=$_SESSION['nome'] ." " . $_SESSION['sobrenome']?></h2>
                        <p>Email: <?=$_SESSION['usuario']?></p>
                        <p>Data de Cadastro: <?=$_SESSION['data_cadastro']?></p>
                    </div>
                </div>
                <div class="user-extra-info">
                    <div class="info-group">
                        <h3>Informações de Conta</h3>
                        <p><strong>Nome completo:</strong> <?=$_SESSION['nome'] ." " . $_SESSION['sobrenome']?></p>
                        <p><strong>Endereço:</strong> <?=$_SESSION['rua'] .", " . $_SESSION['numero'] .", " . $_SESSION['cidade']?></p>
                        <p><strong>CPF:</strong> <?=$_SESSION['cpf']?></p>
                        <p><strong>Data de Nascimento:</strong> 01/01/1990</p>
                        <p><strong>Data da Conta:</strong> <?=$_SESSION['data_cadastro']?></p>
                    </div>
                    <div class="info-group">
                        <h3>Informações de Contato</h3>
                        <p><strong>Telefone:</strong> <?=$_SESSION['telefone']?></p>
                        <p><strong>Email:</strong> <?=$_SESSION['usuario']?></p>
                    </div>
                    <div class="info-group">
                        <h3>Informações de Endereço</h3>
                        <p><strong>Apelido:</strong> <?=$_SESSION['apelido']?></p>
                        <p><strong>CEP:</strong> <?=$_SESSION['cep']?></p>
                        <p><strong>Cidade:</strong> <?=$_SESSION['cidade']?></p>
                        <p><strong>Bairro:</strong> <?=$_SESSION['bairro']?></p>
                        <p><strong>Rua:</strong> <?=$_SESSION['rua']?></p>
                        <p><strong>Numero:</strong> <?=$_SESSION['numero']?></p>
                        <p><strong>Complemento:</strong> <?=$_SESSION['complemento']?></p>
                    </div>
                </div>
            </section>
        </main>
    </div>
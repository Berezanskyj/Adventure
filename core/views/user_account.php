
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
                        <h2><?=$usuario[0]->nome ." " . $usuario[0]->sobrenome?></h2>
                        <p>Email: <?=$usuario[0]->email?></p>
                        <p>Data de Cadastro: <?=$_SESSION['data_cadastro']?></p>
                    </div>
                </div>
                <div class="user-extra-info">
                    <div class="info-group">
                        <h3>Informações de Conta</h3>
                        <p><strong>Nome completo:</strong> <?=$usuario[0]->nome ." " . $usuario[0]->sobrenome?></p>
                        <p><strong>Endereço:</strong> <?=$endereco[0]->rua .", " . $endereco[0]->numero .", " . $endereco[0]->cidade?></p>
                        <p><strong>CPF:</strong> <?=$usuario[0]->cpf?></p>
                        <p><strong>Data de Nascimento:</strong> 01/01/1990</p>
                        <p><strong>Data da Conta:</strong> <?=$_SESSION['data_cadastro']?></p>
                    </div>
                    <div class="info-group">
                        <h3>Informações de Contato</h3>
                        <p><strong>Telefone:</strong> <?=$usuario[0]->telefone?></p>
                        <p><strong>Email:</strong> <?=$usuario[0]->email?></p>
                    </div>
                    <div class="info-group">
                        <h3>Informações de Endereço</h3>
                        <p><strong>Apelido:</strong> <?=$endereco[0]->apelido?></p>
                        <p><strong>CEP:</strong> <?=$endereco[0]->cep?></p>
                        <p><strong>Cidade:</strong> <?=$endereco[0]->cidade?></p>
                        <p><strong>Bairro:</strong> <?=$endereco[0]->bairro?></p>
                        <p><strong>Rua:</strong> <?=$endereco[0]->rua?></p>
                        <p><strong>Numero:</strong> <?=$endereco[0]->numero?></p>
                        <p><strong>Complemento:</strong> <?=$endereco[0]->complemento?></p>
                    </div>
                </div>
            </section>
        </main>
    </div>
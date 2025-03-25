

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
        <main class="conteudo">
            <!-- Seção Configurações -->
            <section id="configuracoes" class="painel-secao">
                <h1><i class='bx bx-cog'></i> Configurações</h1>
                <form method="post" action="?a=atualizar_configuracoes" id="configuracoes-form">
                    <!-- Informações de Conta -->
                    <div class="info-group">
                        <h3><i class='bx bx-user-circle'></i> Informações Pessoais</h3>
                        <p><strong>Nome atual:</strong> <?= $usuario[0]->nome ?></p>
                        <label for="nome">Novo Nome</label>
                        <input type="text" id="nome" name="nome">

                        <p><strong>Sobrenome atual:</strong> <?= $usuario[0]->sobrenome ?></p>
                        <label for="sobrenome">Novo Sobrenome</label>
                        <input type="text" id="sobrenome" name="sobrenome">

                        <p><strong>E-mail atual:</strong> <?= $usuario[0]->email ?></p>
                        <label for="email">Novo E-mail</label>
                        <input type="text" id="email" name="email">

                        <p><strong>CPF atual: </strong><?= $usuario[0]->cpf ?></p>
                        <label for="cpf">Novo CPF</label>
                        <input type="text" id="cpf" name="cpf">

                        <p><strong>Telefone atual:</strong> <?= $usuario[0]->telefone ?></p>
                        <label for="telefone">Novo Telefone</label>
                        <input type="text" id="telefone" name="telefone">
                        <button type="submit" class="btn-atualizar-config"><i class='bx bx-save'></i> Salvar Informações</button>
                    </div>
                </form>

                <form method="post" action="?a=atualizar_endereco">
                    <div class="info-group">
                        <h3><i class='bx bx-user-circle'></i> Endereço</h3>
                        <p><strong>Endereço atual:</strong> <?= $endereco[0]->cep?>, <?= $endereco[0]->cidade?>, <?= $endereco[0]->bairro?>, <?= $endereco[0]->rua?>, <?= $endereco[0]->numero ?>, <?= $endereco[0]->complemento ?> - <?= $endereco[0]->apelido?> </p>
                        <p><strong>CEP atual:</strong> <?=$endereco[0]->cep ?></p>
                        <label for="endereco">Novo CEP</label>
                        <input type="text" id="endereco" name="cep">
                        <p><strong>Cidade atual:</strong> <?= $endereco[0]->cidade ?></p>
                        <label for="endereco">Novo Cidade</label>
                        <input type="text" id="endereco" name="cidade">
                        <p><strong>Bairro atual:</strong> <?= $endereco[0]->bairro ?></p>
                        <label for="endereco">Novo Bairro</label>
                        <input type="text" id="endereco" name="bairro">
                        <p><strong>Rua atual:</strong> <?= $endereco[0]->rua ?></p>
                        <label for="endereco">Novo Rua</label>
                        <input type="text" id="endereco" name="rua">
                        <p><strong>Numero atual:</strong> <?= $endereco[0]->numero ?></p>
                        <label for="endereco">Novo Numero</label>
                        <input type="text" id="endereco" name="numero">
                        <p><strong>Complemento atual:</strong> <?= $endereco[0]->complemento ?></p>
                        <label for="endereco">Novo Complemento</label>
                        <input type="text" id="endereco" name="complemento">
                        <p><strong>Apelido atual:</strong> <?= $endereco[0]->apelido ?></p>
                        <label for="endereco">Novo Apelido</label>
                        <input type="text" id="endereco" name="apelido">
    
                        
                        <button type="submit" class="btn-atualizar-config"><i class='bx bx-save'></i> Salvar Informações</button>
                    </div>
                </form>
    
                    <!-- Segurança -->
                <form method="post" action="?a=atualizar_seguranca">
                    <div class="info-group">
                        <h3><i class='bx bx-shield'></i> Segurança</h3>
    
                        <label for="nova_senha">Nova Senha</label>
                        <input type="password" id="nova_senha" name="nova_senha">
    
                        <label for="confirmar_senha">Confirmar Nova Senha</label>
                        <input type="password" id="confirmar_senha" name="confirmar_senha">
                        <button type="submit" class="btn-atualizar-config"><i class='bx bx-save'></i> Salvar Configurações</button>
                    </div>
                </form>
            </section>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/user_config.js"></script>
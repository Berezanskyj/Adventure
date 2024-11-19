

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
            <section id="configuracoes" class="painel-secao"">
                <h1><i class='bx bx-cog'></i> Configurações</h1>
                <form method="post" action="?a=atualizar_configuracoes">
    
                    <!-- Informações de Conta -->
                    <div class="info-group">
                        <h3><i class='bx bx-user-circle'></i> Informações Pessoais</h3>
                        <p><strong>Nome completo atual:</strong> <?= $_SESSION['nome'] ?> <?= $_SESSION['sobrenome'] ?></p>
                        <label for="nome_completo">Novo Nome</label>
                        <input type="text" id="nome_completo" name="nome">
                        <label for="nome_completo">Novo Sobrenome</label>
                        <input type="text" id="nome_completo" name="sobrenome">
                        <p><strong>E-mail atual:</strong> <?= $_SESSION['usuario'] ?></p>
                        <label for="nome_completo">Novo E-mail</label>
                        <input type="text" id="nome_completo" name="cpf">
                        <p><strong>CPF atual: </strong><?= $_SESSION['cpf'] ?></p>
                        <label for="nome_completo">Novo CPF</label>
                        <input type="text" id="nome_completo" name="telefone">
                        <p><strong>Telefone atual:</strong> <?= $_SESSION['telefone'] ?></p>
                        <label for="nome_completo">Novo Telefone</label>
                        <input type="text" id="nome_completo" name="telefone">
                        <button type="submit" class="btn-atualizar-config"><i class='bx bx-save'></i> Salvar Informações</button>
                    </div>
                </form>

                <form method="post" action="?a=atualizar_configuracoes">
                    <div class="info-group">
                        <h3><i class='bx bx-user-circle'></i> Endereço</h3>
                        <p><strong>Endereço atual:</strong> <?= $_SESSION['cep']?>, <?= $_SESSION['cidade']?>, <?= $_SESSION['bairro']?>, <?= $_SESSION['rua']?>, <?= $_SESSION['numero']?>, <?= $_SESSION['complemento']?> - <?= $_SESSION['apelido']?> </p>
                        <p><strong>CEP atual:</strong> <?= $_SESSION['cep'] ?></p>
                        <label for="endereco">Novo CEP</label>
                        <input type="text" id="endereco" name="cep">
                        <p><strong>Cidade atual:</strong> <?= $_SESSION['cidade'] ?></p>
                        <label for="endereco">Novo Cidade</label>
                        <input type="text" id="endereco" name="cidade">
                        <p><strong>Bairro atual:</strong> <?= $_SESSION['bairro'] ?></p>
                        <label for="endereco">Novo Bairro</label>
                        <input type="text" id="endereco" name="bairro">
                        <p><strong>Rua atual:</strong> <?= $_SESSION['rua'] ?></p>
                        <label for="endereco">Novo Rua</label>
                        <input type="text" id="endereco" name="rua">
                        <p><strong>Numero atual:</strong> <?= $_SESSION['numero'] ?></p>
                        <label for="endereco">Novo Numero</label>
                        <input type="text" id="endereco" name="numero">
                        <p><strong>Complemento atual:</strong> <?= $_SESSION['complemento'] ?></p>
                        <label for="endereco">Novo Complemento</label>
                        <input type="text" id="endereco" name="complemento">
                        <p><strong>Apelido atual:</strong> <?= $_SESSION['apelido'] ?></p>
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
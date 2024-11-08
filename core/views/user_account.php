<link rel="stylesheet" href="assets/css/perfil_usuario.css">

<div class="painel-container">
        <!-- Barra Lateral -->
        <aside class="sidebar">
            <h2>Bem-vindo, <?=$_SESSION['nome']?></h2>
            <nav class="menu">
                <ul>
                    <li><a href="?a=user_account" onclick="mostrarConteudo('perfil')"><i class='bx bx-user'></i> Perfil</a></li>
                    <li><a href="#pedidos" onclick="mostrarConteudo('pedidos')"><i class='bx bx-receipt'></i> Pedidos</a></li>
                    <li><a href="#configuracoes" onclick="mostrarConteudo('configuracoes')"><i class='bx bx-cog'></i> Configurações</a></li>
                    <li><a href="?a=sair"><i class='bx bx-log-out'></i> Sair</a></li>
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
    
            <!-- Seção Pedidos -->
            <section id="pedidos" class="painel-secao" style="display: none;">
                <h1><i class='bx bx-receipt'></i> Resumo dos Pedidos</h1>
                <div class="order-card">
                    <h2><i class='bx bx-package'></i> Pedido #1234</h2>
                    <p><strong>Total:</strong> R$ 150,00</p>
                    <div class="status-bar">
                        <div class="status-step complete"><i class='bx bx-check-circle'></i> Pedido Recebido</div>
                        <div class="status-step complete"><i class='bx bx-loader-circle'></i> Em Processamento</div>
                        <div class="status-step current"><i class='bx bx-car'></i> Em Trânsito</div>
                        <div class="status-step"><i class='bx bx-home'></i> Entregue</div>
                    </div>
                </div>
    
                <div class="order-card">
                    <h2>Pedido #1235</h2>
                    <p><strong>Total:</strong> R$ 250,00</p>
                    <div class="status-bar">
                        <div class="status-step complete">Pedido Recebido</div>
                        <div class="status-step current">Em Processamento</div>
                        <div class="status-step">Em Trânsito</div>
                        <div class="status-step">Entregue</div>
                    </div>
                </div>
    
                <div class="order-card">
                    <h2>Pedido #1236</h2>
                    <p><strong>Total:</strong> R$ 100,00</p>
                    <div class="status-bar">
                        <div class="status-step complete">Pedido Recebido</div>
                        <div class="status-step">Em Processamento</div>
                        <div class="status-step">Em Trânsito</div>
                        <div class="status-step canceled">Cancelado</div>
                    </div>
                </div>
            </section>
    
            <!-- Seção Configurações -->
            <section id="configuracoes" class="painel-secao" style="display: none;">
                <h1><i class='bx bx-cog'></i> Configurações</h1>
                <form method="post" action="?a=atualizar_configuracoes">
    
                    <!-- Informações de Conta -->
                    <div class="info-group">
                        <h3><i class='bx bx-user-circle'></i> Informações Pessoais</h3>
                        <p><strong>Nome completo atual:</strong> João Silva</p>
                        <label for="nome_completo">Novo Nome</label>
                        <input type="text" id="nome_completo" name="nome_completo" value="João Silva" required>
                        <label for="nome_completo">Novo Sobrenome</label>
                        <input type="text" id="nome_completo" name="nome_completo" value="João Silva" required>
                        <label for="nome_completo">Novo E-mail</label>
                        <input type="text" id="nome_completo" name="nome_completo" value="João Silva" required>
                        <label for="nome_completo">Novo CPF</label>
                        <input type="text" id="nome_completo" name="nome_completo" value="João Silva" required>
                        <label for="nome_completo">Novo Telefone</label>
                        <input type="text" id="nome_completo" name="nome_completo" value="João Silva" required>
                        <p><strong>Data de Nascimento:</strong> 01/01/1990</p>
                        <label for="data_nascimento">Nova data de nascimento</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" value="1990-01-01" required>
                        <button type="submit" class="btn-atualizar-config"><i class='bx bx-save'></i> Salvar Informações</button>
                    </div>
                </form>

                <form method="post" action="?a=atualizar_configuracoes">
                    <div class="info-group">
                        <h3><i class='bx bx-user-circle'></i> Endereço</h3>
                        <p><strong>Endereço atual:</strong> Rua Exemplo, 123, Cidade, Estado</p>
                        <label for="endereco">CEP</label>
                        <input type="text" id="endereco" name="endereco" value="Rua Exemplo, 123, Cidade, Estado" required>
                        <label for="endereco">Cidade</label>
                        <input type="text" id="endereco" name="endereco" value="Rua Exemplo, 123, Cidade, Estado" required>
                        <label for="endereco">Bairro</label>
                        <input type="text" id="endereco" name="endereco" value="Rua Exemplo, 123, Cidade, Estado" required>
                        <label for="endereco">Rua</label>
                        <input type="text" id="endereco" name="endereco" value="Rua Exemplo, 123, Cidade, Estado" required>
                        <label for="endereco">Numero</label>
                        <input type="text" id="endereco" name="endereco" value="Rua Exemplo, 123, Cidade, Estado" required>
                        <label for="endereco">Complemento</label>
                        <input type="text" id="endereco" name="endereco" value="Rua Exemplo, 123, Cidade, Estado" required>
                        <label for="endereco">Apelido</label>
                        <input type="text" id="endereco" name="endereco" value="Rua Exemplo, 123, Cidade, Estado" required>
    
                        
                        <button type="submit" class="btn-atualizar-config"><i class='bx bx-save'></i> Salvar Informações</button>
                    </div>
                </form>
    
                    <!-- Segurança -->
                <form method="post" action="?a=atualizar_seguranca">
                    <div class="info-group">
                        <h3><i class='bx bx-shield'></i> Segurança</h3>
                        <label for="senha_atual">Senha Atual</label>
                        <input type="password" id="senha_atual" name="senha_atual" required>
    
                        <label for="nova_senha">Nova Senha</label>
                        <input type="password" id="nova_senha" name="nova_senha" required>
    
                        <label for="confirmar_senha">Confirmar Nova Senha</label>
                        <input type="password" id="confirmar_senha" name="confirmar_senha" required>
                        <button type="submit" class="btn-atualizar-config"><i class='bx bx-save'></i> Salvar Configurações</button>
                    </div>
                </form>
            </section>
        </main>
    </div>

<script>
    function mostrarConteudo(secao) {
        document.querySelectorAll('.painel-secao').forEach(s => s.style.display = 'none');
        document.getElementById(secao).style.display = 'block';
    }
</script>
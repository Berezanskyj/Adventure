<link rel="stylesheet" href="assets/css/registro_endereco.css">

<div class="body">
    <div class="container">
        <div class="form-box">
            <form class="UserInformationForm" id="UserInformationForm">
                <h2>Registrar</h2>
                <div class="input-box">
                    <input type="text" name="nome" id="nome" autocomplete="new-password" required>
                    <label for="">Nome</label>
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="sobrenome" id="sobrenome" autocomplete="new-password" required>
                    <label for="">Sobrenome</label>
                    <i class='bx bx-user-circle'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" id="email" autocomplete="off" required>
                    <label for="">E-mail</label>
                    <i class='bx bx-mail-send'></i>
                </div>
                <div class="input-box">
                    <input type="tel" name="telefone" id="telefone" autocomplete="new-password" required>
                    <label for="">Telefone</label>
                    <i class='bx bx-phone'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="senha" id="senha" autocomplete="off" required>
                    <label for="">Senha</label>
                    <i class='bx bx-lock'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="confirma_senha" id="confirma_senha" autocomplete="off" required>
                    <label for="">Confirme sua Senha</label>
                    <i class='bx bx-lock-alt'></i>
                </div>
                <button type="submit" class="btnUserInformation">Registrar</button>
            </form>

            <form method="post" class="UserAddressForm" action="?a=criar_endereco">
                <h2>Endereço</h2>
                <div class="input-box-cep">
                    <div class="cep-container">
                        <input type="text" name="cep" id="cep" autocomplete="new-password" required>
                        <label for="cep">Cep</label>
                        <button type="button" id="pesquisaCEP" class="btn-cep" onclick="consultaEndereco()"><i class='bx bx-search-alt'></i></button>
                    </div>
                </div>
                <div class="input-box">
                    <input type="text" name="cidade" id="cidade" autocomplete="new-password" required>
                    <label for="">Cidade</label>
                    <i class='bx bx-map'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="bairro" id="bairro" autocomplete="new-password" required>
                    <label for="">Bairro</label>
                    <i class='bx bx-buildings'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="rua" id="rua" autocomplete="off" required>
                    <label for="">Rua</label>
                    <i class='bx bx-street-view'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="numero" id="numero" autocomplete="off" required>
                    <label for="">Número</label>
                    <i class='bx bx-hash'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="complemento" id="complemento" autocomplete="new-password">
                    <label for="">Complemento</label>
                    <i class='bx bx-layer'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="apelido" id="apelido">
                    <label for="">Apelido</label>
                    <i class='bx bx-id-card'></i>
                </div>
                <button type="submit" class="btnUserAddress" id="formSubmit" onclick="animacao()">Registrar</button>
            </form>
        </div>
    </div>
</div>


<script src="assets/js/registro_endereco.js"></script>
<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/js/mascaras_usuario.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    const UserInformationForm = document.querySelector('.UserInformationForm');
    const UserAddressForm = document.querySelector('.UserAddressForm');
    const btnUserAddress = document.querySelector('.btnUserAddress');
    const btnUserInformation = document.querySelector('.btnUserInformation');

    function animacao(event) {
    event.preventDefault(); // Impede o envio imediato do formulário

    Swal.fire({
        title: "Um e-mail foi enviado!",
        text: "Por favor, verifique para que consiga realizar o login.",
        icon: "info",
        confirmButtonText: "OK",
        customClass: {
            title: 'swal2-title',  // Aplicando a fonte ao título
            content: 'swal2-content' // Aplicando a fonte ao conteúdo
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formSubmit").submit(); // Submete o formulário
        }
    });
}

    window.onload = function(){
        UserAddressForm.classList.add('active');
        UserInformationForm.classList.add('active');
    }
    
</script>
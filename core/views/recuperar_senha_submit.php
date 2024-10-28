<link rel="stylesheet" href="assets/css/recuperar_senha.css">

<div class="body">
    <div class="container">
        <div class="form-box">
            <form class="UserInformationForm" id="UserInformationForm">
                <div class="titulo">

                    <h2>Entrar</h2>
                </div>
                <div class="input-box">
                    <input type="email" name="email" id="email" autocomplete="new-password" required>
                    <label for="">Email</label>
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box" id="senha">
                    <input type="password" name="senha" id="senha" autocomplete="new-password" required>
                    <label for="">Senha</label>
                    <i class='bx bx-show' id="ver-senha" onclick="ver_senha()"></i>
                </div>
                <div class="esquece-senha">
                    <span><a href="?a=recuperar_senha">Esqueci minha senha</a></span>
                </div>
                <button type="submit" class="btnUserInformation">Entrar</button>
            </form>

            <form method="post" class="UserAddressForm" action="?a=recuperar_senha_submit">
                <div class="titulo">

                    <h2>Recuperar</h2>
                </div>
                <div class="input-box">
                    <input type="password" name="senha" id="senha" autocomplete="new-password" required>
                    <label for="">Nova senha</label>
                    <i class='bx bx-show' id="ver-senha" onclick="ver_senha()"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="senha" id="senha" autocomplete="new-password" required>
                    <label for="">Repita a senha</label>
                    <i class='bx bx-show' id="ver-senha" onclick="ver_senha()"></i>
                </div>
                <button type="submit" class="btnUserInformation" onclick="animacao()">Recuperar</button>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const UserInformationForm = document.querySelector('.UserInformationForm');
    const UserAddressForm = document.querySelector('.UserAddressForm');
    const btnUserAddress = document.querySelector('.btnUserAddress');
    const btnUserInformation = document.querySelector('.btnUserInformation');

    function ver_senha(){
        if (senha.type === 'password') {
            senha.type = 'text';  // Mostra a senha
            icone.classList.remove('bxs-show');  // Remove o ícone de "mostrar"
            icone.classList.add('bxs-hide');  // Adiciona o ícone de "esconder"
        } else {
            senha.type = 'password';  // Esconde a senha
            icone.classList.remove('bxs-hide');  // Remove o ícone de "esconder"
            icone.classList.add('bxs-show');  // Adiciona o ícone de "mostrar"
        }
    }

    

    window.onload = function() {
        UserInformationForm.classList.add('active');
        UserAddressForm.classList.add('active');
    }
</script>

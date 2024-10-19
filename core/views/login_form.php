<link rel="stylesheet" href="assets/css/login_form.css">

<div class="body">
    <div class="container">
        <div class="form-box">
            <form method="post" class="UserInformationForm" id="UserInformationForm" autocomplete="new-password" action="?a=login_submit" >
                <div class="titulo">

                    <h2>Entrar</h2>
                </div>
                <div class="input-box">
                    <input type="email" name="email" id="email" autocomplete="new-password" required>
                    <label for="">Email</label>
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="senha" id="senha" autocomplete="new-password" required>
                    <label for="">Senha</label>
                    <i class='bx bx-show' id="ver-senha" onclick="ver_senha()"></i>
                </div>
                <button type="submit" class="btnUserInformation">Entrar</button>

                <?php if(isset($_SESSION['erro'])):?>
                    <script>
                        Swal.fire({
                        title: "Login Invalido",
                        icon: "error",
                        confirmButtonText: "OK",
                        customClass: {
                            title: 'swal2-title',  // Aplicando a fonte ao título
                            content: 'swal2-content' // Aplicando a fonte ao conteúdo
                        }}).then((result) =>{
                            if(result.isConfirmed) {
                                window.location.href = '?a=login';
                            }
                        });
                    </script>
                    <?php unset($_SESSION['erro'])?>
                <?php endif; ?>

            </form>
        </div>
    </div>
</div>


<script>
    senha = document.getElementById('senha');
    icone = document.getElementById('ver-senha');

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

</script>

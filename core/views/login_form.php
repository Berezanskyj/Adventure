<link rel="stylesheet" href="assets/css/login_form.css">

<div class="body">
    <div class="container">
        <div class="form-box">
            <form method="post" class="UserInformationForm" id="UserInformationForm" action="?a=login_submit" >
                <div class="titulo">

                    <h2>Entrar</h2>
                </div>
                <div class="input-box">
                    <input type="email" name="email" id="email" required>
                    <label for="">Email</label>
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box" id="senha">
                    <input type="password" name="senha" id="senha" required>
                    <label for="">Senha</label>
                    <i class='bx bx-show' id="ver-senha" onclick="ver_senha()"></i>
                </div>
                <div class="esquece-senha">
                    <span><a href="?a=recuperar_senha">Esqueci minha senha</a></span>                
                </div>
                <button type="submit" class="btnUserInformation">Entrar</button>

                <?php if(isset($_SESSION['erro'])):?>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        Swal.fire({
                        icon: "info",
                        title: "Erro!",
                        text: "<?=$_SESSION['erro']?>!",
                        }).then((result) =>{
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
    function ver_senha(){
        let senha = document.getElementById('senha'); // Captura dentro da função
        let icone = document.getElementById('ver-senha'); // Captura dentro da função

        if (senha.type === 'password') {
            senha.type = 'text';  // Mostra a senha
            icone.classList.remove('bx-show');  // Remove o ícone de "mostrar"
            icone.classList.add('bx-hide');  // Adiciona o ícone de "esconder"
        } else {
            senha.type = 'password';  // Esconde a senha
            icone.classList.remove('bx-hide');  // Remove o ícone de "esconder"
            icone.classList.add('bx-show');  // Adiciona o ícone de "mostrar"
        }
    }
</script>

<link rel="stylesheet" href="assets/css/login.css">

<div class="login-container">
        <h1>Login</h1>
        <form action="?a=login_admin_submit" method="POST">
            <label for="username">Usuário</label>
            <input type="text" id="username" name="username" placeholder="Digite seu usuário" required>

            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha" required>

            <button type="submit">Entrar</button>
            <?php if (isset($_SESSION['erro'])): ?>
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    Swal.fire({
                                        icon: "error",
                                        title: "Erro!",
                                        text: "<?= $_SESSION['erro'] ?>!",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = '?a=login';
                                        }
                                    });
                                </script>
                                <?php unset($_SESSION['erro']) ?>
                            <?php endif; ?>
        </form>
    </div>

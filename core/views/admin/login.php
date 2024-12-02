<div class="d-flex align-items-center justify-content-center vh-100 bg-dark text-light">


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <!-- Logo centralizada -->
                        <div class="text-center mb-4">
                            <img src="assets/images/logo-preto.png" alt="Logo" class="logo">
                        </div>
                        <form action="?a=login_admin_submit" method="POST">
                            <!-- Campo para o nome de usuário -->
                            <div class="mb-3">
                                <label for="username" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="username" name="username" required>
                            </div>
                            <!-- Campo para a senha -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <!-- Botão de login -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>


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
                </div>
            </div>
        </div>
    </div>
<?php
session_start();
$title = "Registrar-se";
include_once("templates/header.php");
?>

<main class="d-flex flex-column align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="card shadow-sm border-0 rounded-md bg-body-tertiary">
                    <div class="card-header bg-primary text-white text-center p-4">
                        <h3 class="mb-0">Crie sua conta</h3>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <h4 class="text-center mb-4">Preencha seus dados</h4>
                        <form action="actions/register.php" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Lucas" required>
                                <label for="name"><i class="bi bi-person me-1"></i>Seu nome</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="seuemail@email.com" required>
                                <label for="email"><i class="bi bi-envelope me-1"></i>E-mail</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="suasenha" required>
                                <label for="password"><i class="bi bi-lock me-1"></i>Senha</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg text-white py-2 fw-bold" type="submit">
                                    <i class="bi bi-person-plus me-1"></i>Registrar-se
                                </button>
                            </div>
                            <div class="text-center mt-4">
                                <p class="mb-0">Já tem uma conta? <a href="login.php" class="text-primary fw-bold">Faça login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once("templates/footer.php");
?>
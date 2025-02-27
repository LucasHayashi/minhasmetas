<?php
session_start();
require_once("class/Auth.class.php");
$authInfo = new Auth();

if ($authInfo->isLogged()) {
    header('Location: dashboard.php');
}

$title = "Entrar";
include_once("templates/header.php");

?>
<main class="d-flex flex-column align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="card shadow-sm border-0 rounded-md bg-body-tertiary">
                    <div class="card-header bg-primary text-white text-center p-4">
                        <h3 class="mb-0">Bem-vindo(a) de volta!</h3>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <h4 class="text-center mb-4">Faça o login para continuar</h4>
                        <form action="actions/login.php" method="POST">
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
                                    <i class="bi bi-box-arrow-in-right me-1"></i>Entrar
                                </button>
                            </div>
                            <div class="text-center mt-4">
                                <p class="mb-0">Não tem uma conta? <a href="register.php" class="text-primary fw-bold">Crie uma</a></p>
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
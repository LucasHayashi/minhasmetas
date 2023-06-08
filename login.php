<?php
session_start();
$title = "Entrar";
include_once("templates/header.php");

if ($authInfo->isLogged()) {
    header('Location: dashboard.php');
}

$message = "";
$bsClass = "";

$alert = [];

if (isset($_GET['message'])) {
    $alert['message'] = $_GET['message'];
    $alert['class'] = $_GET['class'];
}
?>
<main class="m-auto">
    <form action="actions/login.php" method="post">
        <h1 class="h3 mb-3 fw-normal">Faça o login para continuar</h1>
        <?php
        if ($alert) {
            echo '<div class="alert alert-' . $alert['class'] . '" role="alert">' . $alert['message'] . '</div>';
        }
        ?>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="seuemail@email.com" required>
            <label for="email">E-mail</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="suasenha" required>
            <label for="password">Senha</label>
        </div>
        <button class="btn btn-primary w-100 py-2 mb-1" type="submit">Entrar</button>
        <p><strong>Não tem uma conta? <a href="register.php" target="_blank">Crie uma</a>.</strong></p>
    </form>
</main>
<?php
include_once("templates/footer.php");
?>
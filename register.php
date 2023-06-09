<?php
$title = "Registrar-se";
include_once("templates/header.php");
include_once("funcoes.php");
?>

<main class="m-auto">
    <form action="actions/register.php" method="post">
        <h1 class="h3 mb-3 fw-normal">Faça o login para continuar</h1>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="Lucas" required>
            <label for="name">Seu nome</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="seuemail@email.com" required>
            <label for="email">E-mail</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="suasenha" required>
            <label for="password">Senha</label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Registrar-se</button>
    </form>
</main>

<?php
include_once("templates/footer.php");

printQueryParamAlert();

?>
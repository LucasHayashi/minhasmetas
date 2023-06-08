<?php
session_start();
$title = "Início";
include_once("templates/header.php");
?>

<main class="flex-shrink-0">
    <div class="container">
        <div class="row" id="introducao">
            <p>Introdução do site</p>
            <strong>Página em desenvolvimento...</strong>
        </div>
        <div class="row" id="features">
            <p>Features do site</p>
        </div>
        <div class="row" id="contato">
            <p>Contato do site</p>
        </div>
    </div>
</main>
<?php
include_once("templates/footer.php");
?>
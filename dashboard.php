<?php
$title = "Início";
require_once("guards/dashboard-guard.php");
include("templates/header.php");

$message = "";
$bsClass = "";

$alert = [];

if (isset($_GET['message'])) {
    $alert['message'] = $_GET['message'];
    $alert['class'] = $_GET['class'];
}
?>

<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-2">Todas</h1>
        <hr>
        <?php
        if ($alert) {
            echo '<div class="alert alert-' . $alert['class'] . '" role="alert">' . $alert['message'] . '</div>';
        }
        ?>
        <!-- Alerta gerada via Javascript -->
        <div id="alert-js-error"></div>

        <!-- DataTable -->
        <table id="tbl-minhas-metas" class="display nowrap" style="width:100%">
            <!-- Conteúdo da tabela -->
        </table>

        <!-- Modal -->
        <div class="modal fade" id="meuModal">
            <!-- Conteúdo do modal -->
        </div>
    </div>
</main>

<?php
include_once("templates/footer.php");
?>
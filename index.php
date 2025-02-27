<?php
$title = "Minhas Metas - Registre e acompanhe suas metas pessoais";
include_once("templates/header.php");
?>
<main class="d-flex flex-column align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row justify-content-center m-2">
            <div class="col-12 col-md-8 col-lg-6 text-center p-4 shadow-sm border-0 bg-body-tertiary">
                <div class="image">
                    <img src="invest.svg" alt="Ilustração de completar metas" class="img-fluid" style="max-width: 250px;">
                </div>

                <div class="title mt-4">
                    <h1 class="fw-bold">Minhas Metas</h1>
                </div>

                <div class="subtitle mt-2">
                    <h2 class="fs-4 text-muted">Defina e acompanhe suas metas pessoais</h2>
                </div>

                <div class="action mt-4">
                    <a href="login.php" class="btn btn-primary btn-lg">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Acessar
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once("templates/footer.php");
?>
<?php
$title = "Criar nova meta";
require_once("guards/dashboard-guard.php");
include_once("templates/header.php");
?>

<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-2">Criar nova meta</h1>
        <hr>
        <form action="actions/salvar-meta.php" method="POST" id="criar-nova-meta" class="row g-3">
            <div class="col-md-12">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" aria-label="Titulo da meta" required>
            </div>
            <div class="col-md-6">
                <label for="valor_total" class="form-label">Total da Meta</label>
                <div class="input-group">
                    <span class="input-group-text">R$</span>
                    <input type="text" class="form-control brl" id="valor_total" name="valor_total" aria-label="Valor total da meta" required>
                </div>
            </div>
            <div class="col-md-6">
                <label for="valor_atual" class="form-label">Valor atual</label>
                <div class="input-group">
                    <span class="input-group-text">R$</span>
                    <input type="text" class="form-control brl" id="valor_atual" name="valor_atual" aria-label="Valor atual da meta" required>
                </div>
            </div>
            <div class="col-md-6">
                <label for="data_limite" class="form-label">Data Limite</label>
                <input type="text" class="form-control datepicker date" id="data_limite" name="data_limite" aria-label="Data limite para conclusão da meta" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</main>

<?php
$extraScripts = ["js/metas.js"];
include_once("templates/footer.php");
?>
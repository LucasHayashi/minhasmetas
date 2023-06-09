<?php
$title = "Início";
require_once("guards/dashboard-guard.php");
include_once("templates/header.php");
include_once("funcoes.php");
?>

<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-2">Todas</h1>
        <hr>
        <!-- DataTable -->
        <table id="tbl-minhas-metas" class="display nowrap" style="width:100%">
            <!-- Conteúdo da tabela -->
        </table>

        <!-- Modal Excluir Meta -->
        <div class="modal fade" id="modalExcluirMeta">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja realizar a exclusão da meta?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-success" id="btn-confirmar-exclusao" onclick="excluirMeta(this);">Sim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once("templates/footer.php");

printQueryParamAlert();

?>
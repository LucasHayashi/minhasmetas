<?php
$title = "Editar meta";

if (isset($_GET['id_meta']) == false) {
    header('Location: dashboard.php');
}

require_once("guards/dashboard-guard.php");
include_once("templates/header.php");
require_once("class/Database.class.php");

$id_meta = $_GET['id_meta'];
$con = Database::getConexao();
$redirectUrl = "";

$sql = "select titulo, 
               valor_total, 
               valor_inicial, 
               data_limite 
            from metas 
            where id_meta = :id_meta";

$stmt = $con->prepare($sql);
$stmt->bindParam(":id_meta", $id_meta);
$stmt->execute();
$meta = $stmt->fetch(PDO::FETCH_ASSOC);
$titulo = $meta['titulo'];
$valor_total = $meta['valor_total'];
$valor_inicial = $meta['valor_inicial'];
$data_limite = date("d/m/Y", strtotime($meta['data_limite']));
?>

<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-2">Atualizar meta</h1>
        <hr>
        <form action="actions/editar-meta.php" method="POST" id="atualiizar-meta" class="row g-3">
            <input type="hidden" name="id_meta" value="<?php echo $id_meta ?>" />
            <div class="col-md-12">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" aria-label="Titulo da meta" value="<?php echo $titulo; ?>" required />
            </div>
            <div class="col-md-6">
                <label for="valor_total" class="form-label">Total da Meta</label>
                <div class="input-group">
                    <span class="input-group-text">R$</span>
                    <input type="text" class="form-control brl" id="valor_total" name="valor_total" aria-label="Valor total da meta" value="<?php echo $valor_total; ?>" required />
                </div>
            </div>
            <div class="col-md-6">
                <label for="valor_atual" class="form-label">Valor atual</label>
                <div class="input-group">
                    <span class="input-group-text">R$</span>
                    <input type="text" class="form-control brl" id="valor_atual" name="valor_atual" aria-label="Valor atual da meta" value="<?php echo $valor_inicial; ?>" required />
                </div>
            </div>
            <div class="col-md-6">
                <label for="data_limite" class="form-label">Data Limite</label>
                <input type="text" class="form-control datepicker date" id="data_limite" name="data_limite" aria-label="Data limite para conclusão da meta" value="<?php echo $data_limite; ?>" required />
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>
    </div>
</main>

<?php
$extraScripts = ["js/metas-script.js"];
include_once("templates/footer.php");
?>
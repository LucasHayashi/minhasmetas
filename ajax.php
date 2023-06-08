<?php
session_start();
require_once("class/Database.class.php");
$con = Database::getConexao();

$acao = $_REQUEST['acao'];

$url = "";

if ($acao == 'carregar-metas') {
    $dados['data'] = array();
    $sql = "SELECT * FROM metas WHERE id_usuario = :id_usuario";
    $query = $con->prepare($sql);
    $query->bindValue('id_usuario', $_SESSION['id_usuario']);
    $query->execute();
    $dados['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
} else if ($acao == 'excluir-meta') {
    $data = ["id_meta" => $_REQUEST['id_meta']];

    $sql = "DELETE FROM metas WHERE id_meta = :id_meta";
    $query = $con->prepare($sql);
    $query->execute($data);

    if ($query->rowCount() > 0) {

        $dados = array(
            'message' => "Meta excluída com sucesso",
            'class' => 'success',
            'status' => 204
        );
    } else {
        $dados = array(
            'message' => "Nenhuma meta foi excluída",
            'class' => 'danger',
            'status' => 400
        );
    }
}

die(json_encode($dados));

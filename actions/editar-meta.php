<?php
session_start();
include_once("../includes/conexao.php");

$url = "";
$id_meta = $_POST['id_meta'];
$titulo = $_POST['titulo'];
$valor_atual = $_POST['valor_atual'];
$valor_total = $_POST['valor_total'];
$data_limite = $_POST['data_limite'];
$data_formatada = date("Y-m-d",  strtotime(str_replace('/', '-', $data_limite)));

$data = [
    "titulo" => $titulo,
    "valor_atual" => $valor_atual,
    "valor_total" => $valor_total,
    "data_limite" => $data_formatada,
    "id_meta" => $id_meta
];

$sql = "UPDATE metas 
            SET titulo = :titulo, 
                valor_total = :valor_total, 
                valor_inicial = :valor_atual, 
                data_limite = :data_limite
            WHERE id_meta = :id_meta";

$insert = $con->prepare($sql);

if ($insert->execute($data)) {
    $_SESSION['message'] = "Meta atualizada com sucesso!";
    $_SESSION['class'] = "success";
} else {
    $_SESSION['message'] = "Ops! Ocorreu um erro ao atualizar sua meta";
    $_SESSION['class'] = "danger";
}

header('Location: ../dashboard.php');
exit();

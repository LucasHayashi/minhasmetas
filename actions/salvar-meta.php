<?php
session_start();
include_once("../includes/conexao.php");

$url = "";
$titulo = $_POST['titulo'];
$valor_atual = $_POST['valor_atual'];
$valor_total = $_POST['valor_total'];
$data_limite = $_POST['data_limite'];
$data_formatada = date("Y-m-d",  strtotime(str_replace('/', '-', $data_limite)));

$data = [
    "id_usuario" => $_SESSION['id_usuario'],
    "titulo" => $titulo,
    "valor_atual" => $valor_atual,
    "valor_total" => $valor_total,
    "data_limite" => $data_formatada
];

$sql = "INSERT INTO metas (id_usuario, titulo, valor_total, valor_inicial, data_limite)
            VALUES (:id_usuario, :titulo,:valor_total, :valor_atual, :data_limite)";

$insert = $con->prepare($sql);

if ($insert->execute($data)) {
    $_SESSION['message'] = "Meta salva com sucesso!";
    $_SESSION['class'] = "success";
} else {
    $_SESSION['message'] = "Ops! Ocorreu um erro ao salvar sua meta";
    $_SESSION['class'] = "danger";
}

header('Location: ../dashboard.php'); // Redireciona para dashboard.php
exit();

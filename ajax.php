<?php
session_start();
require_once("includes/conexao.php");

$acao = $_POST['acao'];

if ($acao == 'carregar-metas') {
	$dados['data'] = array();
	$sql = "SELECT * FROM metas WHERE id_usuario = :id_usuario";
	$query = $con->prepare($sql);
	$query->bindValue('id_usuario', $_SESSION['id_usuario']);
	$query->execute();
	$dados['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
} else if ($acao == 'excluir-meta') {
	$sql = "DELETE FROM metas WHERE id_meta = :id_meta";
	$query = $con->prepare($sql);
	$query->bindValue('id_meta', $_POST['idMeta']);
	$query->execute();

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

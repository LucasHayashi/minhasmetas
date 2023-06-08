<?php
require_once("../class/Database.class.php");
require_once("../class/Auth.class.php");

$con = Database::getConexao();
$redirectUrl = "";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "select * from users where email = :email";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_usuario = $dados['id_usuario'];
        $name = $dados['name'];

        if (password_verify($password, $dados['password'])) {
            $authUser = new Auth();
            $authUser->setUserSession($id_usuario, $name);
            $redirectUrl = "../dashboard.php";
        } else {
            $redirectUrl = "../login.php?message=Senha incorreta!&class=danger";
        }
    } else {
        $redirectUrl = "../login.php?message=Usuário não encontrado!&class=danger";
    }
} else {
    $redirectUrl = "../login.php?message=Informe todos os campos obrigatórios!&class=danger";
}

header('Location: ' . $redirectUrl);

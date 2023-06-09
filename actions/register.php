<?php
require_once("../class/Database.class.php");

$con = Database::getConexao();
$return = array();
$redirectUrl = "";

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "select * from users where email = :email";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        $data = array(
            "name" => $name,
            "email" => $email,
            "password" => $hashedPassword
        );

        $sql = "insert into users (name, email, password) values (:name, :email, :password)";
        $smtm = $con->prepare($sql);

        if ($smtm->execute($data)) {
            $redirectUrl = "../login.php?message=Usuário criado com sucesso!&class=success";
        } else {
            $redirectUrl = "../register.php?message=Ops! Ocorreu um erro ao criar seu usuário, tente novamente!&class=error";
        }
    } else {
        $redirectUrl = "../register.php?message=Usuário já existente!&class=error";
    }
} else {
    $redirectUrl = "../register.php?message=Informe todos os campos obrigatórios!&class=error";
}

header('Location: ' . $redirectUrl);

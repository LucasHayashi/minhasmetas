<?php
session_start();
include_once("../includes/conexao.php");

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        $data = array(
            "name" => $name,
            "email" => $email,
            "password" => $hashedPassword
        );

        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $con->prepare($sql);

        if ($stmt->execute($data)) {
            $_SESSION['message'] = "Usuário criado com sucesso!";
            $_SESSION['class'] = "success";
            $redirectUrl = "../login.php";
        } else {
            $_SESSION['message'] = "Ops! Ocorreu um erro ao criar seu usuário, tente novamente!";
            $_SESSION['class'] = "danger";
            $redirectUrl = "../register.php";
        }
    } else {
        $_SESSION['message'] = "Usuário já existente!";
        $_SESSION['class'] = "danger";
        $redirectUrl = "../register.php";
    }
} else {
    $_SESSION['message'] = "Informe todos os campos obrigatórios!";
    $_SESSION['class'] = "danger";
    $redirectUrl = "../register.php";
}

header('Location: ' . $redirectUrl);
exit();

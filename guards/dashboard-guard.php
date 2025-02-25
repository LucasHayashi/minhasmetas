<?php
session_start();
require_once("class/Auth.class.php");
$authInfo = new Auth();

if (!$authInfo->isLogged()) {
    $_SESSION['message'] = "Sem permissão para acessar esta página!";
    $_SESSION['class'] = "error";
    header('Location: login.php');
    exit();
}

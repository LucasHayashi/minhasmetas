<?php
session_start();
require_once("class/Auth.class.php");
$authInfo = new Auth();

if (!$authInfo->isLogged()) {
    header('Location: login.php?message=Sem permissão para acessar esta página!&class=danger');
}

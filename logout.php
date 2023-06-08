<?php
require_once("class/Auth.class.php");

$auth = new Auth();

if ($auth->isLogged()) {
    $auth->unsetUserSession();
}

header("Location: login.php");
?>
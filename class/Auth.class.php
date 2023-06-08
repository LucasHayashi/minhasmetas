<?php

class Auth
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public function isLogged()
    {
        return isset($_SESSION['id_usuario']);
    }

    public function setUserSession($id_usuario, $nm_usuario)
    {
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['nm_usuario'] = $nm_usuario;
    }

    public function unsetUserSession()
    {
        unset($_SESSION['id_usuario']);
        unset($_SESSION['nm_usuario']);
    }

    public function getUserName() {
        return $_SESSION['nm_usuario'];
    }
}

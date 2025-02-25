<?php
function printSessionAlert()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['message'])) {
        $alertMessage = $_SESSION['message'];
        $notifyClass = $_SESSION['class'];

        unset($_SESSION['message']);
        unset($_SESSION['class']);

        echo "<script>notify('" . htmlspecialchars($alertMessage) . "', '$notifyClass');</script>";
    }
}

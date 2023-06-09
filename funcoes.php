<?php

function printQueryParamAlert()
{
    $alertMessage = "";
    $notifyClass = "";

    if (isset($_GET['message'])) {
        $alertMessage = $_GET['message'];
        $notifyClass = $_GET['class'];

        echo "<script>notify('$alertMessage', '$notifyClass');</script>";
    }
}

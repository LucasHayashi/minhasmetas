<?php
require_once("class/Auth.class.php");
$authInfo = new Auth();
?>

<!DOCTYPE html>
<html lang="pt-BR" class="h-100" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="index.php">MinhasMetas</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav main me-auto mb-2 mb-lg-0">
                        <?php if ($authInfo->isLogged()) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">Dashboard</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <!-- Escola do tema -->
                    <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle current-theme" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"></a>
                                <ul class="dropdown-menu themes-list">
                                    <li>
                                        <a class="dropdown-item" href="#" data-theme="light">
                                            <i class="bi bi-brightness-high"></i> Claro
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" data-theme="dark">
                                            <i class="bi bi-moon-stars-fill"></i> Escuro
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" data-theme="auto">
                                            <i class="bi bi-circle-half"></i> Auto
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <?php if ($authInfo->isLogged()) : ?>
                                    <div class="dropdown">
                                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                            Bem vindo, <?php echo $authInfo->getUserName(); ?>!
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="nav-link" href="logout.php">Sair</a></li>
                                        </ul>
                                    </div>
                                <?php else : ?>
                                    <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
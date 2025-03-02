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
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&family=Montserrat:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        (function() {
            const userMode = localStorage.getItem("bs-theme");
            const sysMode = window.matchMedia("(prefers-color-scheme: light)").matches;
            const useSystem = !userMode;
            const modeChosen = useSystem ? (sysMode ? "light" : "dark") : userMode;

            document.documentElement.setAttribute("data-bs-theme", modeChosen);
        })();
    </script>
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="logo.png" alt="Minhas Metas" height="32">
                    MinhasMetas
                </a>
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
                        <ul class="navbar-nav align-items-sm-center">
                            <li class="nav-item">
                                <div class="mode-switch">
                                    <button title="Use dark mode" id="dark" class="btn btn-sm btn-default text-secondary">
                                        <i class="bi bi-moon"></i>
                                    </button>
                                    <button title="Use light mode" id="light" class="btn btn-sm btn-default text-secondary">
                                        <i class="bi bi-sun"></i>
                                    </button>
                                    <button title="Use system preferred mode" id="system" class="btn btn-sm btn-default text-secondary">
                                        <i class="bi bi-display"></i>
                                    </button>
                                </div>
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
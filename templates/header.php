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
    <link rel="stylesheet" href="includes/bootstrap-5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/DataTables/datatables.min.css" />
    <link rel="stylesheet" href="includes/bootstrap-datepicker-1.10.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="includes/jquery-3.7.0/jquery-3.7.0.min.js"></script>
    <script src="includes/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function setActiveTheme(theme) {
            if (theme === null) {
                theme = "dark";
            }
            localStorage.setItem('theme', theme);
            $('html').attr('data-bs-theme', theme);
        }

        function getActiveTheme() {
            return localStorage.getItem('theme');
        }

        setActiveTheme(getActiveTheme());
    </script>
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

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Ferramentas</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="nova-meta.php">Nova Meta</a></li>
                                </ul>
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
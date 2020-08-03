<?php require_once "config.php"?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="assets/css/flickity.css" rel="stylesheet" type="text/css" media="all" />
    <link href="assets/css/stack-interface.css" rel="stylesheet" type="text/css" media="all" />
    <link href="assets/css/theme.css" rel="stylesheet" type="text/css" media="all" />
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" media="all" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700" rel="stylesheet">
    <title>Classificados</title>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">Classificados</a>
            </div>
            <ul class="navbar-nav navbar-right navbar-text">
                <?php if(isset($_SESSION["cLogin"]) && empty($_SESSION["cLogin"]) == false):?>
                    <li><a href="meus-anuncios.php">Meus anúncios</a></li>
                    <li><a href="sair.php">Sair</a></li>
                <?php else: ?>
                    <li><a href="cadastre-se.php">Cadastre-se</a></li>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/flickity.min.js"></script>
    <script src="assets/js/parallax.js"></script>
    <script src="assets/js/smooth-scroll.min.js"></script>
    <script src="assets/js/scripts.js"></script>
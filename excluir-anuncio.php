<?php
if(empty($_SESSION["cLogin"])){
    header("Location: login.php");
}

require_once "classes/anuncios.class.php";
$anuncio = new Anuncios();

if(isset($_GET["id"]) && empty($_GET["id"]) == false){
    $anuncio->deletarAnuncio($_GET["id"]);
}

header("Location: meus-anuncios.php");
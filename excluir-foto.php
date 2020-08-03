<?php
if(empty($_SESSION["cLogin"])){
    header("Location: login.php");
}

require_once "classes/anuncios.class.php";
$anuncio = new Anuncios();

if(isset($_GET["id"]) && empty($_GET["id"]) == false){
    $id_anuncio = $anuncio->excluirFoto($_GET["id"]);
}

if(isset($id_anuncio)){
    header("Location: editar-anuncio.php?id=".$id_anuncio);
}else{
    header("Location: meus-anuncios.php");
}

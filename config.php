<?php
session_start();
global $pdo;
try{
    $pdo = new PDO("mysql:dbname=classificados;host=127.0.0.1", "root");
}catch(PDOException $e){
    echo "ERRO: ".$e->getMessage();
}
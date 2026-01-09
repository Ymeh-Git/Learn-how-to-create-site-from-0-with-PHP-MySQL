<?php 

function getPDO(){

    $server = "localhost";
    $username = "root"; //Basique
    $pwd = "";
    $dbName = "session_auth";

    try{

        $pdo= new PDO("mysql:host=$server;dbname=$dbName;charset=utf8mb4", $username, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;

    } catch(PDOException $e){

        echo "Une erreur est survenue ... ".$e->getMessage();
        
    }

}


?>
<?php
// 
function getPDO(){
    $server = "localhost";
    $username = "root"; // Change it if needed
    $pwd = ""; // Change it if needed
    $dbName = "site_vitrine"; // Don't forget to create a DataBase with this name

    try{

        $pdo= new PDO("mysql:host=$server;dbname=$dbName;charset=utf8mb4", $username, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;

    } catch(PDOException $e){

        echo "Une erreur est survenue ... ".$e->getMessage();
        
    }
};

?>
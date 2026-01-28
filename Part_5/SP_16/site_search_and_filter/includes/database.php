<?php
function getPDO(){
    $server = "localhost";
    $dbName = "site_search_and_filter";
    $username = "root";
    $password = "";

    try{
        $pdo = new PDO("mysql:host=$server;dbname=$dbName;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;

    } catch(PDOException $e){
        echo "An error occured while trying to access DB : ". $e;
    }
}


?>
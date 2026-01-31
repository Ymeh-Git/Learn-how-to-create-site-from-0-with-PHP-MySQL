<?php 

function getPDO(){
    try{
        $server="localhost";
        $dbName="site_newsletter";
        $username="root";
        $pwd = "";
    
        $pdo = new PDO("mysql:host=$server;dbname=$dbName;charset=utf8mb4", $username, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        return $pdo;
    } catch(PDOException $e){
        echo "An error occured : $e";
    }
}

?>
<?php

// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

function get_PDO(){
    $server = "localhost";
    $username = "root"; // Change it if needed
    $pwd = ""; // Change it if needed
    $db_name = "site_security"; // Don't forget to create a DataBase with this name

    try{

        $pdo= new PDO("mysql:host=$server;dbname=$db_name;charset=utf8mb4", $username, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo;

    } catch(PDOException $e){

        echo "Une erreur est survenue ... ".$e->getMessage();
        
    }
};

?>
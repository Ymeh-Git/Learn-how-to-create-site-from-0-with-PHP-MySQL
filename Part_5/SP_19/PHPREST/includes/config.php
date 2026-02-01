<?php 

$server = "localhost";
$dbname = "site_API_REST";
$username = "root";
$password = "";

try{
    $pdo = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8mb4", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    define('APP_NAME', 'PHP REST API TUTORIAL');
    // echo "We are in boys";
} catch(PDOExcpetion $e){
    echo "An error occured will connecting to DB : ". $e; 
}

?>
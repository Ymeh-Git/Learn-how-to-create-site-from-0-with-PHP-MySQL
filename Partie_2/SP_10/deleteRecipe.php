<?php
$server = "localhost";
$username = "root";
$pwd = "";
$dbName = "site_recettes"; 


$message="";

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = intval($_GET['id']);
    try {
        $pdo = new PDO("mysql:host=$server;dbname=$dbName;charset=utf8mb4", $username, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM recettes WHERE `recettes`.`id` = :id";

        $request = $pdo->prepare($sql);

        $request->bindValue(':id', $id, PDO::PARAM_INT);

        $request->execute();
        header("Location: page.php");
        exit();
    } catch (PDOException $e) {

        die("Erreur de connexion : " . $e->getMessage());

    }
    
} else {
    header("Location: page.php");
    exit();
}
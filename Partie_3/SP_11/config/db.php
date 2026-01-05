<?php 
// contient la connexion à la BDD
function getPDO(){
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=site_recettes;charset=utf8mb4", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }catch(PDOException $e){
        die("Erreur : ".$e->getMessage());
    }
}
?>
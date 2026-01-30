<?php 
// ./includes/functions.php
require_once ('db.php');

function getProducts(){
    $pdo = getPDO();

    $sql ="SELECT * FROM products";

    $query = $pdo->query($sql);
    $products = $query->fetchAll(PDO::FETCH_ASSOC);

    return $products;
}
?>
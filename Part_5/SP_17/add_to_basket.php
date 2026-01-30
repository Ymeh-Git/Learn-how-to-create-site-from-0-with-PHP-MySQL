<?php 
require('./includes/functions.php');

$pdo = getPDO();
// If session isn't started yet, then start it
if(!isset($_SESSION)){
    session_start();
}
// If our session doesn't have an 'basket' then create it
if(!isset($_SESSION['basket'])){
    $_SESSION['basket'] = array();
}

// If everything is good, then check for data in URL
if(isset($_GET['id'])){
    // take our id from "id" in URL 
    $id = $_GET['id'];
    // Request for every data in "products" for only id = id = $_GET['id']
    $query = $pdo->query("SELECT * FROM products WHERE id = $id");
    $idExist = $query->fetch(PDO::FETCH_ASSOC);
    // If product id doesn't exist then die
    if(empty($idExist)){
        die("This product doesn't exist");
    }

    // If everything is good, then check if our session already has in basket the same id as the one passed in URL
    if(isset($_SESSION['basket'][$id])){
        // If so, then add 1 to count quantity
        $_SESSION['basket'][$id]++; // This means you can add more than one product per id
        // Then immediately redirect to main page
        header('location: index.php');
    } else {
        // If basket with this id is empty, then create with at least one to it
        $_SESSION['basket'][$id] = 1;
        // Then immediately redirect to main page
        header('location: index.php');
    }
}
?>
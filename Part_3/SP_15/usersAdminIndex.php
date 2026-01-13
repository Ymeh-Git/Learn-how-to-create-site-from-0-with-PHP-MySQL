<?php session_start();?>

<?php

if(!isset($_SESSION['user'])){
    // SI tu n'es pas connecté alors : 
    // Soit renvoyer vers une page d'erreur 
    // Soit :
    header('location: main.php');
} elseif(!($_SESSION['user']['role'] == 'ADMIN')){
    // Si tu es connecté mais que ton rôle n'est pas "ADMIN" alors :
    header('location: main.php');
}
require('src/model.php');

$headerTitle = "Page des comptes utilisateurs";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BASES DE DONNÉES FONDAMENTALES</title>
    <link rel="stylesheet" href="asset/styles.css">
</head>
    <body>
    <!-- Header -->
    <?php require('templates/layout/header.php'); ?>

    <!-- Main content -->
    <main>
        <?php require('templates/usersAdmin.php'); ?>
    </main>

    <!-- Footer -->
    <?php require('templates/layout/footer.php'); ?>

</body>
</html>
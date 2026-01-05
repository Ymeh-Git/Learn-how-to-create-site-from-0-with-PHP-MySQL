<?php 

require('src/model.php');

$recipes = getAllRecipe();
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
    <header>
        <div>
            ** Page d'accueil **
        </div>
    </header>

    <!-- Main content -->
    <main>
        <?php require('templates/homepage.php'); ?>
    </main>

    <!-- Footer -->
    <footer>
        <div>
            Tout droit réservé - YmehGit
        </div>
    </footer>
</body>
</html>
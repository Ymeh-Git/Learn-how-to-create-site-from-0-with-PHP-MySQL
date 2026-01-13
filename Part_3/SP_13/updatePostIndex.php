<?php 

require('src/model.php');
$headerTitle = "Éditer un post";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BASES DE DONNÉES, FONDAMENTALES</title>
    <link rel="stylesheet" href="asset/styles.css">
</head>
    <body>
    <!-- Header -->
    <?php require('templates/layout/header.php'); ?>

    <!-- Main content -->
    <main>
        <?php require('templates/updatePost.php'); ?>
    </main>

    <!-- Footer -->
    <?php require('templates/layout/footer.php'); ?>
</body>
</html>
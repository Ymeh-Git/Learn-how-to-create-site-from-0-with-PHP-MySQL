<?php session_start();?>
<?php 
require('router/route.php');
require('includes/functions.php');
?>
<?php 
if($authorizeRole == "ADMIN"){
    if((!(isset($_SESSION['user']))) || (isset($_SESSION['user']) && $_SESSION['user']['role'] != $authorizeRole)){
        http_response_code(401);
        $page = "/error/401";
        $title = "ERROR 401";
        $css = "error/error";
        $js = "script";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SW - <?= $title?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <?php if($css != "") : ?>
    <link rel="stylesheet" href="assets/css/template/<?= $css?>.css">
    <?php endif;?>
    <script src="assets/js/<?=$js?>.js" defer></script>
</head>

<body>
    <!-- HEADER NAV -->
    <header>
        <nav>
            <a href="index.php" class="navBtn <?= ($nameOfRoute == "" || $nameOfRoute == "home") ? "active" : "" ?>">Homepage</a>
            <a href="index.php?route=about" class="navBtn <?= ($nameOfRoute == "about") ? "active" : "" ?>">About</a>
            <a href="index.php?route=contact" class="navBtn <?= ($nameOfRoute == "contact") ? "active" : "" ?>">Contact</a>
            <a href="index.php?route=services" class="navBtn <?= ($nameOfRoute == "services") ? "active" : "" ?>">Services</a>
            <a href="index.php?route=products" class="navBtn <?= ($nameOfRoute == "products") ? "active" : "" ?>">Products</a>
            <?php if(!isset($_SESSION['user'])) :?>
            <a href="index.php?route=admin/login" class="navBtn <?= ($nameOfRoute == "login") ? "active" : "" ?>">Log In</a>
            <?php endif;?>
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'ADMIN') : ?>
            <a href="index.php?route=admin/services" class="navBtn <?= ($nameOfRoute == "adminServices") ? "active" : "" ?> adminBtn">Admin - Services</a>
            <a href="index.php?route=admin/products" class="navBtn <?= ($nameOfRoute == "adminProducts") ? "active" : "" ?> adminBtn">Admin - Products</a>
            <a href="index.php?route=admin/dashboard" class="navBtn <?= ($nameOfRoute == "dashboard") ? "active" : "" ?> adminBtn">Admin - Dashboard</a>
            <a href="index.php?route=admin/logout" class="navBtn adminBtn logout">Log out</a>
            <?php endif?>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main>
        <?php require "template/" . $page . ".php"; ?>
        <!-- To add a new page go to router/route.php -->
    </main>

    <!-- FOOTER -->
    <footer>
        <div>
            Tout droit réservé - YmehGit
        </div>
    </footer>
</body>
</html>
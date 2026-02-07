<?php session_start();
define('ACCESS_GRANTED', true);

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'Programme Kaizen'.DS.'Part_5'.DS.'SP_20');

defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');

defined('ROUTER_PATH') ? null : define('ROUTER_PATH', SITE_ROOT.DS.'router');

defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');
defined('CORE_PATH_CLASS') ? null : define('CORE_PATH_CLASS', CORE_PATH.DS.'class');
?>

<?php 

require_once (ROUTER_PATH.'/route.php');
include_once(CORE_PATH.'/initialize.php');

?>
<?php 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SS - <?= $title?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- HEADER NAV -->
    <header>
        <nav>
            <a href="./index.php" class="navBtn <?= ($name_route == "" || $name_route == "home") ? "active" : "" ?>">Homepage</a>
            <?php if(!isset($_SESSION['user'])) :?>
            <a href="./index.php?route=auth/signup" class="navBtn <?= ($name_route == "signup") ? "active" : "" ?>">Sign up</a>
            <a href="./index.php?route=auth/login" class="navBtn <?= ($name_route == "login") ? "active" : "" ?>">Log In</a>
            <?php else:?>
            <a href="./index.php?route=account" class="navBtn <?= ($name_route == "account") ? "active" : "" ?>"><img src="https://placehold.co/50" alt="" style="border-radius: 50%"></a>
            <a href="./index.php?route=auth/logout" class="navBtn logout">Log out</a>
            <?php endif;?>
        </nav>
    </header>
    <!-- MAIN CONTENT -->
    <main>
        <?php require "template/" . $page . ".php"; ?>
    </main>

    <!-- FOOTER -->
    <footer>
        <div>
            All right reserved - YmehGit
        </div>
    </footer>
</body>
</html>
<header>
    <div>
        ** <?= $headerTitle ?> **
    </div>
    <div class="btn-field">
        <?php if(isset($_SESSION['user'])) :?>
        <a href="main.php" class="btn btn-green">Accueil</a>
        <a href="addImageIndex.php" class="btn btn-green">Ajouter une image</a>
        <?php else: ?>
        <a href="signupIndex.php" class="btn btn-info">Inscription</a>
        <a href="signinIndex.php" class="btn btn-white">Connexion</a>
        <?php endif?>
        <?php if(isset($_SESSION['user'])) :?>
        <a href="logout.php" class="btn btn-red">Se déconnecter</a>
        <?php endif ?>
        <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'ADMIN') : ?>
        <a href="usersAdminIndex.php" class="btn btn-green">Page des utilisateurs</a>
        <?php endif?>
    </div>
</header>
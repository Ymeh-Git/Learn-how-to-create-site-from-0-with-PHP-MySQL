<?php require_once('index.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LES FONDAMENTAUX WEB ET PHP</title>
    <link rel="stylesheet" href="styles.css">
</head>
    <body>
    <!-- Header -->
    <header>
        <div>
            **Mini Projet** : Formulaire de contact avec traitement
        </div>
    </header>

    <!-- Main content -->
    <main>
        <form action="" method="POST">
            <div>
                
                <label for="name">Votre nom</label>
                <input type="text" id="name" name="name" value="<?php echo $_POST['name'];?>" disabled style="color:white;">
                <label for="email">Votre email</label>
                <input type="email" id="email" name="email" value="<?php echo $_POST['email'];?>" disabled style="color:white;">
                <!-- Message d'erreur concernant le mail (validité/envoi) -->
                <?php if ($emailNotGood): ?>
                    <div style="color: red; font-size: 0.9em;" class="danger">
                        <?php echo $emailNotGood; ?>
                    </div>
                <?php endif; ?>
                <!-- Envoi du mail avec succès -->
                <?php if ($success): ?>
                    <div style="color: green;" class="success">
                        Votre message a été envoyé avec succès
                    </div>
                <?php endif; ?>
                <label for="message">Votre message</label>
                <textarea type="textarea" id="message" name="message" disabled style="color:white;"><?php echo $_POST['message'];?></textarea>
                <a href="page.php" class="btn">Retour vers page.php</a>
            </div>
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <div>
            Tout droit réservé - YmehGit
        </div>
    </footer>
</body>
</html>

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
        <form action="reception.php" method="POST">
            <div>
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Message</label>
                <textarea type="text" id="message" name="message"></textarea>
                <input type="submit" class="btn" value="Envoyer mon message">
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
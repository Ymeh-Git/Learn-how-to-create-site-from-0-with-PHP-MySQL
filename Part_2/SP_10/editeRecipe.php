<?php
$server = "localhost";
$username = "root";
$pwd = "";
$dbName = "site_recettes"; 

$id = "";
$categorie_id = "";
$nom = "";
$ingredient = "";
$processus = "";


try {
    $pdo = new PDO("mysql:host=$server;dbname=$dbName;charset=utf8mb4", $username, $pwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmtCat = $pdo->query("SELECT * FROM categories");
    $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Pour le formulaire d'envoie des nouvelles données
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = intval($_POST['id']);
    $categorie_id = intval($_POST['categorie']);
    $nom = $_POST['nom'];
    $ingredient = $_POST['ingredient'];
    $processus = $_POST['etape'];

    if (!empty($id) && !empty($nom)) {
    
        $sql = "UPDATE recettes SET 
                categorie_id = :categorie_id, 
                nom = :nom, 
                ingrédient = :ingredient, 
                processus = :processus 
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':categorie_id', $categorie_id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':ingredient', $ingredient, PDO::PARAM_STR);
        $stmt->bindParam(':processus', $processus, PDO::PARAM_STR);

        $stmt->execute();

        header("Location: page.php"); 
        exit();
    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);

    $sqlRecette = "SELECT * FROM recettes WHERE id = :id";
    $stmt = $pdo->prepare($sqlRecette);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $recette = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($recette) {
        $nom = $recette['nom'];
        $categorie_id = $recette['categorie_id'];
        $ingredient = $recette['ingrédient'];
        $processus = $recette['processus'];
    } else {
        echo "Recette introuvable.";
        exit();
    }
} else {
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: page.php");
        exit();
    }
}

?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BASES DE DONNÉES FONDAMENTALES</title>
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
        <a href="page.php">Revenir à la page d'accueil</a>
        <a href="addRecipePage.php">Ajouter une recette</a>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="nom">Nom</label><br>
            <input type="text" id="nom" name="nom" value="<?php echo $nom?>" required><br><br>

            <label for="categorie">Type de recette</label><br>
            <select name="categorie" required>
                <option value="">-- Choisir --</option>
                <?php $i = 0; ?>
                <?php foreach($categories as $cat): ?>
                    <?php $i++; ?>
                    <?php if(trim($categorie_id) == $cat['id']) : ?>
                        <option value="<?php echo $cat['id']; ?>" selected>
                        <?php echo $cat['id']." -- ".$cat['type']; ?></option>
                    <?php else :?>
                        <option value="<?php echo $cat['id']; ?>">
                        <?php echo $cat['id']." -- ".$cat['type']; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>

            <label for="ingredient">Ingrédient(s)</label><br>
            <textarea id="ingredient" name="ingredient" required><?php echo $ingredient?></textarea><br><br>

            <label for="etape">Étape(s)</label><br>
            <textarea id="etape" name="etape" required><?php echo $processus?></textarea><br><br>

            <input type="submit" style="cursor: pointer;" value="Modifier la recette">
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
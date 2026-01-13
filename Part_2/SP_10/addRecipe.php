<?php
$server = "localhost";
$username = "root";
$pwd = "";
$dbName = "site_recettes"; 

$nom = "";
$categorie = "";
$ingredient = "";
$etape = "";

$message="";

try {
    $pdo = new PDO("mysql:host=$server;dbname=$dbName;charset=utf8mb4", $username, $pwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmtCat = $pdo->query("SELECT * FROM categories");
    $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['nom'])){
        $nom = htmlspecialchars($_POST['nom']); // htmlspecialchars pour éviter les injections de codes malveillants
    }

    if(isset($_POST['categorie'])){
        $categorie = trim($_POST['categorie']); // Le soucis venait d'ici SQLSTATE 23000
    }

    if(isset($_POST['ingredient'])){
        $ingredient = htmlspecialchars($_POST['ingredient']);
    }

    if(isset($_POST['etape'])){
        $etape = htmlspecialchars($_POST['etape']);
    }

    try {
    $sql = "INSERT INTO recettes(categorie_id, nom, ingrédient, processus) 
            VALUES (:categorie, :nom, :ingredient, :etape)";

    $statement = $pdo->prepare($sql);

    $statement->bindParam(':categorie', $categorie, PDO::PARAM_INT);
    $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
    $statement->bindParam(':ingredient', $ingredient, PDO::PARAM_STR);
    $statement->bindParam(':etape', $etape, PDO::PARAM_STR);

    $statement->execute();

    $message = "<p style='color:green'>Recette ajoutée !</p>";
    
    header('Location: page.php');
    } catch (PDOException $e){

        echo "Une erreur est survenue ".$e->getMessage();

    }

}

?>

<?php echo $message; ?>

<form action="" method="POST">
    <label for="nom">Nom</label><br>
    <input type="text" id="nom" name="nom" required><br><br>

    <label for="categorie">Type de recette</label><br>
    <select name="categorie" required>
        <option value="">-- Choisir --</option>
        <?php $i = 0; ?>
        <?php foreach($categories as $cat): ?>
            <?php $i++; ?>
            <option value="<?php echo $cat['id']; ?>">
                <?php echo $cat['id']." -- ".$cat['type']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="ingredient">Ingrédient(s)</label><br>
    <textarea id="ingredient" name="ingredient" required></textarea><br><br>

    <label for="etape">Étape(s)</label><br>
    <textarea id="etape" name="etape" required></textarea><br><br>

    <input type="submit" style="cursor: pointer;" value="Ajouter une recette">
</form>
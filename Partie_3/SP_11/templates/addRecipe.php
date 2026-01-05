<?php 

$nom = "";
$categorie = "";
$ingredient = "";
$etape = "";

$message = "";
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

    addRecipe($categorie, $nom, $ingredient, $etape);
}
?>

<a href="index.php">Revenir à la page d'accueil</a>
<div class="enfant">
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
        <input type="submit" style="cursor: pointer;" value="Ajouter une recette" class="btn">
    </form>
</div>
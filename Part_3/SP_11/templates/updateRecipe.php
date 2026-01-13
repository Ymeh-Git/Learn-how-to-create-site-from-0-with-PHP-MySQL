<?php 

if(isset($_GET['action']) && $_GET['action'] == 'updateRecipeById' && isset($_GET['id'])) {

    $id = "";
    $categorie_id = "";
    $nom = "";
    $ingredient = "";
    $processus = "";

    $id = intval($_GET['id']);
    $categorie_id = intval($_GET['categorie_id']);
    $nom = $_GET['nom']; 
    $ingredient = $_GET['ingrédient'];
    $processus = $_GET['processus'];

}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = intval($_POST['id']);
    $categorie_id = intval($_POST['categorie']);
    $nom = $_POST['nom']; 
    $ingredient = $_POST['ingredient'];
    $processus = $_POST['etape'];

    updateRecipe($id, $categorie_id, $nom, $ingredient, $processus);
}

?>

<a href="index.php">Revenir à la page d'accueil</a>
<a href="addRecipeIndex.php">Ajouter une recette</a>
<div class="enfant">
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
</div> 
<?php 
if(isset($_GET['action']) && $_GET['action'] == 'deleteRecipeById' && isset($_GET['id'])) {
    $deleteRecipe = $_GET['id'];
    deleteRecipe($deleteRecipe);
}


?>

<a href="addRecipeIndex.php">Ajouter une recette</a>
<div class="parent">
<?php 
$i = 0;
foreach($recipes as $recipe){
$i ++;
?>
<div class="enfant">
    <form action="" method="POST">
        <h2 style="color: black; text-align: center;margin-top: 10px;">recette n°<?= $i?></h2>
        <label>Nom</label>
        <input type="text" value="<?= $recipe['nom'] ?>">
        <label>Type de recette</label>
        <?php switch($recipe["categorie_id"]) { 

                case 1 :?>
                <input type ="text" value="Pâtisserie" disabled>
        <?php   break;?>

        <?php   case 2 : ?>
                <input type ="text" value="Cuisine" disabled>
        <?php   break;?>

        <?php   case 3 : ?>
                <input type ="text" value="Dessert" disabled>
        <?php   break;?>

        <?php   case 4 : ?>
                <input type ="text" value="Cuisine" disabled>
        <?php   break;?>

        <?php } ?>
        <label>Ingrédient(s)</label>
        <input type ="text" value="<?= $recipe['ingrédient'] ?>" disabled>
        <label>Étape(s)</label>
        <p class="textarea"><?= $recipe['processus'] ?></p>
        <div class="btn-field">
            <a href="updateRecipeIndex.php?action=updateRecipeById&id=<?=$recipe['id']?>&nom=<?= $recipe['nom']?>&ingrédient=<?=$recipe['ingrédient']?>&processus=<?=$recipe['processus']?>&categorie_id=<?=$recipe['categorie_id']?>" class="btn btn-info">Éditer</a>
            <a href="?action=deleteRecipeById&id=<?=$recipe['id']?>" class="btn btn-red">Supprimer</a>
        </div>
    </form>
</div>
<?php 
}
?>
</div>
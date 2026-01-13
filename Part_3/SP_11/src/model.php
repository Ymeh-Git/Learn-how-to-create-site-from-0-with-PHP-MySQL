<?php 
require_once('config/db.php');

function getAllRecipe()
{
  $pdo = getPDO();
  $sql = "SELECT * FROM recettes";
  $query = $pdo->query($sql);
  $recipes = $query->fetchAll(PDO::FETCH_ASSOC);
  return $recipes;
}

function getAllCategories()
{
        $pdo= getPDO();
        $sql = "SELECT * FROM categories";
        $queryCat = $pdo->query($sql);
        $categories = $queryCat->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
}

function addRecipe($categorie, $nom ,$ingredient, $etape){
    
    try {
    $pdo = getPDO();
    $sql = "INSERT INTO recettes(categorie_id, nom, ingrédient, processus) 
            VALUES (:categorie, :nom, :ingredient, :etape)";

    $statement = $pdo->prepare($sql);

    $statement->bindParam(':categorie', $categorie, PDO::PARAM_INT);
    $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
    $statement->bindParam(':ingredient', $ingredient, PDO::PARAM_STR);
    $statement->bindParam(':etape', $etape, PDO::PARAM_STR);

    $statement->execute();

    $message = "<p style='color:green'>Recette ajoutée !</p>";
    
    header('Location: index.php');
    } catch (PDOException $e){

        echo "Une erreur est survenue ".$e->getMessage();

    }
    
}

function updateRecipe($id, $categorie_id, $nom, $ingredient, $processus) {

    $pdo = getPDO();

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

    header("Location: index.php"); 
    exit();
}

function deleteRecipe($id){
    $pdo = getPDO();
    $sql = "DELETE FROM recettes WHERE `recettes`.`id` = :id";
    $request = $pdo->prepare($sql);
    $request->bindValue(':id', $id, PDO::PARAM_INT);
    $request->execute();
    header("Location: index.php");
}
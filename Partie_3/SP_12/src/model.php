<?php 
require_once('config/db.php');
// READ
function getAllPosts()
{
    $pdo = getPDO();
    $sql = "SELECT * FROM posts";
    $query = $pdo->query($sql);
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function getPostById($id)
{
    $pdo = getPDO();
    $sql = "SELECT * FROM posts WHERE id = :id";

    $statement = $pdo->prepare($sql);

    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();

    $postById = $statement->fetch(PDO::FETCH_ASSOC);
    return $postById;
}
// CREATE
function addPost($title, $content ,$editedAt=NULL){
    
    try {
    $pdo = getPDO();
    $sql = "INSERT INTO posts(title, content, editedAt) 
            VALUES (:title, :content, :editedAt)";

    $statement = $pdo->prepare($sql);

    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':content', $content, PDO::PARAM_STR);
    $statement->bindParam(':editedAt', $editedAt, PDO::PARAM_STR);

    $statement->execute();

    $message = "<p style='color:green'>Post ajouté avec succès!</p>";
    
    header('Location: index.php');
    } catch (PDOException $e){

        echo "Une erreur est survenue ".$e->getMessage();

    }
    
}



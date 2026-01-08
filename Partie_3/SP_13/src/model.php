<?php 
require_once('config/db.php');

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


function updatePost($id, $title, $content){
  
    $pdo = getPDO();

    $sql = "UPDATE posts SET 
            title = :title, 
            content = :content
            WHERE id = :id";
            
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);

    $stmt->execute();

    header("Location: index.php"); 
    exit();
}

function deletePost($id){
    $pdo = getPDO();
    $sql = "DELETE FROM posts WHERE `posts`.`id` = :id";
    $request = $pdo->prepare($sql);
    $request->bindValue(':id', $id, PDO::PARAM_INT);
    $request->execute();
    header("Location: index.php");
}

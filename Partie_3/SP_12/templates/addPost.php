<?php 

$title = "";
$content = "";

$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['title'])){
        $title = htmlspecialchars($_POST['title']);
    }

    if(isset($_POST['content'])){
        $content = htmlspecialchars($_POST['content']);
    }

    addPost($title, $content);
}
?>

<a href="index.php">Revenir à la page d'accueil</a>
<div class="enfant">
    <form action="" method="POST">
        <label for="title">Titre du post</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Contenu</label><br>
        <textarea id="content" name="content" required></textarea><br><br>

        <input type="submit" style="cursor: pointer;" value="Créer un nouveau post" class="btn">
    </form>
</div>
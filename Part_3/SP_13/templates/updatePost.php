<?php
if($_GET['action'] && $_GET['action'] == 'updatePostById' && isset($_GET['id'])){
    $id = "";
    $id = $_GET['id'];

    $postByID = getPostById($id);
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $idEdited = "";
    $titleEdited = "";
    $contentEdited = "";

    $idEdited = $_GET['id'];
    $titleEdited = $_POST['title'];
    $contentEdited = $_POST['content'];

    updatePost($idEdited, $titleEdited, $contentEdited);
}
?>


<a href="index.php">Revenir à la page d'accueil</a>
<div class="enfant">
    <form action="" method="POST">
        
        <input type="hidden" id="id" name="id" value ="<?= $postByID['id'] ?>" required><br><br>

        <label for="title">Titre du post</label><br>
        <input type="text" id="title" name="title" value ="<?= $postByID['title'] ?>" required><br><br>

        <label for="content">Contenu</label><br>
        <textarea id="content" name="content" required><?= $postByID['content'] ?></textarea><br><br>
        <div class="btn-field">
            <input type="submit" style="cursor: pointer; height:32px;" value="Mettre à jour" class="btn btn-info">
            <a href="index.php" class="btn btn-red">Annuler</a>
        </div>
    </form>
</div>
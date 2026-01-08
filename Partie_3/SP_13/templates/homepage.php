<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] == 'deletePostById' && isset($_POST['id'])) {
    
    $id = intval($_POST['id']); // Toujours sécuriser l'ID avec intval
    deletePost($id);
}
// pagination

// 1. Définir la page actuelle et le nombre par page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage <= 0) $currentPage = 1; // Sécurité

$parPage = 1; // Nombre de Posts par page

// 2. Calculer le "décalage" (OFFSET)
// Page 1 -> offset 0, Page 2 -> offset 5, etc.
$offset = ($currentPage - 1) * $parPage;

$pdo = getPDO();

// 3. REQUÊTE A : Compter le nombre total de Posts
$sqlCount = "SELECT COUNT(*) FROM posts";
$stmtCount = $pdo->prepare($sqlCount);
$stmtCount->execute();
$totalPosts = $stmtCount->fetchColumn(); // fetchColumn récupère juste le nombre

// Calculer le nombre total de pages (arrondi au supérieur avec ceil)
$pagesTotales = ceil($totalPosts / $parPage);

// 4. REQUÊTE B : Récupérer les Posts de la page
// On utilise LIMIT et OFFSET
$sql = "SELECT * FROM posts LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);

// IMPORTANT : bindValue avec PARAM_INT est obligatoire pour LIMIT/OFFSET
$stmt->bindValue(':limit', $parPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Ici se trouvera le HTML du main de Index.php -->

<a href="addPostIndex.php">Créer un nouveau post</a>
<div class="parent">
    <?php 
    $i = 0;
    foreach($posts as $post){
    $i ++;
    ?>
    <div class="enfant">
        <form action="updatePostIndex.php" method="POST">
            <h1 style="color: black; text-align: center;margin-top: 10px;">recette n°<?= $i?></h1>
            <input type="hidden" id="id" name="id" value ="<?= $post['id'] ?>">
            <input style="border: none; color: black; font-weight: bolder; font-size: 20px;" value ="<?= $post['title'] ?>" name="title" readonly>
            <textarea style="background-color:white; height: 75px;" name="content" readonly><?= $post['content'] ?></textarea>

            <div class="btn-field">
                <a href="updatePostIndex.php?action=updatePostById&id=<?=$post['id']?>" class="btn btn-info">Éditer</a>
            </div>
        </form>
        <!-- Créer un formulaire différent pour la supression -->
        <form method="POST" action="?action=deletePostById" onsubmit="return confirm('Voulez-vous confirmer la supression de <?= $post['title']?> ?');" style="display:inline;">
    
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <div class="btn-field">
                <button type="submit" class="btn btn-red">Supprimer</button>
            </div>
        </form>
    </div>

    <?php 
    }
    ?>
</div>
<div class="pagination">
    <?php if ($currentPage > 1): ?>
        <a href="?page=<?= $currentPage - 1 ?>" class="btn">&laquo; Précédent</a>
    <?php elseif ($currentPage == 1): ?>
        <a href="#" class="btn">Min</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $pagesTotales; $i++): ?>
        <a href="?page=<?= $i ?>" class="page-link <?= ($currentPage == $i) ? 'active' : 'disabled' ?>" style="width:10px">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($currentPage < $pagesTotales): ?>
        <a href="?page=<?= $currentPage + 1 ?>" class="btn">Suivant &raquo;</a>
    <?php elseif ($currentPage == $pagesTotales): ?>
        <a href="#" class="btn">Max</a>
    <?php endif; ?>
</div>
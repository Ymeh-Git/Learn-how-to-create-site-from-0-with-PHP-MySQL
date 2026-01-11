<?php 
$id = ""; 
$users = getAllUsers();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] == 'deleteUserById' && isset($_POST['id']) && $_SESSION['user']['role'] == 'ADMIN') {
    
    $id = intval($_POST['id']); // Toujours sécuriser l'ID avec intval
    adminDeleteAccount($id);
}
?>

<div class="parent">
    <?php foreach($users as $user){?>
    <?php if(!($user['role'] == 'ADMIN')) :?>
    <div class="enfant">
        <form action="?action=deleteUserById" method="POST" onsubmit="return confirm('Voulez-vous confirmer la supression de <?= $user['email']?> ?');" >
            <input type="text" id="id" name="id" value="<?= $user['id']?>" hidden>
            <label for="pseudo">PSEUDO</label>
            <input type="text" id="pseudo" name="pseudo" value="<?= $user['pseudo']?>" readonly>
            <label for="email">EMAIL</label>
            <input type="email" id="email" name="email" value="<?= $user['email']?>" readonly>
            <div class="btn-field">
                <input type="submit" value="Supprimer le compte" class="btn btn-red" style="width:100%">
            </div>
        </form>
    </div>
    <?php endif?>
    <?php }?>
</div>
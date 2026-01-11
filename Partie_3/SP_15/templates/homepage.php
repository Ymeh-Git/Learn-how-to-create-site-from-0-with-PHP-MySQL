Bonjour <?= htmlspecialchars($_SESSION['user']['pseudo'])?>
<br><br>
<?php if(!isset($images[0])){?>
    <p>Aucune image n'a été upload</p>
<?php } else{?>
<?php foreach($images as $image){?>
<div>
    <img src="uploads/<?= $image['image'] ?>" alt="Avatar" style="height:150px; width:150px; border-radius:50%;">
</div>
<?php }?>
<?php }?>
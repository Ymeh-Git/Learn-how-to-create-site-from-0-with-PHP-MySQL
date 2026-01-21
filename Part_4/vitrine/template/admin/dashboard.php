<?php

$products = getAllProducts();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] == 'deletePostById' && isset($_POST['id'])) {
    
    $id = intval($_POST['id']);
    deleteProduct($id);
    header('location: index.php?route=admin/dashboard');
}
?>
<!-- Admin dashboard -->
<h1>ADMIN DASHBOARD</h1>
<h2>PRODUCTS</h2>
<a href="index.php?route=admin/products" class="btn adminBtn">Add Product</a><br><br>


<?php if(!isset($products[0])){?>
<p>No product in Database</p>
<?php } else{?>
    <?php foreach($products as $product){?>
    <div class="parent">
        <!-- Form to show and edit Product -->
        <form action="editProduct.php?route=editProduct&action=updateProductById&id=<?=$post['id']?>" method="POST">
            <input type="hidden" id="id" name="id" value ="<?= $product['id'] ?>">
            <img src="assets/uploads/<?= $product['img'] ?>" alt="<?= $product['altImage']?>" style="height:150px; width:150px; border-radius:15px;">
            <h3>Name : <?= $product['name']?></h3>
            <p>Price : <?= $product['price']?> €</p>
            <p>Description : <?= $product['description']?></p>
            <div class="btn-field">
                <input type="submit" class="btn btn-info" value="Edit this product">
            </div>
        </form>
        <!-- Form to delete Product -->
        <form method="POST" action="?route=admin/dashboard&action=deletePostById" onsubmit="return confirm('Voulez-vous confirmer la supression de <?= $product['name']?> ?');" style="display:inline;">
        
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <div class="btn-field">
                <input type="submit" class="btn btn-red" value="Delete this product">
            </div>
        </form>
    </div>
    <?php }?>
<?php }?>
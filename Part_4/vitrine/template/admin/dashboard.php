<?php
// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

$products = getAllProducts();
$contactForms = getContactForm();

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

<section class="productsAdmin">
    <?php if(!isset($products[0])){?>
    <p>No product in Database</p>
    <?php } else{?>
        <?php foreach($products as $product){?>
        <div class="parent">
            <img src="assets/uploads/<?= $product['img'] ?>" alt="<?= $product['altImage']?>" style="height:150px; width:150px; border-radius:15px;">
            <h3 class="productName">Name : <?= $product['name']?></h3>
            <p class="productPrice">Price : <?= $product['price']?> €</p>
            <p class="productDescription">Description : <?= $product['description']?></p>
            
            <!-- Form to delete Product -->
            <div class="enfant">
                <div class="btn-field">
                    <a href="index.php?route=admin/update/editProduct&action=updateProductById&id=<?= $product['id']?>" class="btn">Edit</a>
                </div>
                <form method="POST" action="?route=admin/dashboard&action=deletePostById" onsubmit="return confirm('Voulez-vous confirmer la supression de <?= $product['name']?> ?');" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <div class="btn-field">
                        <input type="submit" class="btn btn-red" value="Delete">
                    </div>
                </form>
            </div>
        </div>
        <?php }?>
    <?php }?>
</section>

<h2>Contacted By</h2>
<section class="contactFormsAdmin">
    <?php foreach($contactForms as $contactForm){?>
    <div class="parent">
        <h3>Sent by <?= $contactForm['name'];?></h3><br>
        <p>Mail : <a href="mailto:<?= $contactForm['email'];?>"><?= $contactForm['email'];?></a></p>
        <p>Message : <?= $contactForm['message'];?></p>
    </div>
    <?php }?>
</section>
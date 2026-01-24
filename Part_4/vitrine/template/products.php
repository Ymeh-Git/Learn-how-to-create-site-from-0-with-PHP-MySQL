<?php 
// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

$products = getAllProducts();
?>

<h1>PRODUCTS</h1>

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
        </div>
        <?php }?>
    <?php }?>
</section>
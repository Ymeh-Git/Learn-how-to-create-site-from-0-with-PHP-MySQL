<?php 
session_start();

// If our session doesn't have an 'basket' then create it
if(!isset($_SESSION['basket'])){
    $_SESSION['basket'] = array();
}

require ('./includes/functions.php');
// Show all products
$products = getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Shop</title>
</head>
<body>
    <a href="./panier.php" class="link">Basket<span><?= array_sum($_SESSION['basket']); ?></span></a>
    <a href="./logout.php" class="link">Logout</a>
    <section class="products_list">
        <!-- Loop foreach -->
        <?php foreach($products as $product) :?>
        <!-- Each $product has a form in case we Edit later with an Admin role -->
        <form action="" method="" class="product">
            <div class="image_product">
                <!-- Don't forget to add folder path to where your img's are since in DB only file name is defined -->
                <!-- ./images/[...] -->
                <img src="./images/<?= $product['img']?>">
            </div>
            <div class="content">
                <h4 class="name"><?= $product['name']?></h4>
                <h2 class="price"><?= $product['price']?> €</h2>
                <!-- Let's send id thanks to URL to add_to_basket.php -->
                <a href="add_to_basket.php?id=<?= $product['id']?>" class="id_product">Add to basket</a>
            </div>
        </form>
        <?php endforeach;?>
    </section>
</body>
</html>
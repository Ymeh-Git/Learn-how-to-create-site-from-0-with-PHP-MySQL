<?php 
session_start();
// Start session
// Require function from functions(db).php
require('./includes/functions.php');

// If our session doesn't have an 'basket' then create it
if(!isset($_SESSION['basket'])){
    $_SESSION['basket'] = array();
}
// If in URL we have a "delete" section, then take delete.value which is product['id']
if(isset($_GET['delete'])){
    $id_del = $_GET['delete'];
    // Thend delete our session linked to product['id']
    unset($_SESSION['basket'][$id_del]);
}
// If in URL we have a "less" section, then take less.value which is product['id']
if(isset($_GET['less'])){
    $id_less = $_GET['less'];
    // If session['basket']['id'] already exist and count is at least 2 and more
    if(isset($_SESSION['basket'][$id_less]) && $_SESSION['basket'][$id_less] > 1){      
        // Then we can still remove one from it
        $_SESSION['basket'][$id_less]-- ;
    } elseif(isset($_SESSION['basket'][$id_less]) && $_SESSION['basket'][$id_less] <= 1){
        // Else if session['basket']['id'] = 1 or 0 then remove it
        unset($_SESSION['basket'][$id_less]);
        // That way we can't see quantity = -1 or 0
    }
}
// If in URL we have a "more" section, then take more.value which is product['id']
if(isset($_GET['more'])){
    $id_more = $_GET['more'];
    // Then add one to basket count
    $_SESSION['basket'][$id_more]++ ;
}

if(isset($_GET['deleteAll']) && $_GET['deleteAll'] == "total" && !empty($_SESSION['basket'])){
    // 
    $_SESSION['basket'] = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Panier</title>
</head>
<body class="panier">
    <a href="./index.php" class="link">Shop</a>
    <section>
        <!-- Let's make a table to show datas -->
        <table>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
            <?php 
                // By default total = 0 since no product has been added
                $total = 0; 

                // All id in our session's basket
                $ids = array_keys($_SESSION['basket']);
                if(empty($ids)){
                    echo "No products has been added to your basket...";
                } else{ 
                    // If it's not empty we can make something
                    $pdo = getPDO();
                    // For now ids = ['1','2','3']
                    // Thanks to implode(',', $ids)
                    // Now ids = "1,2,3"

                    // WHERE id = 1,2,3 doesn't work, we need to add IN ('list')

                    // $sql = "SELECT * FROM products WHERE id IN ("1,2,3")"
                    $sql = "SELECT * FROM products WHERE id IN (".implode(',', $ids).")";
                    // Process our request in $products
                    $products = $pdo->query($sql);

                    // Loop with $products
                    foreach($products as $product) :
                    // total = price * quantity
                    // Don't forget to add last added product to total and add new one
                    // First product added
                    // $total = 25
                    // Then new product has been added
                    // $total = 25 + 75 = 100
                    // ...
                    $total += $product['price'] * $_SESSION['basket'][$product['id']];
            ?>


            <tr>
                <td><img src="./images/<?= $product['img']?>"></td>
                <td><?= $product['name']?></td>
                <td><?= $product['price']?> €</td>
                <td><?= $_SESSION['basket'][$product['id']];?></td>
                <td>
                    <!-- Remove one from our basket with this 'id' -->
                    <a href="panier.php?less=<?= $product['id']?>"><img src="./images/basket/Muhammed_Usman_Less.png" class="imgLessMore"></a>
                    <!-- Remove all from our basket with this 'id' -->
                    <a href="panier.php?delete=<?= $product['id']?>"><img src="./images/basket/Uniconlabs_trashcan.png"></a>
                    <!-- Add one more to our basket with this 'id' -->
                    <a href="panier.php?more=<?= $product['id']?>"><img src="./images/basket/Kliwir_art_more.png" class="imgLessMore"></a>
                </td>
            </tr>
            <?php endforeach;?>
            <?php } ?>
            <tr class="total">
                <!-- echo "Total : ".$total." €" -->
                <th>Total : <?= $total ?> €</th>
                <th><a href="panier.php?deleteAll=total">Delete all</a></th>
            </tr>
        </table>
    </section>
    
</body>
</html>
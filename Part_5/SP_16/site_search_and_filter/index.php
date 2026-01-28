<?php 
require('includes/functions.php');

$products = getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEARCH AND FILTER</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Can be placed in <aside> -->
    <form action="" method="GET">
        <!-- Searching by name -->
        <input type="text" name="search" id="search" placeholder="Search a product..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <br>
        <!-- Searching by max_price -->
        <input type="number" name="max_price" id="max_price" placeholder="Max price €" value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>">
        <br>
        <!-- Searching by min_price -->
        <input type="number" name="min_price" id="min_price" placeholder="Min price €" value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>">
        <br>
        <!-- Searching by categorie -->
        <input type="text" name="categorie" id="categorie" placeholder="Search by categorie (ex: shoes, candle, clothes ...)" value="<?= htmlspecialchars($_GET['categorie'] ?? '') ?>">
        <br>
        <select name="sort">
            <option value="newest" <?= (isset($_GET['sort']) && $_GET['sort'] == 'newest') ? 'selected' : '' ?>>
                Newest
            </option>
            <option value="price_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : '' ?>>
                Rising Price
            </option>
            <option value="price_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : '' ?>>
                Decreasing Price
            </option>
            <option value="alpha" <?= (isset($_GET['sort']) && $_GET['sort'] == 'alpha') ? 'selected' : '' ?>>
                Alph. order
            </option>
        </select>
        <input type="submit" value="Filter" class="submitBtn"><br>
        <div class="resetBtn">
            <a href="index.php">Reset</a>
        </div>
    </form>
    <!-- Main content, our products -->
    <main>
        <div class="product-list">
            <!-- If no data -->
            <?php if(count($products) === 0):?>
                <p>No product in DB</p>
            <?php else:?>
            <!-- Loop -->
                <?php foreach($products as $product) :?>
                    <div class="product-card">
                        <h3 class="product-name"><?= $product['name']?></h3>
                        <p class="product-categorie"><?= $product['categorie']?></p>
                        <p class="product-price"><?= $product['price']?> €</p>
                    </div>
                <?php endforeach; ?>
            <?php endif;?>
        </div>
    </main>
</body>
</html>
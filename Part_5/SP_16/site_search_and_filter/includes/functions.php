<?php 
require_once('database.php');


function getProducts(){
    $pdo= getPDO();

    $sql="SELECT * FROM products WHERE 1=1";

    $params = [];

    // ###################################
    // ############SEARCHING##############
    // ###################################
    if(!empty($_GET['search'])){
        $sql .= " AND name LIKE :search";
        $params[':search'] = '%'. $_GET['search'] . '%';
        // $params[':search'] = '%candle%'
    }
    if(!empty($_GET['max_price'])){
        $sql .= " AND price <= :max_price";
        $params[':max_price'] = $_GET['max_price'];
        // $params[':max_price'] = 75 
    }
    if(!empty($_GET['min_price'])){
        $sql .= " AND price >= :min_price";
        $params[':min_price'] = $_GET['min_price'];
        // $params[':min_price'] = 15
    }
    if(!empty($_GET['categorie'])){
        $sql .= " AND categorie LIKE :categorie";
        $params[':categorie'] = '%'. $_GET['categorie'] . '%';
        // $params[':categorie'] = '%Shoes%'
    }

    // HOW TO USE '%'
    // --------------
    // %candle => all words ending by 'candle'
    // --------------
    // candle% => all words starting by 'candle'
    // --------------
    // %candle% => all words containing 'candle'
    // --------------
    // can%dle => all words starting by 'can' and ending by 'dle'
    // --------------
    // c_ndle => all words starting by 'c' replace '_' by only one char and ending by 'ndle', ex : 'cundle', 'candle'
    // ###################################

    // ###################################
    // #########ORDER BY FILTER###########
    // ###################################
    
    $orderOptions = [
        'newest' => 'createdAt DESC',        // By date, most recent one
        'price_asc' => 'price ASC',     // By rising price
        'price_desc' => 'price DESC',   // By decreasing price
        'alpha' => 'name ASC'           // By alph. order (a to z)
    ];

    // By default the newest one
    $orderBy = "createdAt DESC";

    if(!empty($_GET['sort']) && array_key_exists($_GET['sort'], $orderOptions)){
        $orderBy = $orderOptions[$_GET['sort']];
        // $_GET['sort'] => value of <select><option>Alph. order</option></select> == 'alpha'
        // $orderBy = $orderOptions['alpha'];
        // $orderBy = 'name ASC';
    }
    // Don't forget to add to our SQL request
    $sql .= " ORDER BY $orderBy";
    // ###################################

    // SQL Request order (don't change this order)
    // SELECT ...
    // FROM ...
    // WHERE ...
    // ORDER BY ...
    // LIMIT ...


    // Prepared request
    $stmt= $pdo->prepare($sql);
    // $params=
    // [
    //    ':search' => '%candle%'
    //    ':max_price' => 75
    //    ':min_price' => 15
    //    ':categorie' => '%Shoes%'
    // ];

    // OR

    // $params=
    // [
    //    ':max_price' => 115
    //    ':min_price' => 5
    // ];

    // ...
    // Same as ->BindValue() BUT it is in an array $params
    // Prevent SQL injection
    $stmt->execute($params);

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $products;
}
?>
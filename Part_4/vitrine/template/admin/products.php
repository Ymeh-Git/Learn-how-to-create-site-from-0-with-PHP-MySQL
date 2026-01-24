<?php
// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

?>
<?php 
$errorMessage = "";
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_SESSION['user']) && $_SESSION['user']['role'] == "ADMIN" ){

    // First empty variables
    $name = "";
    $price = "";
    $description = "";
    $reference = "";
    
    $img = "missing_img.jpg";
    $altImage = 'No image available';

    $processForm = true;

    // Then catch our form
    $name = strip_tags($_POST['name']);
    $price = intval($_POST['price']);
    $description = strip_tags($_POST['description']);
    $reference = strip_tags(strtoupper($_POST['reference']));

    // Error 4 = empty
    if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] !== 4){

        $result = uploadImage($_FILES['avatar']);

        if($result['success'] === true){
            $img = $result['filename'];
            $altImage = strip_tags($_POST['altImage']);
        } else {
            $errorMessage = $result['error'];
            $processForm =false;
        }
    }

    if($processForm){
        $success = addProduct($name, $price, $description, $reference, $img, $altImage);

        if($success){
            header('location: index.php?route=admin/dashboard');
            exit;
        } else {
            $errorMessage = "An error occured while adding a product";
        }
    }
        
    

} elseif($_SERVER['REQUEST_METHOD'] === "POST"){
    http_response_code(401);
    $page = "/error/401";
    $title = "ERROR 401";
    $css = "error/error";
    $js = "script";
}

?>

<!-- Admin products -->
<h1>ADMIN PRODUCTS</h1> <hr>

<p style="color: red;"><?= $errorMessage;?></p>
<form action="" method="POST" enctype="multipart/form-data">

    <label for="name">Name</label><br>
    <input type="text" name="name" id="name"><br>
    
    <label for="price">Price (€)</label><br>
    <input type="number" name="price" id="price"><br>

    <label for="avatar">Image product (JPG, PNG - Max 2Mo)</label><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="2097152"/> 
    <input type="file" name="avatar" id="avatar"><br>
    <input type="text" name="forgotImage" id="forgotImage" value="⚠️Don't forget an Image (now or later)⚠️" style="text-align: center;width: 275px;background-color: black;color: skyblue;"hidden readonly>

    <label for="altImage" id="labelAltImage" hidden>Alternative text for image</label>
    <input type="text" name="altImage" id="altImage" hidden>
    
    <label for="description">Product description</label><br>
    <input type="text" name="description" id="description"><br>

    <label for="reference">Reference (7 letters)</label><br>
    <!-- Add strtoupper in case there is a mistake -->
    <input type="text" name="reference" id="reference" maxlength="8" placeholder="RTFMCQFD"> 
    <div class="btn-field">
        <input type="submit" value="Add a product" id="submitBtn" class="btn btn-disabled" disabled>
        <input type="reset" value="Reset" class="btn btn-red">
    </div>
</form>
<hr>
<a href="index.php?route=admin/dashboard">Retour au dashboard</a>
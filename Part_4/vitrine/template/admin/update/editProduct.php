<?php 
// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
} 

$product = [];

if($_GET['action'] == 'updateProductById'){
    if($_GET['id']){
        $id = "";
        $id = $_GET['id'];
        $product = searchProductById($id);
        if(!$product){
            echo "Can't find product";
            exit;
        }
    }

    if($_SERVER['REQUEST_METHOD'] === "POST" && $_SESSION && isset($_SESSION['user']) && $_SESSION['user']['role'] == "ADMIN" ){
        $name = "";
        $price = "";
        $img = "";
        $altImage = "";
        $description = "";
        $reference = "";
    
        $img = $product['img']; //By default the same as the last one (new input will be empty)

        $processForm = true;
        $newImageUploaded = false;

        // Then catch our form
        $name = strip_tags($_POST['name']);
        $price = intval($_POST['price']);
        $description = strip_tags($_POST['description']);
        $reference = strip_tags(strtoupper($_POST['reference']));
        $altImage = strip_tags($_POST['altImage']);

        // Error 4 = empty
        if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] !== 4){

            $result = uploadImage($_FILES['avatar']);

            if($result['success'] === true){
                $img = $result['filename'];
                $newImageUploaded = true;

            } else {
                $errorMessage = $result['error'];
                $processForm =false;
            }
        }

        if($processForm){
            $success = updateProduct($id, $name, $price, $description, $reference, $img, $altImage);

            if($success){
                // If $product['img'] is different than "missing_img.jpg" this means every other path, since by default it's "missing_img.jpg"
                // That means I target the last path given to $product['img'] and I want to erase it from assets/uploads/$product['img']
                // Since there is no more uses to it
                if($newImageUploaded && $product['img'] !== "missing_img.jpg"){
                    $oldFile = 'assets/uploads/'.$product['img'];
                    if(file_exists($oldFile)){
                        unlink($oldFile);
                    }
                } 
                header('location: index.php?route=admin/dashboard');
                exit;
            } else {
                if($newImageUploaded){
                    unlink('assets/uploads/'.$img);
                }
                $errorMessage = "An error occured while updating the product";
            }
        }
    }
}



?>

<!-- Admin products -->
<h1>Product (id = <?= $product['id']?>)</h1> <hr> <br>
<div>
    <form action="" method="POST" enctype="multipart/form-data">
    
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name" value="<?= $product['name']?>"><br>
        
        <label for="price">Price (€)</label><br>
        <input type="number" name="price" id="price" value="<?= $product['price']?>"><br>

        <figure style="width:173px;">
            <img src="assets/uploads/<?= $product['img'] ?>" alt="<?= $product['altImage']?>" width="173"><br>
            <figcaption style="text-align:center">Current image</figcaption>
        </figure>
        <p><strong>Do you want to change Img ?</strong></p>
        <label for="avatar">Image product (JPG, PNG - Max 2Mo)</label><br>
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152"/> 
        <input type="file" name="avatar" id="avatar"><br>
        <input type="text" name="forgotImage" id="forgotImage" value="⚠️Don't forget an Image (now or later)⚠️" style="text-align: center;width: 275px;background-color: black;color: skyblue;"hidden readonly>
        <br>
        <label for="altImage" id="labelAltImage">Alternative text for image</label><br>
        <input type="text" name="altImage" id="altImage" value="<?= $product['altImage']?>" ><br>

        <label for="description">Product description</label><br>
        <input type="text" name="description" id="description" value="<?= $product['description']?>"><br>
    
        <label for="reference">Reference (7 letters)</label><br>
        <!-- Add strtoupper in case there is a mistake before sending it to BDD -->
        <input type="text" name="reference" id="reference" maxlength="8" placeholder="RTFMCQFD" value="<?= $product['reference']?>"> 
        <div class="btn-field">
            <input type="submit" value="Edit product" id="submitBtn" class="btn btn-disabled">
            <input type="reset" value="Reset" class="btn btn-red">
        </div>
    </form>
</div>
<br>
<hr>
<a href="index.php?route=admin/dashboard">Retour au dashboard</a>
<?php 
session_start();

use PHPMailer\PHPMailer\PHPMailer;

// Since we ask for a function, we need require
require_once 'includes/sendMailFunction.php';

$mailToSend = "";
$content = "";
$btn= "";

$message ="";
$uploadError = false;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $mailToSend = htmlspecialchars($_POST['email']);
    $content = htmlspecialchars($_POST['message']);
    $filename= null;

    // If there is a file to send
    if(isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE){
        // First upload it
        $upload= uploadFile($_FILES['file']);

        // If it's a success
        if(is_array($upload) && $upload['success']){
            // Then send it to our database
            $filename = $upload['filename'];
        } else {
            $uploadError = true;
            // $message ="...";
        }

    } 
    
    if(!$uploadError){

        // $db = true or false (since $stmt->execute() return true or false)
        $db = addMail($mailToSend, $content, $filename);

        if($db){
            // Finally send mail
            $mail= new PHPMailer(true);
            sendingMail($mail, $mailToSend, $content, $filename);
            if($filename !== null){
                header('location: index.php?success=successMailFile');
                // check if $_GET['success'] == 'successMailFile'
                // Then write your message with div>p
            } else{
                header('location: index.php?success=successMail');
                // check if $_GET['success'] == 'successMail'
                // Then write your message with div>p
            }
        } else{
            // If sending it to Database is not a success then delete file uploaded
            $currentFile= $upload['path'];
            if(file_exists($currentFile)){
                unlink($currentFile);
            }
            // Send to error sending mail page
            header('location: errorMail.php');
            // Add if, if you want to change URL then add conditions to errorMail.php like we did in index.php ($_GET['success'] == 'successMail')
        }
    }
}

$mails = getMails();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter system</title>
    <style>
        fieldset{
            width:20%; 
            margin: auto; 
            text-align:center;
            background-color: lightskyblue;
            color: white;
            border-color: blue;
            border-radius: 15px
        }

        fieldset legend{
            color: blue;
        }

        .submitBtn{
            margin : 15px;
            padding: 5px;
            background-color: white;
            color: black;
            border-radius: 6px;
            border: none;
            transition:0.3s
        }
        .submitBtn:hover{
            cursor: pointer;
            background-color: black;
            color: white;
            transform: scale(1.1);
        }

        .successDiv{
            background-color: lightgreen;
            border-radius: 15px;
            border: 1px solid white;
        }
        .successP{
            text-align: center;
            color: green;
        }
        a{
            display: block;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <fieldset>
        <legend>Contact form</legend>
        <form action="#" method="POST" enctype="multipart/form-data">
            <label for="email">Email :</label><br>
            <input type="text" class="email" id="email" name="email" require><br>

            <label for="message">Message :</label><br>
            <input type="text" class="message" id="message" name="message" require><br>

            <label for="file">Screenshot or file : </label><br>
            <input type="hidden" name="MAX_FILE_SIZE" value="2097152" /> 
            <input type="file" name="file" id="file"><br>

            <input type="submit" value="Send" id="submitBtn" class="submitBtn" name="submitBtn">
        </form>
        <?php if(isset($_GET['success'])) {?>
        <?php if($_GET['success'] == 'successMail') :?>
        <div class="successDiv">
            <p class="successP">Your mail has been sent</p>
        </div>
        <?php elseif($_GET['success'] == 'successMailFile'):?>
        <div class="successDiv">
            <p class="successP">Your mail and file has been sent</p>
        </div>
        <?php endif;?>
        <?php }?>
        <br>
        <a href="./index.php">Get back</a>
    </fieldset>

    <main>
        <?php foreach($mails as $mail):?>
            <div class="successDiv">
                <h2 class="successP">Expeditor : <br> <?= $mail['mail']?></h2>
                <p class="successP">Content : <br> <?= $mail['content']?></p>
                <!-- We can open it in a new page with <a> OR iframe should work too, no need to know which ext the file is -->
                <?php if($mail['filename']):?>
                    <a href="./assets/uploads/<?= $mail['filename']?>" target="_blank">Open</a>
                <?php endif;?>
            </div>
        <?php endforeach ?>
    </main>
</body>
</html>
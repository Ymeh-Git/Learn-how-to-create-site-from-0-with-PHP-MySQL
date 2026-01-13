<?php 
// Forms HTML/PHP

// - [ X ] HTML Form Structure
// - [ X ] GET vs. POST Methods
// - [ X ] Data Retrieval ($_GET, $_POST)
// - [ X ] Basic Validation
// - [ X ] **Mini Project**: Contact Form with Processing

// HTML form structure

// See page.php

// GET vs. POST methods

// The GET method passes input values ​​in the URL, which can create a data security vulnerability.
// The POST method places data in the message body, masked, but not encrypted.

// Data retrieval ($_GET, $_POST)
// Several methods, either here or in reception.php

$name = "";
$email = "";
$message = "";
$emailNotGood = "";
$success = false;
// A variable `successMessage` can be initialized and is intended to change depending on the step (validation/submission)
// var_dump($_POST); // Remove "//" To see the data sent

if($_SERVER["REQUEST_METHOD"] == "POST"){ //We check that our form send datas by method="POST"

    // Check if the fields are filled in (<input name="name">, ...)
    // Initialize $_POST[''] in each variables previously created
    if(isset($_POST['name'])){
        $name = htmlspecialchars($_POST['name']); // htmlspecialchars to avoid HTML balises injection
    }

    if(isset($_POST['email'])){
        $email = htmlspecialchars($_POST['email']);
    }

    if(isset($_POST['message'])){
        $message = htmlspecialchars($_POST['message']);
    }

    // Email validation
    // Point for later, without necessarily checking the email address (example@test.com)
    //  We could send a confirmation email to the address to grant access to the account.
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        // if email doesn't get filtered, that means it's not good enough
        $emailNotGood = "Mail is invalid";
        // $_POST can go though HTML but won't go into your DataBase (DB)
    } else {
        // Here you can send datas into your DB if you want to

        // *****************************************************************
        // *****************************************************************
        // **************** localhost mail() doesn't work ******************
        // *****************************************************************
        // *****************************************************************

        // Recipient (me)
        $destinataire = "exemple@mail.fr"; //Enter your mail
        // Title
        $sujet = "New message from ".$name;
        // Content
        $emailContent = "Nom : ".$name."\n";
        $emailContent .= "Email : ".$email."\n\n";
        $emailContent .= "Message : \n".$message;

        // From : 
        $headers = "From: no-reply@your-site.com\r\n";
        // Reply-to :
        $headers .= "Reply-To: ". $email . "\r\n";
        // Gestion des accents
        $headers .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";

        // Check if variables are true
        if(mail($destinataire, $sujet, $emailContent, $headers)){
            $success = true;
            // empty variables
            $name = "";
            $email = "";
            $message = "";
        } else{
            $emailNotGood = "An error occured while sending mail.";
        }
        
    }

}
   

?>

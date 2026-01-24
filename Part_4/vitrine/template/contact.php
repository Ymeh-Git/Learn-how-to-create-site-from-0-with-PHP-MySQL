<?php 
// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = "";
    $email = "";
    $message = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 

        if(isset($_POST['name'])){
            $name = htmlspecialchars($_POST['name']);
        }

        if(isset($_POST['email'])){
            $email = htmlspecialchars($_POST['email']);
        }

        if(isset($_POST['message'])){
            $message = htmlspecialchars($_POST['message']);
        }

        // Here you can send datas into your DB if you want to,
        // This way we could manage, respond to mail in the website
        if($name !=="" && $email !=="" && $message !==""){
            $success = addContactForm($name, $email, $message);
            // HERE a simple table as been created (id, name, email, message) we could add a status that only an Admin could manage (read, answered, waiting) 
            // depending on what status we could send an automatic email with mail();
            // We could add a createdAt as well, this way we could weither notify Admin to read mails OR delete mail in DB if status = toBeDeleted
            if($success){
                // Show a text saying all good
            } elseif(!$success){
                // Show a text saying no good
            }
        }
    }
}
?>

<!-- Main content -->
<form action="" method="POST">
    <div>
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        
        <label for="message">Message</label>
        <textarea type="text" id="message" name="message"></textarea>
    </div>
    <div class="btn-field">
        <input type="submit" id="submitBtn" class="btn btn-disabled" value="Send a message" disabled>
    </div>
</form>

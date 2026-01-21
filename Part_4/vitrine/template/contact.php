<?php 

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = "";
    $email = "";
    $message = "";
    // $emailNotGood = "";
    // $success = false;
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
            // $emailNotGood = "Mail is invalid";
            // $_POST can go though HTML but won't go into your DataBase (DB)
        } else {
            // Here you can send datas into your DB if you want to,
            // This way we could manage, respond to mail in the website
            
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

<?php 

use \Core\Class\Account;
use \Core\Class\EmailSender;

// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

$message = array();
// Test to see and style my div
        // $message = [
        //     "success" => true,
        //     "success_message" => "Your account has been created"
        // ];
// 
if($_SERVER['REQUEST_METHOD'] === "POST"){
    try{
        $account= new Account($pdo);
        $account->email = $_POST['email']; 
        $account->password = $_POST['password']; 
    
        if($account->create()){
            try{
                // Send mail need : email and id so: 
                // we have to check if our account exist (return assoc array)
                $account_exist = $account->check_email();
                if($account_exist){
                    // If it does exist, then we can take id and email from $account_exist
                    $id = $account_exist['id'];
                    $email = $account_exist['email'];

                    // Send email here
                    $send_email = new EmailSender($php_mailer);

                    $send_email->mail_user = $email; 
                    // !!! WARNING !!! CHANGE URL ONCE OUR SITE IS PUBLIC
                    $send_email->content .= "http://localhost:3000/Part_5/SP_20/index.php?route=auth/activate-account&id=".$id;
                    // !!! WARNING !!!
                    if($send_email->active_account_email()){

                    }
                } 

                $message = [
                    "success" => true,
                    "success_message" => "Your account has been created, check your mails to activate it"
                ];

            } catch(PDOException $e){
                $message = [
                    'success' => false,
                    'error_message' => "Can't send an Email to activate your account... Please contact our support team",
                    'error' => $e->getMessage()
                ];
            }
        }
    } catch(PDOException $e){
        $message = [
            'success' => false,
            'error_message' => "Account already exist",
            'error' => $e->getMessage()
        ];
        // echo $e->getMessage();
    }
}

?>

<form action="" method="POST">
    <div class="form-input">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="exemple@mail.fr" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="********" required>

        <label for="verif_password">Verif Password</label>
        <input type="password" id="verif_password" name="verif_password" placeholder="********" required>
    </div>
    <div class="btn-field">
        <input type="submit" id="submitBtn" value="Sign up" class="btn btn-disabled" disabled>
    </div>
    <p>Have an account ? <a href="index.php?route=auth/login">Log in</a></p>
    
    <!-- SUCCESS OR ERROR MESSAGE -->
    <?php if(!empty($message)) :?>
        <?php if($message['success']) :?>
            <div class="message success_message">
                <p><?= $message['success_message']?></p>
            </div>
        <?php elseif($message['success'] == false) :?>
            <div class="message error_message">
                <p><?= $message['error_message']?></p>
                <p><?= $message['error']?></p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</form>

<script>
    const password_input = document.getElementById('password');
    const verif_password_input = document.getElementById('verif_password');
    const btn = document.getElementById('submitBtn');

    function checkPassword(){
        const password_value = password_input.value;
        const verif_password_value = verif_password_input.value;

        if(password_value !== "" && password_value !== verif_password_value){
            btn.disabled = true;
            btn.classList.add('btn-disabled');
            btn.classList.remove('btn-abled');
        }
        if(password_value == verif_password_value){
            btn.disabled = false;
            btn.classList.add('btn-abled');
            btn.classList.remove('btn-disabled');
        }
    }

    password_input.addEventListener('input', checkPassword);
    verif_password_input.addEventListener('input', checkPassword);
</script>
<?php 

use \Core\Class\Account;

// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

$email = "";
$password = ""; 

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $message = array();
    try{
        $email = filter_var(($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
    
        if (!empty($email) && !empty($password)){
    
            $account = new Account($pdo);
            $account->email = $email;
    
            $account_exist = $account->check_email();

            if($account_exist){
                echo "<pre>". $account_exist['status'] ."</pre>";
                if(password_verify($password, $account_exist['password'])){
                    if($account_exist['status'] == 'VALIDATE'){
                        $_SESSION['user'] = [
                            'id' => $account_exist['id'],
                            'email' => $account_exist['email'],
                            'created_at' => $account_exist['created_at'],
                            // Add CSRF
                        ];
            
                        header('location: index.php?success_message=Connexion%20successful');
                        exit();
                    } else{
                        throw $e = new PDOException("Check your email to activate your account"); 
                    }

                } else{ 
                    throw $e = new PDOException("Wrong password"); 
                }
            } else{ 
                throw $e = new PDOException("Account does not exist");
            }
        }
    } catch(PDOException $e){
        $message = [
            "success" => false,
            "error" => $e->getMessage()
        ];
    }
}

?>

<form action="" method="POST">
    <div class="form-input">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="exemple@mail.fr" value="<?= $email?>" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="********" value="<?= $password?>"required>

        <!-- SUCCESS OR ERROR MESSAGE -->
        <?php if(!empty($message)) :?>
            <?php if($message['success'] == false && $message['error'] != "") :?>
                <div class="message error_message">
                    <p><?= $message['error']?></p>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <input type="hidden" id="csrf" name="csrf" value="">
    </div>
    <div class="btn-field">
        <input type="submit" id="submitBtn" value="Log In" class="btn btn-able">
    </div>
    <p>No account ? <a href="index.php?route=auth/signup">Sign up</a></p>
</form>


<?php 

use \Core\Class\Account;

// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

try{

    $message = array();

    if(isset($_GET['id'])){
        $account = new Account($pdo);
        $account->id = $_GET['id'];
    
        $status = $account->get_status();
        if($status && $status['status'] == 'OFF'){
            // Change status
            if($account->set_status()){
                $message = [
                    "success" => true,
                    "success_message" => 'Your account is now activated'
                ];
            } else{
                $message = [
                    "success" => false,
                    "error_message" => 'Can\'t activate your account, contact our support team',
                    "error" => $e->getMessage()
                ];
            }
        }
    }
    // GET id from URL
} catch(PDOException $e){
    $message = [
        "success" => false,
        "error_message" => 'An error occured while trying to get your account',
        "error" => $e->getMessage()
    ];
}


?>


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
<a href="index.php?route=home">Homepage</a>
<a href="index.php?route=auth/login">Log In</a>
</div>
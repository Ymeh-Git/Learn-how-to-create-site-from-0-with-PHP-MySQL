<!-- Account page -->
<?php 
use \Core\Class\Account;

// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

if(isset($_SESSION['user'])){

    try{
        $account = new Account($pdo);
        $account->id = $_SESSION['user']['id'];
        $my_account = $account->read();
    
        if($my_account){
            $message = [
                'success' => true,
                'success_message' => 'Good to see you, do you want to change anything ?'
            ];
        }

        $new_password =""; //Empty this way no one can access your real password from this page
        
        // UPDATE ACCOUNT
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $account->id = $_POST['id'];
            $account->email = $_POST['email'];
            $old_password = null; //Don't change it

            if(isset($_POST['password']) && $_POST['password'] !== ""){
                $account->password = $_POST['password'];
            } else {
                $account->password = null;
            }

            if($account->update()){
                $message =[
                    'success' => true,
                    'success_message' => 'Account updated successfully'
                ];

                $my_account['email'] = $_POST['email'];
            } else{
                $message =[
                    'success' => false,
                    'error_message' => 'Unable to update your account'
                ];
            }
        }

        // DELETE ACCOUNT
        // HERE with one button we delete, we could also send an email with a link to the real page for deleting your account.
        // This way only people with access to $my_account['email'] could delete the account.
        if($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['action']) && $_POST['action'] == 'delete_account')){
            if((isset($_SESSION['user']['id']) && $_SESSION['user']['id'] == $my_account['id'])){
                $account_to_delete = new Account($pdo);
                $account_to_delete->id = $_SESSION['user']['id'];

                if($account_to_delete->delete()){
                    // If true, then logout
                    session_unset(); // Empty session's variables
                    session_destroy(); // Destroy session

                    // Then you go back to homepage
                    header('location: index.php');
                    exit(); 
                } else{
                    $message =[
                        'success' => false,
                        'error_message' => 'Unable to delete your account'
                    ];
                }
            }
        }

    } catch(PDOException $e){
            $message = [
                'success' => false,
                'error_message' => 'Can\'t access your data, reload.',
                'error' => $e->getMessage()
            ];
    }
}

?>

<h1>Account</h1>
<form action="" method="POST">
    <div class="form-input">
        <input type="hidden" id="id" name="id" value="<?= $my_account['id'];?>">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="exemple@mail.fr" value="<?= $my_account['email'];?>" required>
        <!-- IF CHECKED THEN SHOW PASSWORD INPUTS -->
        <div class="checkbox">
            <input type="checkbox" name="change_password" id="change_password">
            <label for="change_password">Do you want to change password ?</label>
        </div>
        <label for="password" hidden>Password</label>
        <input type="password" id="password" name="password" placeholder="********" value="<?= $new_password;?>" disabled hidden>

        <label for="verif_password" hidden>Verif Password</label>
        <input type="password" id="verif_password" name="verif_password" placeholder="********" value="<?= $new_password?>" disabled hidden>
    </div>
    <div class="btn-field">
        <input type="submit" id="submitBtn" value="Update" class="btn btn-disabled" disabled>
    </div>
    
    <!-- SUCCESS OR ERROR MESSAGE -->
    <?php if(!empty($message)) :?>
        <?php if($message['success']) :?>
            <div class="message success_message">
                <p><?= $message['success_message']?></p>
            </div>
        <?php elseif($message['success'] == false) :?>
            <div class="message error_message">
                <p><?= $message['error_message']?></p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</form>


<form method="POST" action="" onsubmit="return confirm('Do you want to delete this account <?= $my_account['email']?> ?');" style="display:inline;">
    <input type="hidden" name="id" value="<?= $my_account['id'] ?>">
    <input type="hidden" name="action" value="delete_account">
    <div class="btn-field">
        <input type="submit" class="btn btn-red" value="Delete Account">
    </div>
</form>


<script>
    const email_input = document.getElementById('email');
    const checkbox_password = document.getElementById('change_password');

    const password_input = document.getElementById('password');
    const verif_password_input = document.getElementById('verif_password');
    const btn = document.getElementById('submitBtn');
    
    function showPassword(){
        const email_value = email_input.value;

        if(checkbox_password.checked){
            password_input.disabled = false;
            password_input.hidden = false;
            verif_password_input.disabled = false;
            verif_password_input.hidden = false;
            btn.disabled = true;
            btn.classList.add('btn-disabled');
            btn.classList.remove('btn-abled');
        } else if(!checkbox_password.checked){
            password_input.disabled = true;
            password_input.hidden = true;
            verif_password_input.disabled = true;
            verif_password_input.hidden = true;
            if (email_value != "") {
                btn.disabled = false;
                btn.classList.add('btn-abled');
                btn.classList.remove('btn-disabled');
            }
        }
    }

    function checkPassword(){
        const password_value = password_input.value;
        const verif_password_value = verif_password_input.value;
        if((verif_password_input.disabled !== true && verif_password_input.hidden !== true) && (password_input.disabled !== true && password_input.hidden !== true)){

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
        } else {
            btn.disabled = false;
            btn.classList.add('btn-abled');
            btn.classList.remove('btn-disabled');
        }
    }
    
    checkbox_password.addEventListener('input', showPassword);
    email_input.addEventListener('input', showPassword)
    password_input.addEventListener('input', checkPassword);
    verif_password_input.addEventListener('input', checkPassword);
</script>
<?php 
// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

if($page == 'home' && isset($_SESSION['user'])){
    if(isset($_GET['success_message']) && isset($_SESSION['user']) && $page == "home"){
        // Check in ./template/auth/login.php
        $message = ($_GET['success_message'] !== "Connexion successful") ? null : $_GET['success_message'];
    }
}

?>
<!-- SUCCESS OR ERROR MESSAGE -->
<?php if(!empty($message)) :?>
    <div class="message success_message">
        <p><?= $message ?></p>
        <p>Hello <?= htmlspecialchars($_SESSION['user']['email']) ?>, your account has been created since <?= date_format($date = new \Datetime($_SESSION['user']['created_at']), 'Y') ?></p>
    </div>
<?php endif; ?>


<h1>HOMEPAGE</h1>

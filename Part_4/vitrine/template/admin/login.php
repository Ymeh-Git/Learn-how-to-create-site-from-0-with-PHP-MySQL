<?php 
// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

if (isset($_SESSION['user'])) {
    header('Location: index.php?route=admin/dashboard');
    exit();
}

// N'oublions pas de vider les variables
$email = "";
$password = ""; 

$message = ""; //Afficher un message d'erreur selon la situation*
if($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = filter_var(($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    if (!empty($email) && !empty($password)){
        $pdo = getPDO();
        $sql = "SELECT * FROM users WHERE email = :email";
        $statement = $pdo->prepare($sql); 
        $statement->bindValue('email', $email, PDO::PARAM_STR);
        $statement->execute();

        $admin = $statement->fetch(PDO::FETCH_ASSOC);

        if($admin && password_verify($password, $admin['password'])){
            $_SESSION['user'] = [
                'id' => $admin['id'],
                'firstname' => $admin['firstname'],
                'lastname' => $admin['lastname'],
                'email' => $admin['email'],
                'role' => $admin['role'],
            ];

            header('location: index.php');
            
            exit();
        } else {
            $message = "Identifiants incorrects...";
        }
    }
}

?>

<form action="" method="POST">
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="exemple@mail.fr" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="********" required>
    </div>
    <div class="btn-field">
        <input type="submit" id="submitBtn" value="Login" class="btn btn-disabled" disabled>
    </div>
</form>

<script>formLoginBtn();</script>

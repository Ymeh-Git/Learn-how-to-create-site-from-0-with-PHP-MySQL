<?php 
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

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){
            $_SESSION['user'] = [
                'id' => $user['id'],
                'pseudo' => $user['pseudo'],
                'email' => $user['email'],
                'role' => $user['role'],
            ];

            header('location: main.php');
            
            exit();
        } else {
            $message = "Identifiants incorrects...";
        }
    }
}
?>

<!-- Ici se trouvera le HTML du main de signinIndex.php -->

<div class="parent">
    <div class="enfant">
        <form action="" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="exemple@mail.fr" required>
            
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="********" required>

            <div class="btn-field">
                <input type="submit" id="submitBtn" value="Se connecter" class="btn btn-grey" readonly>
            </div>
        </form>
        <div class="btn-field">
            <a href="main.php" class="btn btn-red">Retour à l'accueil</a>
            <a href="signupIndex.php" class="btn btn-info">Pas de compte ?</a>
        </div>
    </div>
</div>

<!-- Ajout de JS pour le bouton -->
<script>
    // Récupérons les inputs
    const emailInput = document.getElementById('email');
    const passInput = document.getElementById('password');
    const btn = document.getElementById('submitBtn');

    function checkForm(){
        // Attribuons la valeur d'un input à une variable
        const emailValue = emailInput.value;
        const passValue = passInput.value;
        // Vérifions que tous les champs soient remplis
        if (emailValue !== "" && passValue !== ""){ 
            btn.disabled = false;
            btn.classList.remove('btn-grey');
            btn.classList.add('btn-green');
        } else{
            // Si les champs sont vides alors le bouton est désactivé
            btn.disabled = true;
            btn.classList.remove('btn-green');
            btn.classList.add('btn-grey');
        }
    }

    // Nous écoutons les inputs pour activer ou désactiver le bouton
    emailInput.addEventListener('input', checkForm);
    passInput.addEventListener('input', checkForm);
</script>
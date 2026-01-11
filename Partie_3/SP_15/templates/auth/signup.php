<?php 
// N'oublions pas de vider les variables
$pseudo = "";
$email = "";
$password = ""; 
$verifPassword = "";

$message = ""; //Afficher un message d'erreur selon la situation*

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $verifPassword = $_POST['verifPassword'];

    if(empty($pseudo) || empty($email) || empty($password) || empty($verifPassword)){
        // * Situation 1
        $message = "Tous les champs sont requis";

    } elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ // La condition ici doit être !true = false
        // * Situation 2
        $message = "L'adresse mail indiquée n'est pas valide";

    } elseif(empty($_POST['password'])) { // Si le mdp est vide alors ce elseif sera executé
        // * Situation 3
        $message = "Le mot de passe est requis";

    } else { // Si le mail est correct et que le mdp est rempli, nous pouvons créer notre compte.
        
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        createAccount($pseudo, $email, $passwordHash);

        // header('location: signinIndex.php');
    }
}
?>

<!-- Ici se trouvera le HTML du main de signupIndex.php -->

<div class="parent">
    <div class="enfant">
        <form action="" method="POST">
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" placeholder="RedJohn" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="exemple@mail.fr" required>
            
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="********" required>

            <label for="verifPassword">Vérification du mot de passe</label>
            <input type="password" id="verifPassword" name="verifPassword" placeholder="********" required>
            <!-- Nous pourrions rajouter un text en hidden(true) et le travailler en JS selon les conditons non remplies -->
            <span id="confirmPassword" style="font-size:smaller; color: green;" hidden>Les mots de passe sont identiques</span>
            <div class="btn-field">
                <input type="submit" id="submitBtn" value="Créer un compte" class="btn btn-grey" readonly>
            </div>
        </form>
        <div class="btn-field">
            <a href="main.php" class="btn btn-red">Retour à l'accueil</a>
            <a href="signinIndex.php" class="btn btn-info">Déjà un compte ?</a>
        </div>
    </div>
</div>

<!-- Ajout de JS pour le bouton -->
<script>
    // Récupérons les inputs
    const pseudoInput = document.getElementById('pseudo');
    const emailInput = document.getElementById('email');
    const passInput = document.getElementById('password');
    const verifPassInput = document.getElementById('verifPassword');
    const confirmPassInput = document.getElementById('confirmPassword')
    const btn = document.getElementById('submitBtn');

    function checkForm(){
        // Attribuons la valeur d'un input à une variable
        const pseudoValue = pseudoInput.value;
        const emailValue = emailInput.value;
        const passValue = passInput.value;
        const verifPassValue = verifPassInput.value;

        // Affichage de la balise <span> quand les conditions sont remplies
        if(verifPassValue == passValue && passValue != ""){
            confirmPassInput.hidden = false
        } else {
            confirmPassInput.hidden = true
        }
        // Vérifions que tous les champs soient remplis
        if (pseudoValue !== "" && emailValue !== "" && passValue !== "" && verifPassValue !== ""){ 
            // Et que les valeurs du pwd et de la vérif soient identiques
            if(passValue == verifPassValue){
                btn.disabled = false;
                btn.classList.remove('btn-grey');
                btn.classList.add('btn-green');
            } else {
                // Si les mdp's ne correspondent pas alors le bouton est désactivé
                btn.disabled = true;
                btn.classList.remove('btn-green');
                btn.classList.add('btn-grey');
            }
        } else{
            // Si les champs sont vides alors le bouton est désactivé
            btn.disabled = true;
            btn.classList.remove('btn-green');
            btn.classList.add('btn-grey');
        }
    }

    // Nous écoutons les inputs pour activer ou désactiver le bouton
    pseudoInput.addEventListener('input', checkForm);
    emailInput.addEventListener('input', checkForm);
    passInput.addEventListener('input', checkForm);
    verifPassInput.addEventListener('input', checkForm);
</script>
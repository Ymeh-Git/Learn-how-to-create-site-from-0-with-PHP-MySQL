<?php 
// Requêtes préparées (SÉCURITÉ)

// - [ X ]  Prévention injections SQL
// - [ X ]  bind_param(), execute()
// - [ X ]  **Exercice** : Formulaire d'inscription sécurisé

$server = "localhost"; 
$user = "root";
$pswd = "";
$dbName = "bibliothèque"; 

$email = "";
$password = "";
$NotGood = "";

// Récupérons la vérification des champs effectuées dans les exercices précédents

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['email'])){
        $email = htmlspecialchars($_POST['email']); // htmlspecialchars pour éviter les injections de codes malveillants
    }

    if(isset($_POST['password'])){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Sécurise le MDP en BDD de l'utilisateur empêchant donc d'être révélé en cas d'entrée malveillante dans la BDD
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

        $NotGood = "L'adresse mail indiquée n'est pas valide";

    } elseif(empty($_POST['password'])) {
        $NotGood = "Le mot de passe est requis";
    } 
    else {

        try {
        $database = new PDO("mysql:host=$server;dbname=$dbName;charset=utf8mb4", $user, $pswd);
        // Requête préparée
        // Étape 1 : préparation
        $sql ="INSERT INTO users(email, password) VALUES(:email, :password)"; 
        $statement =  $database->prepare($sql);

        // Étape 2 : Définir les variables
        // Définies dans le premier "if" ($email / $password)

        // Étape 3 : lier les paramètres
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);

        // Étape 4 (FINALE) : Exécuter la requête
        $statement->execute();

        // SUCCESS : Pour éviter le problème du F5/Refresh, on redirige vers la même page (ou une page de succès)
        // Cela vide le $_POST
        header("Location: " . $_SERVER['PHP_SELF'] . "?status=success");
        exit();

        } catch(PDOException $e){

            echo "Une erreur est survenue : ".$e->getMessage();

        }
    }
}
?>

<?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <p style="color:green;">Inscription réussie ! Vous pouvez vous connecter.</p>
<?php endif; ?>

<?php if($NotGood): ?>
    <p style="color:red;"><?php echo $NotGood; ?></p>
<?php endif; ?>

<form action="" method="POST">
    <label for="email">Email</label><br>
    <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"><br><br>
    
    <label for="password">Mot de passe</label><br>
    <input type="password" name="password" id="password"><br><br>
    
    <input type="submit" value="S'inscrire" class="btn">
</form>
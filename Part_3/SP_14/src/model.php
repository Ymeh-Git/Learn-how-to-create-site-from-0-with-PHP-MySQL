<?php
require_once('config/db.php');

function getAllUsers(){
    $pdo = getPDO();
    $sql = "SELECT id, pseudo, email, role FROM users";
    $query = $pdo->query($sql);

    $users = $query->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

// Vérification de l'existance d'un compte au préalable
function checkAvailability($pseudo, $email) {
    $pdo = getPDO(); // Votre fonction de connexion

    // On cherche si une ligne correspond à l'email OU au pseudo
    $sql = "SELECT email, pseudo FROM users WHERE email = :email OR pseudo = :pseudo";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $stmt->execute();
    
    // On récupère le résultat s'il existe
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        // On vérifie lequel des deux a bloqué
        if ($existingUser['email'] === $email) {
            return "Ce mail est déjà utilisé.";
        }
        if ($existingUser['pseudo'] === $pseudo) {
            return "Ce pseudo est déjà utilisé.";
        }
    }

    // Si rien trouvé, c'est bon
    return null; 
}

function createAccount($pseudo, $email, $password){
    try{
        $notAvailable = checkAvailability($pseudo, $email); // Renvoie 
        if($notAvailable){
            echo "<script>alert('$notAvailable')</script>";
        } else {
            // Si $notAvailable est false (donc qu'aucun compte n'existe avec ce mail et/ou ce pseudo) alors on créé le compte :
            $pdo = getPDO();
            $sql = "INSERT INTO users(pseudo, email, password)
                    VALUES (:pseudo, :email, :password)";
            $statement = $pdo->prepare($sql);
    
            $statement->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            $statement->bindParam(":password", $password, PDO::PARAM_STR);
        
            $statement->execute();

        }

    } catch(PDOException $e){
        echo "Une erreur est survenue lors de la création du compte :" .$e->getMessage();
    }
}

function setSession($email, $password){
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

function adminDeleteAccount($id){
    $pdo = getPDO();
    $sql = "DELETE FROM users WHERE `users`.`id` = :id";
    $request = $pdo->prepare($sql);
    $request->bindValue(':id', $id, PDO::PARAM_INT);
    $request->execute();
    
    header("Location: usersAdminIndex.php");
}

function lookingForAdmin(){
    try{
        $emailAdmin = "admin@site.fr";

        $pdo = getPDO();

        $sql = "SELECT * FROM users WHERE email = :email";
        $statement = $pdo->prepare($sql);

        $statement->bindParam(":email", $emailAdmin, PDO::PARAM_STR);
        $statement->execute();

        $userAdmin = $statement->fetch(PDO::FETCH_ASSOC);
        return $userAdmin;
    } catch(PDOException $e){
    echo "Erreur : ".$e->getMessage();
    }
}

function createAccountAdmin(){
    try{
        $pseudoAdmin = "Admin_User_1";
        $emailAdmin = "admin@site.fr";
        $passAdmin = "Test123";
        $roleAdmin = "ADMIN";

        // Puisqu'à la connexion il y a un traitement sur le hachage, nous devons également hacher le mdp
        $passAdmin = password_hash($passAdmin, PASSWORD_DEFAULT);

        $pdo = getPDO();

        $sql = "INSERT INTO users(pseudo, email, password, role)
                VALUES(:pseudo, :email, :password, :role)";
        $statement = $pdo->prepare($sql);

        $statement->bindParam(":pseudo", $pseudoAdmin, PDO::PARAM_STR);
        $statement->bindParam(":email", $emailAdmin, PDO::PARAM_STR);
        $statement->bindParam(":password", $passAdmin, PDO::PARAM_STR);
        $statement->bindParam(":role", $roleAdmin, PDO::PARAM_STR);

        $statement->execute();
    } catch(PDOException $e){
    echo "Erreur : ".$e->getMessage();
    }
}
$userAdmin = lookingForAdmin();
if(!$userAdmin){
createAccountAdmin();
}
?>
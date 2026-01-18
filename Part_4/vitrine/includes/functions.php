<?php 
require_once('database.php');
//We include database.php for $pdo 
$pdo = getPDO();
###########################################################
###########################################################
###########################################################

// This file contain all functions
// 1- USERS (created by admin for admins)
// 2- SERVICES
// 3- PRODUCTS
// 4- ADMIN

###########################################################
###########################################################
###########################################################

// USERS -> ADMIN

// By default $role = "USER", why ? In case someone find a way to create a user. I'll will add on register a new admin page that only with a session open by an admin, $role = "ADMIN"
// There will be no input for role that way i'll be able to detect and delete false account
// In case that in the future we let people create an account it won't change.
function addUser($firstName, $lastName, $email, $password, $role="USER"){

    $pdo = getPDO();
    $sql = "INSERT INTO users(firstname, lastname, email, password, role)
            VALUES (:firstname, :lastname, :email, :password, :role)";
    // Prepared request
    $stmt = $pdo->prepare($sql);
    
    // Binding parameters
    // Using bindValue means if we change variable, it has to be before it. Even between bindValue and execute() it won't work
    $stmt->bindValue(":firstname", $firstName , PDO::PARAM_STR);
    $stmt->bindValue(":lastname", $lastName , PDO::PARAM_STR);
    $stmt->bindValue(":email", $email , PDO::PARAM_STR);
    $stmt->bindValue(":password", $password , PDO::PARAM_STR);
    $stmt->bindValue(":role", $role , PDO::PARAM_STR);

    // Execute request
    $stmt->execute();

}

// Usefull for admin purpose, this way we will be able to see all users, edit or delete them if needed. 
function getAllUsers(){
    
    $pdo = getPDO();
    $sql = "SELECT * FROM users";
    $query = $pdo->query($sql);

    $users = $query->fetchAll(PDO::FETCH_ASSOC);
    return $users;

}

// let the user edit his profile, is it necessary ?
function updateUser(){

}

// This way an Admin can delete an account
function deleteUser(){

    $pdo = getPDO();
}

// Check existing mail
function checkMailAvailability($email) {

    $pdo = getPDO();
    // We are looking for an email existing in users
    $sql = "SELECT email FROM users WHERE email = :email";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    
    // If our request work it will return true
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    // We check if it's true
    if ($existingUser) {
        // If it's true then return an error message
        if ($existingUser['email'] === $email) {
            return "Ce mail est déjà utilisé.";
        }
    }

    // Since we are here after if($existingUser) then $existingUser is false
    // "return null" like nothing happened. Since we want to continue.
    return null; 

}

function addMail($name, $email, $message){
    $sql = "INSERT INTO mails (name, email, message)
            VALUES (:name, :email, :message)";
    $stmt = $pdo->prepare($sql);
}
// -----

// SERVICES
// Create
function addService($name, $price){

    $pdo = getPDO();
    $sql = "INSERT INTO services (name, price)
            VALUES (:name, :price)";
    // Prepared request
    $stmt = $pdo->prepare($sql);
    
    // Binding parameters
    $stmt->bindValue(":name", $name , PDO::PARAM_STR);
    $stmt->bindValue(":price", $price , PDO::PARAM_INT);

    // Execute request
    $stmt->execute();

}

// Read
function getAllServices(){

    $pdo = getPDO();
    $sql = "SELECT * FROM services";
    $query = $pdo->query($sql);

    $services = $query->fetchAll(PDO::FETCH_ASSOC);
    return $services;

}

// Update
function updateService(){
    $pdo = getPDO();
    $sql = "UPDATE ";
}

// Delete
function deleteService(){
    
}
// --------

// PRODUCTS
function addProduct($name, $price, $img, $reference){

    $pdo = getPDO();
    $sql = "INSERT INTO products (name, price, img, reference)
            VALUES (:name, :price, :img, :reference)";
    // Prepared request
    $stmt = $pdo->prepare($sql);

    // Binding parameters
    $stmt->bindValue(":name", $name , PDO::PARAM_STR);
    $stmt->bindValue(":price", $price , PDO::PARAM_INT);
    $stmt->bindValue(":img", $img , PDO::PARAM_STR);
    $stmt->bindValue(":reference", $reference , PDO::PARAM_STR);

    // Execute request
    $stmt->execute();

}

function getAllProducts(){

    $pdo = getPDO();
    $sql = "SELECT * FROM products";
    $query = $pdo->query($sql);

    $products = $query->fetchAll(PDO::FETCH_ASSOC);
    return $products;

}

function updateProduct(){

    $pdo = getPDO();
}

function deleteProduct(){

    
}
// --------

// Functions for Admin
function lookingForSpecificAdmin(){
    try{
        $emailAdmin = "admin@site.fr";

        $pdo = getPDO();

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":email", $emailAdmin, PDO::PARAM_STR);
        $stmt->execute();

        $existingAdmin = $stmt->fetch(PDO::FETCH_ASSOC);
        return $existingAdmin;
    } catch(PDOException $e){
    echo "Error while looking for admin : ".$e->getMessage();
    }
}

function createSpecificAdminAccount(){
    try{
        $firstNameAdmin = "Admin_User_1";
        $lastNameAdmin = "Site";
        $emailAdmin = "admin@site.fr";
        $passAdmin = "Test123";
        $roleAdmin = "ADMIN";

        // Puisqu'à la connexion il y a un traitement sur le hachage, nous devons également hacher le mdp
        $passAdmin = password_hash($passAdmin, PASSWORD_DEFAULT);

        addUser($firstNameAdmin, $lastNameAdmin, $emailAdmin, $passAdmin, $roleAdmin);

    } catch(PDOException $e){
    echo "Error while creating admin account : ".$e->getMessage();
    }
}
// -------------------

$existingAdmin = lookingForSpecificAdmin();

// If there is no admin account, create one (admin@site.fr).
if(!$existingAdmin){
createSpecificAdminAccount();
}
// This way at least one admin will always be here and access every admin functionnalities


function uploadImage($file) {
    $dossierStockage = __DIR__ . '/assets/uploads/'; // Dossier final
    $size = 2 * 1024 * 1024; // 2 Mo en octets
    
    // Extensions autorisées (Whitelist)
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    // Types MIME autorisés (Pour vérifier le contenu réel du fichier)
    $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    // 2. VÉRIFICATION DES ERREURS D'UPLOAD
    if ($file['error'] !== 0) {
        return "Transfer error (Code: " . $file['error'] . ")";
    }

    // 3. VÉRIFICATION DE LA TAILLE
    if ($file['size'] > $size) {
        return "The file is above limit (Max 2Mo).";
    }

    // 4. VÉRIFICATION DE L'EXTENSION ET DU TYPE MIME
    // On récupère l'extension du fichier envoyé
    // pathinfo(path, flags);
    // flags spécifie l'élément retourné, ici l'extension
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    // On vérifie si l'extension est dans notre liste
    if (!in_array($extension, $allowedExtensions)) {
        return "Only JPG, PNG, GIF and WEBP are allowed.";
    }

    // Sécurité supplémentaire : On vérifie le TYPE MIME réel du fichier
    // (Empêche de renommer un script .php en .jpg)
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file['tmp_name']);

    if (!in_array($mimeType, $allowedMimes)) {
        return "File corrupted or it is not a valid image.";
    }

    // 5. NETTOYAGE ET RENOMMAGE (CRUCIAL)
    // On ne garde JAMAIS le nom d'origine (risque d'écrasement ou de piratage)
    // On génère un nom unique : unique_id + extension
    $newName = uniqid('img_', true) . '.' . $extension;
    
    // Chemin final complet
    $finalFilePath = $dossierStockage . $newName;

    // 6. DÉPLACEMENT FINAL
    // move_uploaded_file vérifie que c'est bien un fichier uploadé et le déplace
    if (move_uploaded_file($file['tmp_name'], $finalFilePath)) {
        // SUCCÈS ! On retourne le chemin ou le nom du fichier pour la BDD
        return [
            'success' => true,
            'filename' => $newName,
            'path' => $finalFilePath
        ];
    } else {
        return "Error while saving file.";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    
    // Créer le dossier s'il n'existe pas
    if (!is_dir('assets/uploads')) {
        mkdir('assets/uploads', 0755, true);
    }
    
    $result = uploadImage($_FILES['avatar']);

    if (is_array($result) && $result['success']) {
        echo "Upload as been a success ! Name : " . $result['filename'];

        // Enregistrement vers la BDD
        addProduct($result['filename']);
        if(isset($_SESSION['user']) && $_SESSION['user']['role'] == "ADMIN"){header('location: index.php?route=dashboard');}
        
    } else {
        echo "Erreur : " . $result;
    }
}
?>
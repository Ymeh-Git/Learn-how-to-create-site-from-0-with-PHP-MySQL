<?php session_start();?>
<?php 

require('src/model.php');
// Il faut savoir que les fichiers contrairement aux textes sont stock non dans $_POST à l'envoie d'un formulaire, mais dans $_FILES
// $_FILES = 
// [
// "name" => le nom d'origine (qui est à changer)
// "type" => type MIME (image/jpeg)
// "tmp_name" =>  endroit temporaire où PHP a mis le fichier 
// "error" => return 0 en cas de succès
// "size" => taille en octets
// ]

function uploadImage($file) {
    // 1. DÉFINIR LES RÈGLES
    $dossierStockage = __DIR__ . '/uploads/'; // Dossier final
    $tailleMax = 2 * 1024 * 1024; // 2 Mo en octets
    
    // Extensions autorisées (Whitelist)
    $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    // Types MIME autorisés (Pour vérifier le contenu réel du fichier)
    $mimesAutorises = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    // 2. VÉRIFICATION DES ERREURS D'UPLOAD
    if ($file['error'] !== 0) {
        return "Erreur lors du transfert (Code: " . $file['error'] . ")";
    }

    // 3. VÉRIFICATION DE LA TAILLE
    if ($file['size'] > $tailleMax) {
        return "Le fichier est trop volumineux (Max 2Mo).";
    }

    // 4. VÉRIFICATION DE L'EXTENSION ET DU TYPE MIME
    // On récupère l'extension du fichier envoyé
    // pathinfo(path, flags);
    // flags spécifie l'élément retourné, ici l'extension
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    // On vérifie si l'extension est dans notre liste
    if (!in_array($extension, $extensionsAutorisees)) {
        return "Extension non autorisée. Seuls JPG, PNG, GIF et WEBP sont acceptés.";
    }

    // Sécurité supplémentaire : On vérifie le TYPE MIME réel du fichier
    // (Empêche de renommer un script .php en .jpg)
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file['tmp_name']);

    if (!in_array($mimeType, $mimesAutorises)) {
        return "Le fichier semble corrompu ou n'est pas une image valide.";
    }

    // 5. NETTOYAGE ET RENOMMAGE (CRUCIAL)
    // On ne garde JAMAIS le nom d'origine (risque d'écrasement ou de piratage)
    // On génère un nom unique : unique_id + extension
    $nouveauNom = uniqid('img_', true) . '.' . $extension;
    
    // Chemin final complet
    $cheminFinal = $dossierStockage . $nouveauNom;

    // 6. DÉPLACEMENT FINAL
    // move_uploaded_file vérifie que c'est bien un fichier uploadé et le déplace
    if (move_uploaded_file($file['tmp_name'], $cheminFinal)) {
        // SUCCÈS ! On retourne le chemin ou le nom du fichier pour la BDD
        return [
            'success' => true,
            'filename' => $nouveauNom,
            'path' => $cheminFinal
        ];
    } else {
        return "Erreur lors de l'enregistrement du fichier.";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    
    // Créer le dossier s'il n'existe pas
    if (!is_dir('uploads')) {
        mkdir('uploads', 0755, true);
    }
    
    $resultat = uploadImage($_FILES['avatar']);

    if (is_array($resultat) && $resultat['success']) {
        echo "Image uploadée avec succès ! Nom : " . $resultat['filename'];

        // Enregistrement vers la BDD
        addImage($resultat['filename']);
        if(isset($_SESSION['user']) && $_SESSION['user']['role'] == "USER"){header('location: main.php');}
        if(isset($_SESSION['user']) && $_SESSION['user']['role'] == "ADMIN"){header('location: usersAdminIndex.php');}
        
    } else {
        echo "Erreur : " . $resultat;
    }
}
?>
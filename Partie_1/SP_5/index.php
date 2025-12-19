<?php 
// Formulaires HTML/PHP

// - [ X ]  Structure formulaire HTML
// - [ X ]  Méthodes GET vs POST
// - [ X ]  Récupération données ($_GET, $_POST)
// - [ X ]  Validation basique
// - [ X ]  **Mini Projet** : Formulaire de contact avec traitement

// Structure formulaire HTML

// Voir page.php

// Méthodes GET vs POST

// Méthode GET passe les valeurs de l'input dans l'URL, ce qui peut générer une faille de sécurité d'informations
// Méthode POST données dans le corps du message, masquées, mais non cryptées

// Récupération données ($_GET, $_POST)
// Plusieurs manières soit ici, soit reception.php

$name = "";
$email = "";
$message = "";
$emailNotGood = "";
$success = false;
// Une variable successMessage peut être initialisée et qui est vouée à changer selon l'étape (validation/envoi)
// var_dump($_POST); // Pour voir les données envoyées

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Vérifier si les champs sont remplies (<input name="name">, ...)
    if(isset($_POST['name'])){
        // Les attribuers à notre variables créée au préalable
        $name = htmlspecialchars($_POST['name']); // htmlspecialchars pour éviter les injections de codes malveillants
    }

    if(isset($_POST['email'])){
        $email = htmlspecialchars($_POST['email']);
    }

    if(isset($_POST['message'])){
        $message = htmlspecialchars($_POST['message']);
    }

    // Validation du mail
    // Point pour plus tard, sans forcément vérifier la composition du mail(exemple@test.com)
    // nous pourrions envoyer un mail de confirmation à l'adresse pour avoir accès à son compte.
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        // Si l'email ne correspond pas au filtre, alors :
        $emailNotGood = "L'adresse mail indiquée n'est pas valide";
        // Les $_POST passeront sur l'affichage HTML avec ce message d'erreur, mais ne partiront pas en BDD !
    } else {
        // Ici nous enverrons nos données en BDD
        // Envoie de mail etc... 
        // **************************************************************************
        // *******ATTENTION**********************************************************
        // *******ATTENTION********* en localhost mail() ne fonctionnera pas ********
        // *******ATTENTION**********************************************************
        // **************************************************************************

        // Destinataire (moi)
        $destinataire = "Jeremy.droulez@outlook.fr";
        // Sujet (titre) du mail
        $sujet = "Nouveau message de ".$name;
        // Contenu du mail
        $emailContent = "Nom : ".$name."\n";
        $emailContent .= "Email : ".$email."\n\n";
        $emailContent .= "Message : \n".$message;

        // From : 
        $headers = "From: no-replay@votre-site.com\r\n";
        // Reply-to :
        $headers .= "Reply-To: ". $email . "\r\n";
        // Gestion des accents
        $headers .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";

        // Envoi final : vérifions si les données valent true
        if(mail($destinataire, $sujet, $emailContent, $headers)){
            $success = true;
            // Vider les champs
            $name = "";
            $email = "";
            $message = "";
        } else{
            $emailNotGood = "Une erreur est survenue lors de l'envoi de l'email.";
        }
        
    }

}
   

?>

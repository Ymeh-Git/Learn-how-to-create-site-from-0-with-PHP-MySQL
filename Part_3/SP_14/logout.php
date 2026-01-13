<?php
session_start(); // On récupère la session en cours

session_unset(); // On vide les variables de session
session_destroy(); // On détruit complètement la session

// On redirige vers la page de connexion ou l'accueil
header('Location: signinIndex.php');
exit();
?>
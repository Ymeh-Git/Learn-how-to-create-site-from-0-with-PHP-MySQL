<?php
// Installation et premiers pas

// - [ X ]  Installation environnement (XAMPP/MAMP)
// - [ X ]  Structure dossier (htdocs, www)
// - [ X ]  Premier script "Hello World"
// - [ X ]  Différence client/serveur
// - [ X ]  **Exercice** : Créer une page qui affiche son nom et la date

echo "Hello World";
echo"<br>";
$firstName = "Jérémy";
$lastName = "Droulez";

$hour = date("H:i");
$date= date("d-m-Y");

echo"<br>";
echo"Afficher : <br>
* Nom avec la variable \$lastName <br>
* Prénom avec la variable \$firstName <br>
* Date avec la variable \$date <br>
* Heure avec la variable \$hour <br>";
echo"<br>";
echo "<p>";
echo ">Nom : ". $lastName."<br>";
echo ">Prénom : ". $firstName."<br>";
echo ">Ajourd'hui, nous le : ". $date."<br>";
echo ">L'heure actuelle : ". $hour."<br>";
echo "</p>";
echo"<br>";
// EXERICE :
// Pour afficher sur une page, d'une autre manière : créer une page dédiée (page.php) et utiliser require_one("page.php")
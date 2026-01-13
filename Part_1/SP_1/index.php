<?php
// Installation and first steps

// - [ X ]  Installation environment (XAMPP/MAMP)
// - [ X ]  File structure (htdocs, www)
// - [ X ]  First script "Hello World"
// - [ X ]  Difference client/server
// - [ X ]  **Exercise** : Create an html that show a name and a date

echo "Hello World";
echo"<br>";
$firstName = "Jérémy";
$lastName = "Etchebest";

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
// EXERCISE :
// Another method to display html/php : create an index.php and use require_once('homepage.php')
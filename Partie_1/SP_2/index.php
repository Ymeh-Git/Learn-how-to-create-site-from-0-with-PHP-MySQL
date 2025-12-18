<?php
// Variables et opérations

// - [ X ]  Variables, constantes
// - [ X ]  Types de données (string, integer, array...)
// - [ X ]  Opérateurs (+, -, *, /, %, .)
// - [ X ]  Concaténation
// - [ X ]  **Exercice** : Calculateur simple (prix TTC, conversions)

// Définir une variable
$variable;
// Définir une constante
const constante = "Etchebest";
// OU
define("constante1", "Jérémy");

$string = "Jérémy Etchebest";
$integer = 13;
$array = [
  "loisir" => "Jeu vidéo",
  "age" => 28,
  "couple" => true,  
];

echo $array["loisir"]."<br>";

echo $array["age"]."<br>";

if($array["couple"]){
    echo "En couple";
} else {
    echo "Célibataire";
}

echo "<br>";
$a = 13;
$b = 11;
$c = 19;
$d = 97;

$result1 = $a + $b;
echo "Résultat 1 : ".$result1;
echo "<br>";

$result2 = $c - $d;
echo "Résultat 2 : ".$result2;
echo "<br>";

$result3 = $a * $b;
echo "Résultat 3 : ".$result3;
echo "<br>";

$result4 = $d / $c;
echo "Résultat 4 : ".$result4;
echo "<br>";

$result5 = $d % $c;
echo "Résultat 5 : ".$result5;
echo "<br>";

$concatenation = $string . " aime le " . $array["loisir"];
echo $concatenation;
echo "<br>";

// EXERCICE :

$prixHT = 125; // Prix Hors Taxes

$tva = 20; // Facile à utiliser en texte OU 0.2 (20 / 100)

$prixTTC = $prixHT + ($prixHT * ($tva/100)); // Prix Toutes Taxes Comprises

echo "Prix Hors Taxes : ".$prixHT." €<br>
Ajoutons-y la TVA de ".$tva." %<br>
Notre prix toutes taxes comprises est de : ".$prixTTC." €";

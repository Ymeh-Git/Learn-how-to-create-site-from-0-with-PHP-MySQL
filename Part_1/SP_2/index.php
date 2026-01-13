<?php
// Variables et opérations

// - [ X ]  Variables, constants
// - [ X ]  Data types (string, integer, array...)
// - [ X ]  Operator (+, -, *, /, %, .)
// - [ X ]  Concatenation
// - [ X ]  **Exercise** : Simple calculator (Price including VAT, conversions)

// State your variable
$variable;
// Define a constant
const constante = "Etchebest";
// OR
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

// EXERCISE :

$prixHT = 125; // Price excluding VAT

$tva = 20; // Easier to use it this way OR 0.2 (20 / 100)

$prixTTC = $prixHT + ($prixHT * ($tva/100)); // Price including VAT

echo "Prix Hors Taxes : ".$prixHT." €<br>
Ajoutons-y la TVA de ".$tva." %<br>
Notre prix toutes taxes comprises est de : ".$prixTTC." €";

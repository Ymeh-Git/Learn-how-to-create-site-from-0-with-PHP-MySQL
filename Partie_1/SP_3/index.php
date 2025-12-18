<?php
// Structures de contrôle

// - [ X ]  Conditions (if/elseif/else)
// - [ X ]  Opérateurs de comparaison
// - [ X ]  Boucles (for, while, foreach)
// - [ X ]  **Exercice** : Générateur de tables de multiplication

$condition1 = true;
$condition2 = true;

if ($condition1){ //True donc exécuté
    // Faire quelque chose
} elseif ($condition2){ //Même si elle est true, celle-ci ne sera pas effectuée, puisque la condition1 est true avant elle.
    // Faire autre chose
} else {
    // Sinon faire ceci
}

if (!$condition1){ //"!" correspond à l'inverse de "...", donc ici l'inverse de "true" => "false", ce bloc ne sera pas exécuté
    // Faire quelque chose
} elseif ($condition2 != true){ // Pour une vue plus précise, ce bloc ne sera exécuté
    // Faire autre chose
} elseif ($condition2 == true){ // $condition2 est égale à true, ici c'est vrai
    // Faire autre chose
} elseif ($condition2 === true){ // $condition2 est strictement égale (type et valeur) à true, ici vrai aussi, mais le bloc précédent prends la priorité
    // Faire autre chose
} else {
    // Sinon faire ceci
}

$a = 1;
$b = "1";
$c = 2;
$d = 5;
$e = 7;
$f = 13;

if($a > $f){ // Si a est supérieur à f alors :
    // Faire quelque chose
} elseif ($f < $e){ // Sinon si f est inférieur à e alors :
    // Faire autre chose
} elseif ($c == $d){ // Sinon si c est égale à d alors :
    // Faire quelque chose
} elseif ($a === $b){ // Sinon si a(int) est strictement égale (valeur et type) à b(string) alors :
    // Faire quelque chose
} elseif ($a >= $d){ // Sinon si a est supérieur ou égale à d alors :
    // Faire quelque chose
} elseif ($c <= $d){ // Sinon si c est inférieur ou égale à d alors (ici c'est vrai):
    // Le bloc sera exécuté
} else { // Sinon exécuté ce bloc
    // Faire quelque chose en cas d'aucune condition vrai
}

$array = ["Philippes", "Jérémy", "Christian", "François", "Matt", "Nathalie"];
for($i = 0; $i < count($array); $i++ ){
    echo "Le N°".$i." du tableau est : ".$array[$i]."<br>"; 
};

$y = 15;
while ($y <= 20){
    echo "\$i est égale à : ".$y."<br>";
    $y ++;
};

$z = 15;
do{ //Se fait obligatoirement une fois, même si la condition est vrai dès le départ.
    echo "Z est égale à ". $z;
    $z++;
} while ($z < 20);
echo "<br>";
echo "Z après la boucle est égale à ". $z;

$users = [
    [
        "name" => "Ubris13",
        "age" => 33,
        "city" => "London"
    ], 
    [
        "name" => "Felipe44",
        "age" => 13,
        "city" => "Sydney"
    ], 
    [
        "name" => "Natacha33",
        "age" => 66,
        "city" => "New-York"
    ], 
    [
        "name" => "Xros97",
        "age" => 45,
        "city" => "Paris"
    ], 
    [
        "name" => "Rakkoon",
        "age" => 28,
        "city" => "Lille"
    ]
];

$o = 1;
echo "<ul>";
foreach($users as $user){
    echo "<h2>Utilisateur N°".$o."</h2>";
    echo "<li>Nom : ".$user["name"]."</li>";
    echo "<li>Âge : ".$user["age"]."</li>";
    echo "<li>Ville : ".$user["city"]."</li>";
    $o++;
};
echo "</ul>";

// **Exercice** : Générateur de tables de multiplication

function tableDeMultiplication($a){
    for($i=1; $i <= 20; $i++){
        $result = $a * $i;
        echo $a." x ".$i." = ".$result."<br>";
    };
};

// Exemple
$nbr = 5;
// tableDeMultiplication($nbr);

// OU 
echo "<br>";
function tableDeMultiplicationAutomatiqueDeDix(){
    echo "<table>";
        echo "<thead>";
            echo "<tr>";
            echo "<th scope=col>x</th>";
            for($b=1; $b <=10; $b++){
                echo "<th scope=\"col\">".$b."</th>";
            }
            echo "<th scope=col>x</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            for($a=1; $a <=10; $a++){
            echo "<tr>";
                echo "<th scope=\"row\">".$a."</th>";
                for($i=1; $i <= 10; $i++){
                    $result = $a * $i;
                    echo "<td>".$result."</td>"; 
                };
                echo "<th scope=\"row\">".$a."</th>";
            echo "</tr>";
            };
        echo "</tbody>";
        echo "<tfoot>";
            echo "<tr>";
                echo "<th scope=col>x</th>";
                for($b=1; $b <=10; $b++){
                echo "<th scope=col>".$b."</th>";
                }
                echo "<th scope=col>x</th>";
            echo "</tr>";
        echo "</tfoot>";
    echo "</table>";
};

echo "<br>";
function tableDeMultiplicationAutomatiqueDeVingt(){
    echo "<table>";
        echo "<thead>";
            echo "<tr>";
            echo "<th scope=col>x</th>";
            for($b=1; $b <=20; $b++){
                echo "<th scope=\"col\">".$b."</th>";
            }
            echo "<th scope=col>x</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            for($a=1; $a <=20; $a++){
            echo "<tr>";
                echo "<th scope=\"row\">".$a."</th>";
                for($i=1; $i <= 20; $i++){
                    $result = $a * $i;
                    echo "<td>".$result."</td>"; 
                };
                echo "<th scope=\"row\">".$a."</th>";
            echo "</tr>";
            };
        echo "</tbody>";
        echo "<tfoot>";
            echo "<tr>";
                echo "<th scope=col>x</th>";
                for($b=1; $b <=20; $b++){
                echo "<th scope=col>".$b."</th>";
                }
                echo "<th scope=col>x</th>";
            echo "</tr>";
        echo "</tfoot>";
    echo "</table>";
};

echo "<br>";
function tableDeMultiplicationAutomatiqueDeTrente(){
    echo "<table>";
        echo "<thead>";
            echo "<tr>";
            echo "<th scope=col>x</th>";
            for($b=1; $b <=30; $b++){
                echo "<th scope=\"col\">".$b."</th>";
            }
            echo "<th scope=col>x</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            for($a=1; $a <=30; $a++){
            echo "<tr>";
                echo "<th scope=\"row\">".$a."</th>";
                for($i=1; $i <= 30; $i++){
                    $result = $a * $i;
                    echo "<td>".$result."</td>"; 
                };
                echo "<th scope=\"row\">".$a."</th>";
            echo "</tr>";
            };
        echo "</tbody>";
        echo "<tfoot>";
            echo "<tr>";
                echo "<th scope=col>x</th>";
                for($b=1; $b <=30; $b++){
                echo "<th scope=col>".$b."</th>";
                }
                echo "<th scope=col>x</th>";
            echo "</tr>";
        echo "</tfoot>";
    echo "</table>";
};

tableDeMultiplicationAutomatiqueDeDix();
tableDeMultiplicationAutomatiqueDeVingt();
tableDeMultiplicationAutomatiqueDeTrente();
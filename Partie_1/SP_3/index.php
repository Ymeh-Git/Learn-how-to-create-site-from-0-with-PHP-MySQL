<?php
// Control structures

// - [ X ]  Conditions (if/elseif/else)
// - [ X ]  Comparaison operators
// - [ X ]  Loops (for, while, foreach)
// - [ X ]  **Exercise** : Multiplication table generator

$condition1 = true;
$condition2 = true;

if ($condition1){ //If True 
    
} elseif ($condition2){ // If last one is false and this one is True
    // Do that
} else { // If last 2 conditions are false
    // Do this
}

$condition1 = true;
$condition2 = "2";

if (!$condition1){ // !True = False OR !False = True

} elseif ($condition2 != 2){ // != means that $conditions2 must different than 2, here it's not the case
    
} elseif ($condition2 == 2){ // == means value of $condition2 = 2, here it's true
    
} elseif ($condition2 === 2){ // === means if value and type of $condition2 must be the same, 
                              // not the case, value of $condition2 = 2 yes, but not the same type, here $condition = "2" a string
} else {
    // ...
}

$a = 1;
$b = "1";
$c = 2;
$d = 5;
$e = 7;
$f = 13;

if($a > $f){ // If a is greater than f then:
    
} elseif ($f < $e){ // Otherwise f est lesser than e then :

} elseif ($c == $d){ // Otherwise, if c equals d, then:
    
} elseif ($a === $b){ // Otherwise, if a(int) is strictly equal (value and type) to b(string) then:
    
} elseif ($a >= $d){ // Otherwise, if a is greater than or equal to d, then:
    
} elseif ($c <= $d){ // Otherwise, if c is less than or equal to d, then (here it's true):

} else { // Else do this bloc
     
}


// LOOPS

$array = ["Philippes", "Jérémy", "Christian", "François", "Matt", "Nathalie"];
// Loop for([initialization] ; [condition] ; [final_expression]){}
for($i = 0; $i < count($array); $i++ ){
    echo "Le N°".$i." du tableau est : ".$array[$i]."<br>"; 
};

// Loop while(condition){}
$y = 15;
while ($y <= 20){
    echo "\$i est égale à : ".$y."<br>";
    $y ++; //Don't forget to add at least +1 to y so this loop is not infinite
};

// Loop do{}while(condition)
// This loop works at least one time even if its condition already true
$z = 15;
do{ 
    echo "Z est égale à ". $z;
    $z++;
} while ($z < 20);
echo "<br>";
echo "Z après la boucle est égale à ". $z;

// Loop foreach(){}
// associative array which means instead of index [0, 1, 2, ...] you name it "0" become "name", "1" = "age", "2" = "city", ...  
$users = [
    // Index 0 
    [
        "name" => "Ubris13",
        "age" => 33,
        "city" => "London"
    ], 
    // Index 1 
    [
        "name" => "Felipe44",
        "age" => 13,
        "city" => "Sydney"
    ], 
    // Index 2 
    [
        "name" => "Natacha33",
        "age" => 66,
        "city" => "New-York"
    ], 
    // Index 3 
    [
        "name" => "Xros97",
        "age" => 45,
        "city" => "Paris"
    ], 
    // Index 4 
    [
        "name" => "Rakkoon",
        "age" => 28,
        "city" => "Lille"
    ]
];

$o = 1; // $o here is to count our list of users, since we don't have an user number 0, we initialize it at 1 
echo "<ul>";
foreach($users as $user){
    echo "<h2>Utilisateur N°".$o."</h2>";
    echo "<li>Nom : ".$user["name"]."</li>";
    echo "<li>Âge : ".$user["age"]."</li>";
    echo "<li>Ville : ".$user["city"]."</li>";
    $o++; // Then we add +1 at the end of each loop, that way next loop(user) it will be number 2, 3, 4, 5, ...
};
echo "</ul>";

// **Exercise** : Multiplication table generator
// We create a function
function multiplicationTableOfTen($a){
    for($i=1; $i <= 20; $i++){
        $result = $a * $i;
        echo $a." x ".$i." = ".$result."<br>";
    };
};

// Example simple way
$nbr = 5;
multiplicationTableOfTen($nbr);

// OR the less simple way ^^'
// Here we create a table and we use a loop for columns and rows to add HTML with our variables as text, "echo" helps 
// Since it's a function don't forget to call it.
// If you want to see the result go to page.php

echo "<br>";
function multiplicationTableOfNbrByNbr($nbr){ //$nbr is our parameter
    echo "<table>";
        echo "<thead>";
            echo "<tr>";
            echo "<th scope=col>x</th>";
            for($b=1; $b <=$nbr; $b++){ //if $nbr = 10 then it's will do a loop of 10
                echo "<th scope=\"col\">".$b."</th>";
            }
            echo "<th scope=col>x</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            for($a=1; $a <=$nbr; $a++){ //if $nbr = 10 then it's will do a loop of 10
            echo "<tr>";
                echo "<th scope=\"row\">".$a."</th>";
                for($i=1; $i <= $nbr; $i++){ //if $nbr = 10 then it's will do a loop of 10
                    $result = $a * $i; //Here is our result of our table 1 x 10, 2 x 10, 3 x 10, ..., 10 x 10
                    echo "<td>".$result."</td>"; 
                };
                echo "<th scope=\"row\">".$a."</th>";
            echo "</tr>";
            };
        echo "</tbody>";
        echo "<tfoot>";
            echo "<tr>";
                echo "<th scope=col>x</th>";
                for($b=1; $b <=$nbr; $b++){
                echo "<th scope=col>".$b."</th>";
                }
                echo "<th scope=col>x</th>";
            echo "</tr>";
        echo "</tfoot>";
    echo "</table>";
}

$nbr = 10; // Initialize $nbr by 10
multiplicationTableOfNbrByNbr($nbr); // multiplication table of ten by ten
$nbr = 20; // We can use the same variable and change its value to 20, everything after will use $nbr = 20 until it is change again
multiplicationTableOfNbrByNbr($nbr); // multiplication table of twenty by twenty
$nbr = 30;
multiplicationTableOfNbrByNbr($nbr); // multiplication table of thirty by thirty
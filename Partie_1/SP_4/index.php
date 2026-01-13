<?php 
// Arrays and functions

// - [ X ]  Indexed and associative arrays
// - [ X ]  Built-in function count(), sort()
// - [ X ]  Creating custom functions
// - [ X ]  **Exercise** : in-memory contact manager

//Indexed array : 
$indexedArray = ["Philippes", "Jérémy", "Christian", "François", "Matt", "Nathalie"];
//   index     [     0     ,     1   ,      2     ,     3     ,   4   ,      5    ];

//asociative array : 
// associative array which means instead of index [0, 1, 2, ...] you name it "0" become "name", "1" = "age", "2" = "city", ... 
// you can rename it as you wish
$associativeArray = [
    "prenomAuPif" => "Philippes", 
    "monPrenom" => "Jérémy", 
    "tonPrenom" => "Christian", 
    "monPere" => "François", 
    "maCopine" => "Matt", 
    "maMere" => "Nathalie", // The last comma is not mandatory, but it's better to have it if you're adding something with a loop or something like that
];

/*   

index associated [  
    "indexName" => "valueAssociated" 
];

*/

// first, echo is built-in langage of PhP which help you display a string in your HTML
// to add $variables or function() with echo you have to :

// first : write your text 
// "bla bla bla " 

// secondly : add a dot . after the end of your first sentence (after the second ' " ')
// "bla bla bla " . $variables
// "bla bla bla " . function()

// thirdly : add a dot after your variable or variables IF you want to add a new sentence, ELSE no need for a last dot
// "bla bla bla " . $variables .
// "bla bla bla " . function() .

// then : open ""
// "bla bla bla " . $variables . " bla bla"
// "bla bla bla " . function() . " bla bla"


// function count()
echo "<br>";
echo "There is ". count($indexedArray)." in my array \$indexedArray";

// Other use of count() and strlen(), they have the same purpose but strlen is for string length
echo "<br>";
echo "<br>";
for($i=0; $i < count($indexedArray); $i++){
    echo "~".$indexedArray[$i]." ce prénom possède ".strlen($indexedArray[$i])." caractères de long. <br>";
}

// function sort()
echo "<br>";

// ------------------------------
echo "Tableau avant sort() : [";
for($i=0; $i < count($indexedArray); $i++){
    echo "\"".$indexedArray[$i]."\"";
    if($i+1 != count($indexedArray)){ // Don't forget to add 1 to $i since count($indexedArray) = 6, this way there won't be a comma at the end.
        echo", ";
    }
}
echo "]";

echo "<br>";

// OU

var_dump($indexedArray);
echo "<br>";
echo "<br>";
// ------------------------------
// ******************************
sort($indexedArray); // Organized in alphabetical order

echo "Tableau après sort() : [";
for($i=0; $i < count($indexedArray); $i++){
    echo "\"".$indexedArray[$i]."\"";
    if($i+1 != count($indexedArray)){
        echo", ";
    }
}
echo "]";
echo "<br>";

// OR

var_dump($indexedArray);
echo "<br>";
echo "<br>";
// ******************************

// Creating custom functions

function displayArrayStringHTML(array $array){
    echo "[";
    for($i=0; $i < count($array); $i++){
        echo "\"".$array[$i]."\"";
        if($i+1 != count($array)){
            echo", ";
        }
    }
    echo "]<br>";
};

$array1 = ["Philippes", "Jérémy", "Christian", "François", "Matt", "Nathalie", "Sylvie", "Marie-ange", "Thierry", "Sandy", "Marie-Françoise", "Alexis", "Mélanie", "Louis"];

echo "<br>";
echo "Array with displayArrayStringHTML(\$array1)";
echo "<br>";
displayArrayStringHTML($array1);
echo "<br>";
echo "Array with print_r()";
echo "<br>";
print_r($array1); // Different way to display an array
echo "<br>";
echo "<br>";
$array2 = [13, 11, 1997, 1, 9, 1967, 16, 1, 1967, 4, 1, 1990, 23, 1, 1992];

echo "<br>";
echo "Array with displayArrayStringHTML(\$array2)";
echo "<br>";
displayArrayStringHTML($array2); // This way you'll see an array like numbers are string and not int

// Let's change that :
echo "<br>";
function afficherTableauEnNombreHTML(array $array){
    echo "[";
    for($i=0; $i < count($array); $i++){
        echo $array[$i];
        if($i+1 != count($array)){
            echo", ";
        }
    }
    echo "]<br>";
};

echo "<br>";
echo "Array with afficherTableauEnNombreHTML(\$array2)";
echo "<br>";
afficherTableauEnNombreHTML($array2);
echo "<br>";
print_r($array2);
echo "<br>";
echo "<br>";

// **Exercise** : in-memory contact manager
// Here we need to create, update, search (show) and delete a contact.
// It's called CRUD (Create Read Update Delete) 

/*
Example of an associative array that will store our contacts

$contact = [
    [
        "lastName" => "Etchebest",
        "firstName" => "Jérémy",
        "phoneNumber" => "06 07 08 09 10",
    ],
    [...],
    [...],
    [...],
];

*/

$contacts = [
    [
        "lastName" => "Etchebest",
        "firstName" => "Jérémy",
        "phoneNumber" => "06 07 08 09 10",
    ],
    // [
    //     "lastName" => "Etchebest",
    //     "firstName" => "Philippe",
    //     "phoneNumber" => "06 10 09 08 07",
    // ],
    // [
    //     "lastName" => "Etchebest",
    //     "firstName" => "Matt",
    //     "phoneNumber" => "07 06 08 09 10",
    // ],
    // [
    //     "lastName" => "Etchebest",
    //     "firstName" => "Christian",
    //     "phoneNumber" => "07 07 08 09 10",
    // ],
    // [
    //     "lastName" => "Etchebest",
    //     "firstName" => "François",
    //     "phoneNumber" => "07 10 09 08 06",
    // ],
    // [
    //     "lastName" => "Etchebest",
    //     "firstName" => "Nathalie",
    //     "phoneNumber" => "07 10 09 08 07",
    // ],
    [
        "lastName" => "Etchebest",
        "firstName" => "Sylvie",
        "phoneNumber" => "06 07 10 09 08",
    ],
];

// ADD A CONTACT
function addContact(array &$array, string $lastName, string $firstName, string $phoneNumber){ // & before your array means that it'll change the original array, not a copy.
    if(empty($lastName) || empty($firstName) || empty($phoneNumber)){ // We check if our variables are
        return false; //If it's the case, everything after a return is not working anymore
    }

    $newContact = [
        "lastName" => $lastName,
        "firstName" => $firstName,
        "phoneNumber" => $phoneNumber,
    ];

    $array[] = $newContact;

    return true;
};
// -------------

// SEARCH FOR A CONTACT
function searchContact(array $array, string $index, string $content){
    return array_filter($array, function($array) use ($index, $content){
        return stripos($array[$index], $content) !== false;
    });
    return false;
};
// --------------------

// UPDATE A CONTACT
function updateContact(array &$array, int $index, array $newArray){
    if (isset($array[$index])){// Si le sous tableau de mon tableau est déclarée alors
        return $array[$index] = array_merge($array[$index], $newArray); //On remplace les anciennes données avec nos données dans le sous-tableau
    }
    return false;
};
// ----------------

// DELETE CONTACT
function deleteContact(array &$array, int $index){
    if (isset($array[$index])){ // Si le sous tableau de mon tableau est déclarée alors
        unset($array[$index]); // Bah on l'enlève
        $array = array_values($array); // Permet de réorganiser le tableau
        return true;
    }
    return false;
}
// --------------

// EXAMPLE ADDING A CONTACT 

$lName = "Karrot";
$fName = "Parrow";
$pNumber = "01 02 03 04 05";
addContact($contacts, $lName, $fName, $pNumber);

// --------------------------

echo "<pre>";
print_r($contacts);
echo "</pre>";

// EXAMPLE OF SEARCHING A CONTACT

$searchingByIndex = "firstName";
$searchingByLetter = "y";
$resultSearch = searchContact($contacts, $searchingByIndex, $searchingByLetter);

echo "Tableau de recherche par ".$searchingByLetter." in " . $searchingByIndex;
echo "<pre>";
print_r($resultSearch);
echo "</pre>";

// ------------------------------- 

// EXAMPLE OF UPDATING A CONTACT

$indexArray = 1; // Which contact we want to update
$newArrayUpdate =[
        "lastName" => "Poliove",
        "firstName" => "Arny",
        "phoneNumber" => "05 02 03 04 06",
];

updateContact($contacts, $indexArray, $newArrayUpdate);

echo "<pre>";
print_r($contacts);
echo "</pre>";

// ---------------------------------

// EXAMPLE OF DELETING A CONTACT

$indexArray = 1;

deleteContact($contacts, $indexArray);
echo "<pre>";
print_r($contacts);
echo "</pre>";

// ---------------------------------
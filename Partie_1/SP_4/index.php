<?php 
// Tableaux et fonctions

// - [ X ]  Tableaux indexés et associatifs
// - [ X ]  Fonctions intégrées (count(), sort())
// - [ X ]  Création de fonctions personnalisées
// - [ X ]  **Exercice** : Gestionnaire de contacts en mémoire

//Tableau indéxé : 
$arrayIndexe = ["Philippes", "Jérémy", "Christian", "François", "Matt", "Nathalie"];
//   index     [     0     ,     1   ,      2     ,     3     ,   4   ,      5    ];

//Tableau associatif : 
$arrayAssociatif = [
    "prenomAuPif" => "Philippes", 
    "monPrenom" => "Jérémy", 
    "tonPrenom" => "Christian", 
    "monPere" => "François", 
    "maCopine" => "Matt", 
    "maMere" => "Nathalie", // Dernière virgule pas obligatoire, mais en cas d'ajout vaut mieux l'avoir.
];

/*   

index associé [  
    "nomIndex" => "valeurAssocie" 
];

*/

// Fonction count()
echo "<br>";
echo "Il y a ". count($arrayIndexe)." dans mon tableau \$arrayIndexe";

// Autre utilisation de count() et strlen() son équivalent pour les string
echo "<br>";
echo "<br>";
for($i=0; $i < count($arrayIndexe); $i++){
    echo "~".$arrayIndexe[$i]." ce prénom possède ".strlen($arrayIndexe[$i])." caractères de long. <br>";
}

// Fonction sort()
echo "<br>";

// ------------------------------
echo "Tableau avant sort() : [";
for($i=0; $i < count($arrayIndexe); $i++){
    echo "\"".$arrayIndexe[$i]."\"";
    if($i+1 != count($arrayIndexe)){ // Ne pas oublier le "+ 1" car count($arrayIndexe) = 6 alors que $i ira toujours jusqu'à 5, ainsi il ne mettre pas de virgule à la fin.
        echo", ";
    }
}
echo "]";

echo "<br>";

// OU

var_dump($arrayIndexe);
echo "<br>";
echo "<br>";
// ------------------------------
// ******************************
sort($arrayIndexe); // Organisé par ordre alphabétique

echo "Tableau après sort() : [";
for($i=0; $i < count($arrayIndexe); $i++){
    echo "\"".$arrayIndexe[$i]."\"";
    if($i+1 != count($arrayIndexe)){ // Ne pas oublier le "+ 1" car count($arrayIndexe) = 6 alors que $i ira toujours jusqu'à 5, ainsi il ne mettre pas de virgule à la fin.
        echo", ";
    }
}
echo "]";
echo "<br>";

// OU

var_dump($arrayIndexe);
echo "<br>";
echo "<br>";
// ******************************

// Création de fonctions personnalisées

function afficherTableauEnChaineHTML(array $array){
    echo "[";
    for($i=0; $i < count($array); $i++){
        echo "\"".$array[$i]."\"";
        if($i+1 != count($array)){ // Ne pas oublier le "+ 1" car count($arrayIndexe) = 6 alors que $i ira toujours jusqu'à 5, ainsi il ne mettre pas de virgule à la fin.
            echo", ";
        }
    }
    echo "]<br>";
};

$array1 = ["Philippes", "Jérémy", "Christian", "François", "Matt", "Nathalie", "Sylvie", "Marie-ange", "Thierry", "Sandy", "Marie-Françoise", "Alexis", "Mélanie", "Louis"];
afficherTableauEnChaineHTML($array1);
echo "<br>";
print_r($array1); // Afficher un tableau différemment
echo "<br>";
echo "<br>";
$array2 = [13, 11, 1997, 1, 9, 1967, 16, 1, 1967, 4, 1, 1990, 23, 1, 1992];

afficherTableauEnChaineHTML($array2); // Cependant cela donne un affichage comme si c'était des chaînes de caractères (strings) alors que ce n'est pas le cas

// Changeons ça, reprenons la fonction d'avant : 
echo "<br>";
function afficherTableauEnNombreHTML(array $array){
    echo "[";
    for($i=0; $i < count($array); $i++){
        echo $array[$i];
        if($i+1 != count($array)){ // Ne pas oublier le "+ 1" car count($arrayIndexe) = 6 alors que $i ira toujours jusqu'à 5, ainsi il ne mettre pas de virgule à la fin.
            echo", ";
        }
    }
    echo "]<br>";
};

afficherTableauEnNombreHTML($array2);
echo "<br>";
print_r($array2);
echo "<br>";
echo "<br>";

// **Exercice** : Gestionnaire de contacts en mémoire
// Ici si je suis l'intitulé, l'objectif est de pouvoir créer, modifier, rechercher et supprimer un contact.

/*
Exemple de tableau qui permet de stocker nos contacts : 

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
// Tableau associatif de contact :

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
function addContact(array &$array, string $lastName, string $firstName, string $phoneNumber){ // & avant la variable signifie que la fonction modifiera directement ton tableau original et non une copie.
    if(empty($lastName) || empty($firstName) || empty($phoneNumber)){
        return true;
    }

    $newContact = [
        "lastName" => $lastName,
        "firstName" => $firstName,
        "phoneNumber" => $phoneNumber,
    ];

    $array[] = $newContact;

    return false;
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

// DELETE CONTACT
function deleteContact(array &$array, int $index){
    if (isset($array[$index])){ // Si le sous tableau de mon tableau est déclarée alors
        unset($array[$index]); // Bah on l'enlève
        $array = array_values($array); // Permet de réorganiser le tableau
        return true;
    }
    return false;
}

// EXEMPLE D'AJOUT DE CONTACT

// $lName = "Karrot";
// $fName = "Parrow";
// $pNumber = "01 02 03 04 05";
// addContact($contacts, $lName, $fName, $pNumber);

// --------------------------

echo "<pre>";
print_r($contacts);
echo "</pre>";

// EXEMPLE DE RECHERCHE DE CONTACT

// $pNumber = "firstName";
// $searchingByIE = "ie";
// $resultSearchIE = searchContact($contacts, $pNumber, $searchingByIE);

// echo "Tableau de recherche par \"ie\"";
// echo "<pre>";
// print_r($resultSearchIE);
// echo "</pre>";

// ------------------------------- 

// EXEMPLE DE MISE A JOUR DE CONTACT

// $indexArray = 1;
// $newArrayUpdate =[
//         "lastName" => "Poliove",
//         "firstName" => "Arny",
//         "phoneNumber" => "05 02 03 04 06",
// ];

// updateContact($contacts, $indexArray, $newArrayUpdate);

// echo "<pre>";
// print_r($contacts);
// echo "</pre>";

// ---------------------------------

// EXEMPLE DE SUPPRESSION DE CONTACT

// $indexArray = 1;

// deleteContact($contacts, $indexArray);
// echo "<pre>";
// print_r($contacts);
// echo "</pre>";

// ---------------------------------
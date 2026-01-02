<?php 
// Jointures de base

// - [ X ]  INNER JOIN, LEFT JOIN
// - [ X ]  Relations 1-n, n-n
// - [ X ]  **Mini Projet** : Site de recettes (recettes + catégories)

// INNER JOIN, LEFT JOIN

// INNER JOIN permet de récupérer les données jointes entre deux tables (ex avec id), si id 1, 2, 3, 4 existant dans table 1, mais que table 2 n'a que (table2_id)1, 3.
// Alors "SELECT * FROM table 1 INNER JOIN table 2 ON table 1.id = table2_id" n'affichera que les id 1 et 3 avec leurs informations existants dans la table 1 et 2.

// LEFT JOIN contrairement à INNER JOIN prendra l'entièreté des champs d'UNE table sur deux pour afficher une nouvelle table avec des possibilitées d'entrée soyant NULL.

// Relations :

// One To One (1-1)
// UN "objet1" ne peut avoir qu'UN "objet2" et inversement

// One To Many (1-n) / Many To One (n-1)
// Tout dépend où nous nous situons exemple : Utilisateur--One To Many--Commentaires
// C'est-à-dire un UN Utilisateur peut avoir plusieurs Commentaires, à contrario UN Commentaire ne peuvent avoir qu'UN Utilisateur

// Many To Many (n-n)
// Exemple avec UN ou DES Utilisateurs peut posséder UNE ou DES Voitures 
// ET UNE ou DES Voitures peuvent être possédée par UN ou DES Utilisateurs

// **Mini Projet** : Site de recettes (recettes + catégories)
// Comprenons le projet, ici nous avons en BDD des recettes de plats tels que des pâtes, des lasagnes etc... et des recettes de patisseries
// Patisseries et cuisine seront donc deux catégories (RÔLE) différentes

// Les relations seront les suivantes : 
// Recettes One To Many Catégories

// La recette sera composée de :
// id (int, auto-increment, primary key)
// categorie_id (relation à l'ID des catégories)
// nom (VARCHAR(255))
// ingrédients (VARCHAR(255))
// processus (TEXT)

// La catégorie sera composée de : 
// id (int, auto-increment, primary key)
// type (VARCHAR(120)) ==> Patisserie, Cuisine etc...

// Ne pas oublier de créer les catégorie au préalable OU de donner la possibiliter d'en créer de nouvelles via un formulaire.
// Ici nous devons ajouter, supprimer et pourquoi pas éditer nos recettes.
$server = "localhost";
$username = "root";
$pwd = "";
$dbName = "site_recettes"; 

try {

    $database = new PDO("mysql:host=$server;dbname=$dbName;charset=utf8mb4", $username, $pwd);
    $sql = "SELECT * FROM recettes";
    $request = $database->query($sql);

    $results = $request->fetchAll(PDO::FETCH_ASSOC);

    echo "<div class=\"parent\">";
    $i = 0;
    foreach($results as $recette){
        $i++;
        echo "<div class=\"enfant\">";
            echo "<form action=\"index.php\"method=\"POST\">";
                echo "<h2 style=\"color: black; text-align: center;margin-top: 10px;\">Recette n°".$i."</h2>";
                echo "<label>Nom</label>";
                echo "<input type =\"text\" value=\"".$recette['nom']."\" disabled>";
                echo "<label>Type de recette</label>";
                switch ($recette["categorie_id"]){
                    case 1:
                        echo "<input type =\"text\" value=\"Pâtisserie\" disabled>";
                        break;
                    case 2:
                        echo "<input type =\"text\" value=\"Cuisine\" disabled>";
                        break;
                    case 3: 
                        echo "<input type =\"text\" value=\"Dessert\" disabled>";
                        break;
                    case 4: 
                        echo "<input type =\"text\" value=\"Viennoiserie\" disabled>";
                        break;
                }
                echo "<label>Ingrédient(s)</label>";
                echo "<input type =\"text\" value=\"".$recette['ingrédient']."\" disabled>";
                echo "<label>Étape(s)</label>";
                echo "<div class=\"textarea\"style=\"min-height:100px;\">".$recette['processus']."</div>";
                echo"<div class=\"btn-field\">";
                    echo "<a href=\"editeRecipe.php?id=".$recette['id']."&nom=".$recette['nom']."&ingrédient=".$recette['ingrédient']."&processus=".$recette['processus']."&categorie_id=".$recette['categorie_id']."\" class=\"btn btn-info\">Éditer</a>";
                    echo "<a href=\"deleteRecipe.php?id=".$recette['id']."\" class=\"btn btn-red\">Supprimer</a>";
                echo"</div>";
            echo "</form>";
        echo "</div>";
        }
    echo "</div>";

} catch (PDOException $e){

    echo "Une erreur est survenue ".$e->getMessage();

}
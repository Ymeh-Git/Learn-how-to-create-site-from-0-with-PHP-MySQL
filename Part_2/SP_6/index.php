<?php 
// Introduction à MySQL

// - [ X ]  Concepts base de données
// - [ X ]  Tables, colonnes, lignes
// - [ X ]  Types de données MySQL
// - [ X ]  **Exercice** : Créer une base "bibliothèque" avec phpMyAdmin

// BDD = Permet de stocker et retrouver des données 

// SGBDR = Un système de gestion de base de données relationnelle, regroupement d'informations sur laquelle nous pouvons lui communiquer des demandes (requête SQL) 
// pour récupérer des informations. La BDD est sous forme de table, avec des champs, des entrées, 
// des clefs primaires/étrangères qui permettent de rendre unique les informations et lié les tables entre-elles (respectivement)

// Différent concepts important en requête SQL (==> = exemple): 
    // CREATE (créer) ==> CREATE DATABASE bibliothèque
    // SELECT (sélectionne/"récupère")
    // ALTER (modifier)
    // INSERT INTO (inséré dans (table))
    // WHERE (où la condition est ...) ==> SELECT * FROM users WHERE firstname="Chabal"
    // VALUES (valeur) ==> VALUES ('firstname','lastname', age)
    // DROP (suppression **ATTENTION à l'usage de cette requête, cela supprimme l'intégralité des données à l'intérieur de la table**)
    // * (signifie tout (id, name, firstname, lastname, ...))
    // FROM ("De") ==> SELECT * FROM users (users = table des utilisateurs)
    // etc...

// Différents types de données MySQL (==> = exemple): 
    // VARCHAR(255) / TEXT (String de 255 caractères max / Pas de restriction de caractères) => email = "exemple@gmail.com"
    // INT (integer) ==> age = 28
    // BOOLEAN (vrai/faux) ==> isAvailable = true
    // DATETIME (date et heure) ==> createdAt = 21/12/2025 12:28:00 (createdAt->format('d-m-Y H:i:s');)
    // JSON (donnée en json)
    // etc...
// Il y a plein de sous-type à ces types ==> INT (BIGINT, MEDIUMINT, SMALLINT, TINYINT etc...)
// CREATE TABLE livres(
//     id INTEGER PRIMARY KEY AUTO_INCREMENT,
//     name TEXT NOT NULL,
//     isAvailable BOOLEAN NOT NULL DEFAULT 0,
//     createdAt DATETIME DEFAULT CURRENT_TIMESTAMP
// );

// Pour créer une BDD, rien de plus simple avec PhpMyAdmin, tout est visuel : 
// Étape 1 : Aller à cette adresse "http://localhost/phpmyadmin/"
// Étape 1.5 : Si tu n'es pas connecté via un username (root), le faire en choisissant un username déjà existant
// Étape 2 : Cliquer sur "Nouvelle base de données" (en haut à gauche)
// Étape 3 : Choisir son nom, ici "bibliothèque"
// Étape 4 : Appuyer sur "Créer"
// Et voilà, une base de donnée a été créée

// Ensuite :
// Pour manipuler une base de donnée il nous faut pouvoir s'y connecter
// Pour ce faire, j'utilise XAMPP => MySQL => PhPMyAdmin en local

$server = "localhost"; 
$user = "root"; // À changer si besoin, ici nous travaillons sur l'utilisateur basique
$password = ""; // Par conséquent pas de MDP pour y accéder, en entreprise pour la sécurité un mot de passe sera précisé
$dbName = "bibliothèque"; // Le nom de notre BDD à accéder

// Pour récupérer les erreurs la connexion se fera dans un bloc try/catch 
try {
// Dans le bloc try on va bien sûr essayer de se connecter à la BDD
$database = new PDO("mysql:host=$server;dbname=$dbName;charset=utf-8", $user, $password);

// Notre demande en langage SQL (considérons la BDD déjà remplie avec id, name, author)
$sql = "SELECT * FROM bibliothèque";

// Notre requête à partir de l'entrée en BDD et de notre requête (query = requête)
$request = $database->query($sql);

// Récupérons les résultats de notre requête et mettons les dans un tableau associatif (PDO::FETCH_ASSOC)
$results = $request->fetchAll(PDO::FETCH_ASSOC);

// Il faut maintenant l'afficher :
// Ouverture de la liste non ordonnée (ici c'est mon choix)
echo "<ul>";
// Il faut boucler sur le résultats et que chaque entrées soient considérées comme $book
// Bien entendu nous devons utiliser les noms précis de chaque champs dans notre BDD
foreach($results as $book){
    echo "<li> ~ ID : ".$book['id'];
    echo "<ul>";
    echo "<li> ~~ Nom : ".$book['name']."</li>";
    echo "<li> ~~ Auteur : ".$book['author']."</li>";
    echo "</ul>";
    echo "</li>";
}
// Ne pas oublier de fermer la balise <ul>
echo "</ul>";

} catch(PDOException $e){
    echo "Une erreur est survenue : ".$e->getMessage();
}
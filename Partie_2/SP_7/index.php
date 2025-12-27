<?php 
// Requêtes SQL essentielles

// - [ X ]  **Exercice** : Peupler et interroger la base bibliothèque

// CREATE,
// TABLE, 
// INSERT, 
// SELECT, 
// WHERE,
// UPDATE, 
// DELETE, 
// LIMIT

// Utilisons la requête du cours précédent : 

// Avant toute chose, je vais créer une nouvelle table avec trois champs (id (primary key + auto_increment), name, authors)  :
// CREATE TABLE books (
//     id INT AUTO_INCREMENT PRIMARY KEY, 
//     name VARCHAR(255),
//     authors VARCHAR(255)
// )

// Remplissons la : 
// INSERT INTO `books` (`id`, `name`, `authors`) VALUES (NULL, 'Harry Potter', 'J.K. Rowling'), 
// (NULL, 'Inconnu à cette adresse', 'Kressmann Taylor'), 
// (NULL, 'Les Misérables', 'Victor Hugo'), 
// (NULL, 'Le Père Goriot', 'Honoré de balzac');

// Pour manipuler/intérroger une base de donnée il nous faut pouvoir s'y connecter
// Pour ce faire, j'utilise XAMPP => MySQL => PhPMyAdmin en local

$server = "localhost"; 
$user = "root"; // À changer si besoin, ici nous travaillons sur l'utilisateur basique
$password = ""; // Par conséquent pas de MDP pour y accéder, en entreprise pour la sécurité un mot de passe sera précisé
$dbName = "bibliothèque"; // Le nom de notre BDD à accéder

// Pour récupérer les erreurs la connexion se fera dans un bloc try/catch 
try {
// Dans le bloc try on va bien sûr essayer de se connecter à la BDD
$database = new PDO("mysql:host=$server;dbname=$dbName;charset=utf8mb4", $user, $password);

// Notre demande en langage SQL vers la table "books" (considérons la table déjà remplie avec id, name, authors)
$sql = "SELECT * FROM books";

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
    echo "<li> ~~ Auteur : ".$book['authors']."</li>";
    echo "</ul>";
    echo "</li>";
    echo "<br><br>";
}
// Ne pas oublier de fermer la balise <ul>
echo "</ul>";
} catch(PDOException $e){
    // En cas d'erreur attrappée, l'afficher : 
    echo "Une erreur est survenue : ".$e->getMessage();
}
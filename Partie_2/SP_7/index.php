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
// $sql = "SELECT id FROM books";
// $sql = "SELECT name FROM books";
// $sql = "SELECT authors FROM books";
// $sql = "SELECT * FROM books WHERE id = 1";
// $sql = "SELECT * FROM books WHERE name = 'Inconnu à cette adresse'";
// $sql = "SELECT * FROM books WHERE authors = 'Victor Hugo'";

// Notre requête à partir de l'entrée en BDD et de notre requête (query = requête)
$request = $database->query($sql);

// Récupérons les résultats de notre requête et mettons les dans un tableau associatif (PDO::FETCH_ASSOC)
$results = $request->fetchAll(PDO::FETCH_ASSOC);

// Il faut maintenant l'afficher : (SP_8)
} catch(PDOException $e){
    // En cas d'erreur attrappée, l'afficher : 
    echo "Une erreur est survenue : ".$e->getMessage();
}
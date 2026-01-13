<!-- 

### **Sous-Partie 14 : Sessions et authentification**

- [ X ]  Système de login/logout
- [ X ]  Protection des pages
- [ X ]  Rôles utilisateurs (admin/user)
- [ X ]  **Exercice** : Espace membre sécurisé 

Créer une BDD : session_auth

Pour le login/logout :
Il me faut déjà un formulaire d'inscription (signup) pour rentrer en BDD l'email avec vérification du format, plus hashage du mot de passe.

Ensuite un formulaire de connexion (login) récupérant les données en BDD et recherchant si le profil existe avec le mail et le mdp et vérifiant l'exactitude de ceux-ci.
Le point que je n'ai pas encore bien ancré, c'est la création d'une session

Créer une table : 
users : 
    - id (INT primary, auto-increment)
    - name/pseudo (VARCHAR(120))
    - email (VARCHAR(255))
    - password
    - role (VARCHAR(120) par défaut "tel que défini" = "USER")
Ce qui nous permet des créer facilement des users avec uniquement deux données (pseudo et email)

Admin :
C'est juste un USER où j'ai changé le rôle en ADMIN, car en réalité on ne donne pas la possibilité de créer un compte ADMIN

Petit bémol, je n'ai pas créé de compte "ADMIN", je me demande comment ça se passe en cas de mise en ligne du site, nous n'aurons plus accès à la BDD.

Il faudrait initialiser au moins UN compte admin:

function lookingForAdmin(){
    try{
        $emailAdmin = "admin@site.fr";

        $pdo = getPDO();

        $sql = "SELECT email FROM users WHERE email = :email";
        $statement = $pdo->prepare($sql);

        $statement->bindParam(":email", $emailAdmin, PDO::PARAM_STR);
        $statement->execute();

        $userAdmin = $statement->fetch(PDO::FETCH_ASSOC);
        return $userAdmin;
    } catch(PDOException $e){
    echo "Erreur : ".$e->getMessage();
    }
}

function createAccountAdmin(){
    try{
        $pseudoAdmin = "Admin_User_1";
        $emailAdmin = "admin@site.fr";
        $passAdmin = "Test123";
        $roleAdmin = "ADMIN";

        // Puisqu'à la connexion il y a un traitement sur le hachage, nous devons également hacher le mdp
        $passAdmin = password_hash($passAdmin, PASSWORD_DEFAULT);

        $pdo = getPDO();

        $sql = "INSERT INTO users(pseudo, email, password, role)
                VALUES(:pseudo, :email, :password, :role)";
        $statement = $pdo->prepare($sql);

        $statement->bindParam(":pseudo", $pseudoAdmin, PDO::PARAM_STR);
        $statement->bindParam(":email", $emailAdmin, PDO::PARAM_STR);
        $statement->bindParam(":password", $passAdmin, PDO::PARAM_STR);
        $statement->bindParam(":role", $roleAdmin, PDO::PARAM_STR);

        $statement->execute();
    } catch(PDOException $e){
    echo "Erreur : ".$e->getMessage();
    }
}
$userAdmin = lookingForAdmin();
if(!$userAdmin){
createAccountAdmin();
}

si il n'existe pas alors createAccountAdmin(); ET qu'il a la possibilité de rendre ADMIN d'autre comptes en créant un formulaire d'édition

Pour le moment, deux comptes avec le même mail peuvent être créés...
-->
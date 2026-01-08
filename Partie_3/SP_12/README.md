<!-- 

CREATE et READ

- [ X ]  Formulaire d'ajout + traitement
- [ X ]  Affichage liste avec pagination
- [ X ]  **Exercice** : Ajout d'articles à un blog 

Pour faire l'intégralitée de la sous-partie, je vais me baser sur l'exercice.
Soit un site de blog avec je présume des commentaires, des comptes utilisateurs.

Dans la BDD ce sera ce format là : 
Users : 
    - id (INT primary, auto-increment)
    - name/pseudo (VARCHAR(120))
    - email (VARCHAR(255))
    - age (TINYINT)
    - role (VARCHAR(120) par défaut "USER")
    - posts (post_id) -> One To Many
    - comments (comment_id) -> One To Many

Posts :
    - id (INT primary, auto-increment)
    - title (VARCHAR(120))
    - content (TEXT)
    - createdAt (Datetime)
    - editedAt (Datetime)
    - postedBy (user_id) ======> OPTIONNEL
    - comments (comment_id) -> One to Many 

Comments : 
    - id (INT primary, auto-increment)
    - content (TEXT)
    - createdAt (Datetime)
    - editedAt (Datetime)
    - commentedBy (user_id) ======> OPTIONNEL
    - posts (post_id) -> Many To One

***************
On aura besoin donc de créer un User, pouvoir s'identifier, garder sa session active (token), et pouvoir se déconnecter.
Chaque User pourra créer un post et pourra également le commenter
***************
***************
** ATTENTION ** 
Cette partie là est optionnel, nous pouvons passer directement à l'ajout d'article et les commentaires.
***************

Créons la base de donnée en localhost : "my_blog"
CREATE DATABASE my_blog

Il faut créer deux tables : Posts et Comments avec les champs comme indiqués

CONCERNANT LA PAGINATION : 

-->
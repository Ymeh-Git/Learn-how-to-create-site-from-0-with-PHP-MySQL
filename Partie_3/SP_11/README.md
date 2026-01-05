<!-- 

Architecture MVC simplifiée

- [ X ]  Modèle-Vue-Contrôleur expliqué
- [ X ]  Séparation logique/présentation
- [ X ]  **Exercice** : Réorganiser un projet en MVC

Modèle contient la logique ==> src
Vue c'est l'affichage ==> Templates
Contrôleur c'est le lien avec l'utilisateur

L'utilisateur fait une requête, le contrôleur envoie cette requête à la logique, la logique renvoie des données, ces données sont envoyé par le contrôleur à la vue et la vue envoie au contrôleur une présentation et le contrôleur envoie une réponse à l'utilisateur.

PROJET
--asset (style)
----styles.css
--config (connexion)
----db.php
--src (logique)
----model.php
--templates (vue)
----homepage.php
index.php


La base de donnée est similaire à la SP_10
-->
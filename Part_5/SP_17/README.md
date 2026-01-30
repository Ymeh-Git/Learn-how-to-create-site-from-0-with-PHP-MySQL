### **Sous-Partie 17 : Panier d'achat**

- [ X ]  Sessions pour panier
- [ X ]  Ajout/suppression produits
- [ X ]  Calcul total
- [ X ]  **Exercice** : Boutique en ligne simple

**First** create your html how you would see it with datas from DB, **then** add your php

---

**We will need :**
```
~ SP_17
    |__images/
        |__basket/
            |__less.png
            |__more.png
            |__transhcan.png
        |__[...]
        |__[...]
        |__[...]
    |__includes/
        |__includes/
            |__db.php
            |__functions.php
    |__add_to_basket.php
    |__index.php
    |__panier.php
    |__style.css
```
--- 
- Database (site_panier) :
  - table (products) :
    - id
    - img (varchar - filename)
    - price (int)
    - name (varchar)

--- 

*You must add yourselft datas into products*
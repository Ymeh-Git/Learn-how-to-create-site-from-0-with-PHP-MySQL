<!-- 

### **Part 4: PROJECT 1 - DYNAMIC SHOWCASE WEBSITE**

**Objective:** Create a showcase website for a small business

### **Project Specifications:**

- [ ] 1 - Homepage with slider
- [ ] 2 - "About" page
- [ ] 3 - "Services/Products" page (database)
- [ ] 4 - Contact form with email submission
- [ ] 5 - Administrator back office (login)
- [ ] 6 - Content management without recoding

### **Technical Structure:**

```
/vitrine
  /admin
    login.php
    dashboard.php
    gestion_services.php
  /assets
    css/style.css
    js/script.js
    uploads/logo.jpg
  /includes
    database.php
    functions.php
  index.php
  about.php
  services.php
  contact.php

``` 
This website will need 

1- A slider, a way to show differents products / imgs within the same page

2- About page, classic text page. Maybe add a link to a contact form (step 4)

3- We will need three tables :   
  - users (admin)
    - id
    - firstName VARCHAR NULL
    - lastName VARCHAR NULL
    - email VARCHAR
    - password VARCHAR
    - role VARCHAR (DEFAULT = "ADMIN")

  - Services :
    - id
    - name VARCHAR(255)
    - price INT (SMALLINT) // Depends on what you are selling, here range -32 768 to 32 768

  - Products :
    - id
    - name VARCHAR(255)
    - price INT (SMALLINT)
    - img VARCHAR(255) // File path /assets/uploads/[...].ext
    - reference // Maybe a code that goes by five letters and two numbers

4- A contact form, we will use Part 1 - SP_5 with function mail();

5- An exclusive session for admins (something like that if(!($_SESSION['user']['mail'] == 'admin@site.fr')){header('location: error401.php')} )
We need to make sure that every mail is unique, we can use it as a primary key.

6- This means an ADMIN page where you can update datas

-->
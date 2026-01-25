# <p align=center>**Part 4: PROJECT 1 - DYNAMIC SHOWCASE WEBSITE**</p>

**Objective:** Create a showcase website for a small business

---

### **Project Specifications:**

- [ X ] 1 - Homepage with slider
- [ O ] 2 - "About" page
- [ O ] 3 - "Services/Products" page (database)
- [ X ] 4 - Contact form with email submission
- [ X ] 5 - Administrator back office (login)
- [ X ] 6 - Content management without recoding

### **Technical Structure:**

```

~vitrine/
  |__admin/
      |__login.php
      |__dashboard.php
      |__gestion_services.php
  |__assets/
      |__css/
          |__style.css
      |__js/
          |__script.js
  |__uploads/
      |__logo.jpg
  |__includes/
      |__database.php
      |__functions.php
  |__index.php
  |__about.php
  |__services.php
  |__contact.php

``` 

### This website will need :

- 1- A **slider**, a way to show differents products / imgs within the same page

- 2- **About page**, classic text page. Maybe add a link to a contact form (step 4)

- 3- We will need three to four tables :   
  - **users (admin)**
    - id,
    - firstName VARCHAR NULL,
    - lastName VARCHAR NULL,
    - email VARCHAR,
    - password VARCHAR,
    - role VARCHAR (DEFAULT = "ADMIN")

  - **Services** 
    - id,
    - name VARCHAR(255),
    - price INT (SMALLINT) // Depends on what you are selling, here range -32 768 to 32 768
    - description TEXT

  - **Products**
    - id,
    - name VARCHAR(255),
    - price INT (SMALLINT),
    - img VARCHAR(255), // File path /assets/uploads/[...].ext
    - altImage, // Sentence to describe image
    - description, // Product description
    - reference // Maybe a code that goes by height letters
  
  - **contact** (contact form)
    - id,
    - name,
    - email,
    - message

- 4- A **contact form**, we will use Part 1 - SP_5 with function mail();

- 5- An **exclusive session for admins** 

- 6- This means an **ADMIN pages** where you can use **CRUD** for every datas (Services/Products)

<font color="red">⚠️ Front-end does not matter, **make it work first**, make it pretty after</font>

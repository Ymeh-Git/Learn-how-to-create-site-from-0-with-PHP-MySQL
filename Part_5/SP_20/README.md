### **Subsection 20 : Sécurité avancée**

- [ X ]  Hash password (password_hash())
- [ ]  CSRF protection
- [ X ]  full validation
- [ ]  **Little project** : Upgrade security blog

#### **What do we have at first commit ?**

- Fonctionnal router
- A good tree structure for ou folders/files
```
~SP_20/
    |__assets/
    |    |__css/
    |    |    |__style.css
    |    |__js/
    |         |__script.js
    |__core/
    |    |__class/
    |    |    |__account.php
    |    |    |__email.php
    |    |__initialize.php
    |__includes/
    |    |__database.php
    |__PHPMailer-master/
    |    |__[...]
    |__router/
    |    |__route.php
    |__template/
    |    |__auth/
    |    |    |__activate-account.php
    |    |    |__login.php
    |    |    |__logout.php
    |    |    |__signup.php
    |    |__error/
    |    |    |__401.php
    |    |    |__404.php
    |    |__account.php
    |    |__home.php
    |__index.php
    |__README.md (🚩you are here🚩)
``` 

- Two classes :
    - Account (public : id, email(unique), password, created_at, role, status)
    - EmailSender (public : mail_user, content(link))

- Full CRUD for Account + few functions getter/setters and check_email
- Homepage that shows a welcome sentence only once (READ)
- Hash password with php, verif password with only JS for each Forms
- Sign Up form and script (CREATE and Check_mail if account already exist)
- Send email thanks to PHPMailer to activate account (Big problem, link = http://localhost[...] and it's a generic one and only on local, we could have in DB a random combinaison in our URL and we get it in "activate-account.php"'s script and check if it's the same as in URL)
- Status : OFF / VALIDATE
- Default role : USER
- Log In form and script (check_email, get_status, password_verify), initialize a $_SESSION
- Log Out script
- Account page (UPDATE and DELETE)
- Security for each page (define 'ACCESS GRANTED') BUT it's laborious

**Next time I'll try to do more commits, this way I can save my work and try to debug things with a more efficient way**

#### **What we want on second commit ?** 

- CSRF Protection

- Maybe ADMIN, should be easy, it's just an USER that has role and status defined by default to ADMIN and VALIDATE

#### **For last commit ?**

- New tables (classes) :
    - posts (Post.php)
    - comments (Comment.php)

- To USER to create POST / COMMENT using $account['email']/['created_at']
- Only people who create post or comment can manage it (UPDATE or DELETE)

- Maybe send an email to creator of post/comment for each response to their post/comment with a generic mail, using Post['title'] / Comment['comment_author']
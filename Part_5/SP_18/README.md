### **Subsection 18 : Sending emails**

- [ X ]  PHP mail() or PHPMailer
- [ X ]  Templates HTML for emails <a href="https://www.benchmarkemail.com/fr/email-templates/">Benchmark</a>
- [ X ]  Attachments
- [ X ]  **Exercise** : Basic newsletter system

```

SP_18
    |__includes
        |__db.php
        |__functions.php
    |__index.php
    |__style.css

```

using <a href="https://github.com/PHPMailer/PHPMailer">PHPMailer</a>
**Download .zip**, extract it then move to your project file.
On GitHub page **copy "A Simple Example"** and paste it in your sendMailFunction.php file. 
Right above it **copy three lines of "require"** and paste it in your sendMailFunction.php file :

```

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

```

Change 'path/to/PHPMailer' by your .zip name where it is in your project folder
example : *'PHPMailer-master/src/Exception.php'*
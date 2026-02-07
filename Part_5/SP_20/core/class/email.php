<?php 
namespace Core\Class;

// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


/*

class EmailSender {
    $this->active_account_email()         :         Send an email to change Account->status
                                                    return true or false
}

*/

$php_mailer = new PHPMailer(true);
 
class EmailSender {
    private $mail;

    // My datas
    private $my_name = 'Site_security';                                        //Change for your name
    private $my_mail = 'no1r3ply1test.site@gmail.com';                         //Change for your mail
    private $my_pwd  = 'bjisfpfdtucfqrcy';                                     // Go to gmail account, passwords of application then create one, copy and paste it here

    // Data of user
    public $mail_user;
    public $content;

    public function __construct($php_mailer){
        $this->mail = $php_mailer;
    }

    public function active_account_email(){
        //Server settings
        $this->mail->SMTPDebug  = 0;                                       //Enable verbose debug output
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        // MAIL AND PASSWORD WILL BE CHANGE FOR GITHUB
        $this->mail->Username   = $this->my_mail;                         //SMTP username
        // Go to gmail account, passwords of application then create one, copy and paste it here
        $this->mail->Password   = $this->my_pwd;                          //SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $this->mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        // $mail->setFrom (the one who send it (me),the one who complete contact Form)
        $this->mail->setFrom($this->my_mail, $this->my_name);
        // Sent to
        // $mail->addAddress($mail_user, 'Name of the one who complete contact form'); 
        $this->mail->addAddress($this->mail_user, $this->mail_user);
        // Add a recipient
        // ...
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // if($filename !== null){
        //     $mail->addAttachment('assets/uploads/'. $filename);          //Add attachments
        // }
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');               //Optional name

        // Content
        $this->mail->isHTML(true);                                          //Set email format to HTML
        $this->mail->Subject    = 'Activate your account';                  //Title of mail
        $this->mail->Body       = 
                            '<!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Activate your account - Site_security</title>
                                <style>
                                    *{
                                        margin: 0;
                                        padding: 0;
                                        box-sizing:border-box;
                                        font-family: Arial, sans-serif;
                                        font-size: 16px;
                                    }

                                    body {
                                        background-color: #000;
                                        color: #fff;
                                    }

                                    .container {
                                        background-color: rgba(0, 0, 0, 0.7);
                                        margin: 0 auto;
                                        padding: 40px;
                                        max-width: 600px;
                                        text-align: center;
                                        border-radius: 10px;
                                        border: 1px solid #333;
                                    }

                                    h1 {
                                        font-size: 1.5em;
                                        color: #fff;
                                    }

                                    p {
                                        font-size: 1em;
                                        color: #ccc;
                                    }

                                    .validation-code {
                                        background-color: rgba(0, 0, 0, 0.9);
                                        padding: 20px;
                                        font-size: 2em;
                                        color: #00bfff;
                                        font-weight: bold;
                                        letter-spacing: 5px;
                                        margin: 20px 0;
                                        border-radius: 5px;
                                        border: 2px solid #00bfff;
                                    }
                                    a.more {
                                        color: rgb(0, 191, 255);
                                        text-decoration: none;
                                    }
                                    .footer {

                                        margin-top: 30px;
                                        font-size: 0.8em;
                                        color: #888;
                                    }
                                    a.more:hover {
                                        text-decoration: underline;
                                    }
                                </style>
                            </head>
                            <body>

                                <div class="container">
                                    <h1> Mail sent by '. $this->my_name .'</h1>
                                    <h1> Mail sent to '. $this->mail_user .'</h1>
                                    <p> Message : </p>
                                    <div class="validation-code">
                                        <a href='. $this->content .' class="more">Activate my account</a>
                                    </div>
                                    <div class="footer">
                                        If you are having issues, contact our support team
                                    </div>
                                </div>

                            </body>
                            </html>';

        $this->mail->AltBody = 'This is a link to activate your account : '. $this->content;

        if($this->mail->send()){
            return true;
        }

        return false;
    }
}

?>
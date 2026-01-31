<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'functions.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

function sendingMail($mail, $mailToSend, $content, $filename=null){

    $myName = 'Me'; //Change for your name
    $myMail = 'Me@Me.com'; //Change for your mail
    // Go to gmail account, passwords of application then create one, copy and paste it here
    $myPwd = ''; //Change for your password 

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        // MAIL AND PASSWORD WILL BE CHANGE FOR GITHUB
        $mail->Username   = $myMail;                     //SMTP username
        // Go to gmail account, passwords of application then create one, copy and paste it here
        $mail->Password   = $myPwd;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        //setFrom (the one who send it (me),the one who complete contact Form)
        $mail->setFrom($myMail, $mailToSend);
        // Since it's a contact for, i'm the one who must receive it
        $mail->addAddress($myMail, $myName);     //Add a recipient
        // $mail->addAddress($mailToSend, 'Name of the one who complete contact form'); 
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        if($filename !== null){
            $mail->addAttachment('assets/uploads/'. $filename);         //Add attachments
        }
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Training PHPMailer';          //Title of mail
        $mail->Body    = '<!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Test PHPMailer</title>
                                <style>
                                    body {
                                        background-color: #000;
                                        color: #fff;
                                        font-family: Arial, sans-serif;
                                        box-sizing:border-box;
                                        margin: 0;
                                        padding: 0;
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
                                        font-size: 24px;
                                        color: #fff;
                                    }

                                    p {
                                        font-size: 18px;
                                        color: #ccc;
                                    }

                                    .validation-code {
                                        background-color: rgba(0, 0, 0, 0.9);
                                        padding: 20px;
                                        font-size: 32px;
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
                                        font-size: 14px;
                                        color: #888;
                                    }
                                    a.more:hover {
                                        text-decoration: underline;
                                    }
                                </style>
                            </head>
                            <body>

                                <div class="container">
                                    <h1> Mail sent by '. $mailToSend .'</h1>
                                    <p> Message : </p>
                                    <div class="validation-code">' . $content . '</div>
                                    <div class="footer">
                                        We reply as soon as possible, always check your spams
                                    </div>
                                </div>

                            </body>
                            </html>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
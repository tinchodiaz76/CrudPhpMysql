<?php
//https://github.com/PHPMailer/PHPMailer
//https://www.codexworld.com/send-html-email-php-gmail-smtp-phpmailer/

/*
$para = 'martin.caccia@gmail.com';
$asunto    = 'Prueba de envio de emails UNAJ';
$descripcion   = 'Este es el cuerpo del correo de prueba UNAJ';
$de = 'From: gymeidos@gmail.com';
*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//require 'path/to/PHPMailer/src/Exception.php';
include('include/Exception.php');
//require 'path/to/PHPMailer/src/PHPMailer.php';
include('include/PHPMailer.php');
//require 'path/to/PHPMailer/src/SMTP.php';
include('include/SMTP.php');

// Create an instance of PHPMailer class 
//$mail = new PHPMailer;
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// SMTP configuration
$mail->isSMTP();
$mail->Host     = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'gymeidos@gmail.com';
$mail->Password = 'GEidos12345';
$mail->SMTPSecure = 'tls'; //PHPMailer::ENCRYPTION_SMTPS; //'tls';
$mail->Port     = 587; //465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//a partir de aca crear funcion parametrizable

// Sender info 
$mail->setFrom('gymeidos@gmail.com', 'UNAJ'); 
//$mail->addReplyTo('mfdiaz76@gmail.com', 'Martin Diaz'); 
 
// Add a recipient 
$mail->addAddress('martin.caccia@gmail.com'); 
 
// Add cc or bcc  
$mail->addCC('mfdiaz76@gmail.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Email subject 
$mail->Subject = 'Envio de prueba email para UNAJ'; 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Email body content 
$mailContent = ' 
    <h2>Send HTML Email using SMTP Server in PHP</h2> 
    <p>It is a test email by CodexWorld, sent via SMTP server with PHPMailer using PHP.</p> 
    <p>Read the tutorial and download this script from <a href="https://www.codexworld.com/">CodexWorld</a>.</p>'; 
$mail->Body = $mailContent; 
 
// Send email 
if(!$mail->send()){ 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
}else{ 
    echo 'Message has been sent.'; 
}
?>
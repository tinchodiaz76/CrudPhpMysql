<?php
//https://github.com/PHPMailer/PHPMailer
//https://www.codexworld.com/send-html-email-php-gmail-smtp-phpmailer/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('Exception.php');
include('PHPMailer.php');
include('SMTP.php');

function sendEmail($addAddress, $addCC, $subject, $bodyContent)
{
    // Create an instance of PHPMailer class 
    //$mail = new PHPMailer;
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $mail->CharSet = "UTF-8";

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host     = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'gymeidos@gmail.com';
    $mail->Password = 'GEidos12345';
    $mail->SMTPSecure = 'tls'; //PHPMailer::ENCRYPTION_SMTPS; //'tls';
    $mail->Port     = 587; //465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Sender info 
    $mail->setFrom('gymeidos@gmail.com', 'UNAJ - Mesa de ayuda incidentes'); 
    //$mail->addReplyTo('mfdiaz76@gmail.com', 'Martin Diaz'); 
    
    // Add a recipient 
    //$mail->addAddress('martin.caccia@gmail.com'); 
    $mail->addAddress($addAddress); 
    
    // Add cc or bcc  
    //$mail->addCC('mfdiaz76@gmail.com'); 
    //$mail->addBCC('bcc@example.com'); 
    $mail->addCC($addCC); 
    
    // Email subject 
    //$mail->Subject = 'Envio de prueba email para UNAJ'; 
    $mail->Subject = $subject; 
    
    // Set email format to HTML 
    $mail->isHTML(true); 
    
    // Email body content 
    $mailContent = ' 
        <h2>Send HTML Email using SMTP Server in PHP</h2> 
        <p>It is a test email by CodexWorld, sent via SMTP server with PHPMailer using PHP.</p> 
        <p>Read the tutorial and download this script from <a href="https://www.codexworld.com/">CodexWorld</a>.</p>'; 
    //$mail->Body = $mailContent; 
    $mail->Body = $bodyContent;
    
    // Send email 
    if(!$mail->send()){ 
        echo '<html><p>Message could not be sent. Mailer Error: '.$mail->ErrorInfo.'</p></html>'; 
        //die;
    }else{ 
        echo '<html><p>Message has been sent.</p></html>'; 
        //die;
    }
}
?>

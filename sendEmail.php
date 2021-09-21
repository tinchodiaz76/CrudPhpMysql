<?php
/*
$to_email = "martin.caccia@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi, Martin This is test email send by PHP Script";
$headers = "From: gymeidos@gmail.com";
 
if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}
*/


$para = 'martin.caccia@gmail.com';
$asunto    = 'Prueba de envio de emails UNAJ';
$descripcion   = 'Este es el cuerpo del correo de prueba UNAJ';
$de = 'From: gymeidos@gmail.com';

if (mail($para, $asunto, $descripcion, $de))
   {
    echo "Correo enviado satisfactoriamente";
    }
    else {
        echo "Fallo el envio de email...";
    }
?>
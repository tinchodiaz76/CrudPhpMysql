<?php
require('include/sendEmail.php');

//Seteos para envio de email:
$addAddress = 'martin.caccia@gmail.com';
$addCC = 'mfdiaz76@gmail.com';
$subject    = 'Resolucion de incidencia del usuario Martin Caccia';
$bodyContent   = 'Resolucion: de prueba con envio de email';

//Envio de email:
sendEmail($addAddress, $addCC, $subject, $bodyContent);
?>
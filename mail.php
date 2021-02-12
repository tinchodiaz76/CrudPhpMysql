 <?php
$name = "Martin Diaz";
echo "<h1>1</h1>";
$asunto= "Esto es un prueba de Agustin Diaz";
echo "<h1>2</h1>";
$msg="Agustin Diaz es un capooooooo";
echo "<h1>3</h1>";
$email= "mfdiaz76@gmail.com";
echo "<h1>4</h1>";
$header= "From: info@lyseis.com.ar" . "\r\n";
echo "<h1>5</h1>";
/////$header.= "Cc: ad8076962@gmail.com" . "\r\n";
echo "<h1>6</h1>";
$header.= "Reply-To: info@lyseis.com.ar" . "\r\n";
echo "<h1>7</h1>";
$header.= "X-Mailer: PHP/". phpversion();
echo "<h1>8</h1>";
$mail= @mail($email,$asunto,$msg,$header);
if ($mail){
    echo "<h4>El mail se envio Coqui!</h4>";
}
else {
    echo "<h4>Error al enviar el mail!</h4>";
}
?>
<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
include('../include/functions.php');
include('../include/db_conn.php');
//require('../include/sendEmail.php');

//Obtener valores del formulario.
$v_user= $_SESSION['username'];
$resolucion = $_GET['resolucion'];
$id = $_GET['id'];
$email = $_GET['email'];
$nombreApellido = $_GET['nombre'];

$Query_upd= "UPDATE unaj.incidencias SET estado=2, username='".$v_user. "', fecha_cerrado= curdate(), resolucion = '".$resolucion."' WHERE id =".$id;

//echo "<html><p>query: " + $query + "</p></html>";
//die;

if (mysqli_query($con, $Query_upd)) {
    require('../include/sendEmail.php');
    //Seteos para envio de email:
    $addAddress = $email; 
    $addCC = 'mfdiaz76@gmail.com';
    $subject    = 'Resolución de incidencia para el usuario ' . $nombreApellido;
    $bodyContent   = 'Resolución: ' . $resolucion;
    //$subject    = 'Resolucion de incidencia del usuario Martin Caccia';
    //$bodyContent   = 'Resolucion: de prueba con envio de email';
    //Envio de email:
    sendEmail($addAddress, $addCC, $subject, $bodyContent);	
}else{
    //'Se produjo un error, vuelva a intentarlo nuevamente.',
}	
mysqli_close($con);	
?>
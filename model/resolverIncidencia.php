<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
include('../include/functions.php');
include('../include/db_conn.php');

//Obtener valores del formulario.
$v_user= $_SESSION['username'];
$resolucion = $_GET['resolucion'];
$id = $_GET['id'];
$email = $_GET['email'];
$nombreApellido = $_GET['nombre'];

$Query_upd= "UPDATE unaj.incidencias SET estado=2, username='".$v_user. "', fecha_cerrado= curdate(), resolucion = '".$resolucion."' WHERE id =".$id;

if (mysqli_query($con, $Query_upd)) {
    require('../include/sendEmail.php');
    //Seteos para envio de email:
    $addAddress = $email; 
    $addCC = 'mfdiaz76@gmail.com';
    $subject    = 'Resolución de incidencia para el usuario ' . $nombreApellido;
    $bodyContent   = 'Resolución: ' . $resolucion;
    sendEmail($addAddress, $addCC, $subject, $bodyContent);	
}else{
    //'Se produjo un error, vuelva a intentarlo nuevamente.',
}	
mysqli_close($con);	
?>
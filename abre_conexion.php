<?php
// Parametros a configurar para la conexion de la base de datos 

$host="localhost";
$user="";
$pass="";
$dbname="ywayqssx_MA";
	 
        
$conexion = mysqli_connect($host, $user, $pass)  
or die("Unable to connect to MySQL");  
echo "";  


$selected = mysqli_select_db($conexion, $dbname)
or die("Could not select examples");  
?>
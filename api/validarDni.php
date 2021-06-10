<?php

$dni = $_GET['dni_php'];

/*
$api_endpoint= 'https://api.unaj.edu.ar/mesa-de-ayuda/v1/personas?nro_documento=22420019';
*/
$api_endpoint= 'https://api.unaj.edu.ar/mesa-de-ayuda/v1/personas?nro_documento=11';
$basic_credentials ='72b302bf297a228a75730123efef7c41';

/*
$pre_token = file_get_contents('https://api.twitter.com/oauth2/token', false, $context);
$basic_credentials = json_decode($pre_token, true);
*/

$opts = array('http' =>
		array(
			'method'  => 'GET',
			'header'  => 'Token: '.$basic_credentials
/*
    "Authorization: Basic ".base64_encode("$https_user:$https_password")."\r\n",
    'content' => $body,
    'timeout' => 60
*/
		)
	);

	$context  = stream_context_create($opts);

	$data = file_get_contents($api_endpoint, false, $context);

	$array = json_decode($data, true);

	foreach ($array as $value) {
/*
   		$cadena = "El Id de la persona es: '". $value['persona'] ."', y su nombre es: ". $value['apellido_nombres'] ;
*/


		$cadena= "Hola ". $value['apellido_nombres']. ". Tenemos registrado este mail: zzz@gmail.com. Recibir�s la respuesta a ese mail";


	   print ($cadena);
	}

?>

<?php

  # Leemos las variables enviadas mediante Ajax
  $dni = $_POST['dni_php'];
  
  # Verificamos que los campos no esten vacios, el chiste de este if es que si almenos una variable (o campo) esta vacio mostrara error_1
  if (empty($dni))
  {

    # mostramos la respuesta de php (echo)
    echo 'error_1';
  }
  else
  {
          $api_endpoint= 'https://api.unaj.edu.ar/mesa-de-ayuda/v1/personas?nro_documento='.$dni;
          $basic_credentials ='72b302bf297a228a75730123efef7c41';
          
          $opts = array('http' =>
              array(
                'method'  => 'GET',
                'header'  => 'Token: '.$basic_credentials
              )
            );
          
            $context  = stream_context_create($opts);


            $data = file_get_contents($api_endpoint,false, $context);

//            echo $data;

            //$array = json_decode($data, true); Con el TRUE devuelve un array asociatico
            $array = json_decode($data);
            
            if (empty($array))
            {
              echo 'error_3';
            }
            else 
            {
              session_start();
              $_SESSION['apellido_nombres']     = $array->apellido_nombres;
              $_SESSION['nombres']     = $array->nombres;
              $_SESSION['apellido']     = $array->apellido;
              $_SESSION['usuario_alumno']     = $array->usuario;
            }
  }
?>

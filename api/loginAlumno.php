<?php

  # Leemos las variables enviadas mediante Ajax
  $user = $_POST['user_php'];
  $clave = $_POST['clave_php'];
  
  $velementos= false;
  
  # Verificamos que los campos no esten vacios, el chiste de este if es que si almenos una variable (o campo) esta vacio mostrara error_1
  if(empty($user) || empty($clave))
  {
    # mostramos la respuesta de php (echo)
    echo 'error_1';
  }
  else
  {
       
      $api_endpoint= 'https://api.unaj.edu.ar/mesa-de-ayuda/v1/personas/login';
      
      $basic_credentials ='72b302bf297a228a75730123efef7c41';

      $opts = array('http' =>
        array(
          'method'  => 'POST',
          'header'  => "Content-Type: text/xml\r\n".
            "token:".$basic_credentials. "\r\n",
          'content' => '{"usuario":"'.$user. '","clave": "'.$clave.'"}',
          'timeout' => 60
        )
      );


      $context  = stream_context_create($opts);

      $result = file_get_contents($api_endpoint, false, $context);

//    echo $result;

      //$array = json_decode($result, true); Cone le TRUE devuelve un array asociatico      
      $array = json_decode($result);
//    Este END POINT devuelve un OBJETOS


      if($array->status == "success")
      {
            echo $array->persona->usuario;
            echo $array->persona->nombres;
            echo $array->persona->persona;

            session_start();
            $_SESSION['nombres']     = $array->persona->nombres;
            $_SESSION['apellido']    =$array->persona->apellido;
            $_SESSION['persona']     = $array->persona->persona;

            //echo $array->persona;
            //echo $resp->apellido . " " . $resp->nombres;
      }
      else 
      {
            echo "error_3";
      }


            
           
  }
?>

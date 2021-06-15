<?php

class Carreras// extends Conexion
	{
		public function TraerCarreras()
    	{	
          session_start();
          $persona= $_SESSION['persona'];
          //$persona="22";


          $api_endpoint= 'https://api.unaj.edu.ar/mesa-de-ayuda/v1/personas/'. $persona. '/propuestas';
          $basic_credentials ='72b302bf297a228a75730123efef7c41';
          
          $opts = array('http' =>
              array(
                'method'  => 'GET',
                'header'  => 'Token: '.$basic_credentials
              )
            );
          
            $context  = stream_context_create($opts);


            $data = file_get_contents($api_endpoint,false, $context);

            echo $data;

            //$array = json_decode($data, true); Con el TRUE devuelve un array asociatico
            $array = json_decode($data);
//          Este END POINT devuelve un ARRAY de OBJETOS, por eso el resultado lo recorrro con FOREACH

//            echo $array;

            if (empty($array))
            {
              echo 'error_3';
            }
            else 
            {

              foreach ($array as $value)
              {
                //acciones
//                echo $value->plan_codigo;
//                echo $value->plan_nombre;
                  
                $carreras[] = array('propuesta_codigo'=> $value->propuesta_codigo, 'propuesta_nombre'=> $value->propuesta_nombre);
/*
                session_start();
                $_SESSION['plan_codigo']     = $value->plan_codigo;
                $_SESSION['plan_nombre']     = $value->plan_nombre;
*/                
              }
            }
      }
  }

  if (isset($_POST['traerCarreras']))
         {
            
           $carreras = new Carreras();
          
           $carreras->TraerCarreras();
        };
?>
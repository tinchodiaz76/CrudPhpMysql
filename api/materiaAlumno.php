<?php
class Materias// extends Conexion
{
  public function TraerMaterias()
    {	
         
        session_start();
        $persona= $_SESSION['persona'];

        $api_endpoint= 'https://api.unaj.edu.ar/mesa-de-ayuda/v1/personas/'. $persona. '/inscripciones?vigente=1';
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
              //echo $value->elemento_codigo;
              //echo $value->elemento_nombre;
                                
              $materias[] = array('elemento_codigo'=> $value->elemento_codigo, 'elemento_nombre'=> $value->elemento_nombre);
/*
              session_start();
              $_SESSION['elemento_codigo']     = $value->elemento_codigo;
              $_SESSION['elemento_nombre']     = $value->elemento_nombre;
*/                
            }
          }
    }
  }
    
  if (isset($_POST['traerMaterias']))
          {
            
            $carreras = new Materias();
          
            $carreras->TraerMaterias();
        };
?>

<?php 

    session_start();

    $arr[] = array('nombres' =>  $_SESSION['nombres'] , 'apellido' =>  $_SESSION['apellido'], 
                    'dni'=> $_SESSION['nro_documento'] );

    $datosUsuarios= json_encode($arr);

    echo $datosUsuarios;
    
?>

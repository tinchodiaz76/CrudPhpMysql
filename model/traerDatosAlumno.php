<?php 

    session_start();

    $arr[] = array('nombres' =>  $_SESSION['nombres'] , 'apellido' =>  $_SESSION['apellido'] );

    $datosUsuarios= json_encode($arr);

    echo $datosUsuarios;
    
?>

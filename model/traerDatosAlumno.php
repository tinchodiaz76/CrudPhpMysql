<<<<<<< HEAD
<?php 

    session_start();

    $arr[] = array('nombres' =>  $_SESSION['nombres'] , 'apellido' =>  $_SESSION['apellido']);

    $datosUsuarios= json_encode($arr);

    echo $datosUsuarios;
    
?>
=======
<?php 

    session_start();

    $arr[] = array('nombres' =>  $_SESSION['nombres'] , 'apellido' =>  $_SESSION['apellido'] );

    $datosUsuarios= json_encode($arr);

    echo $datosUsuarios;
    
?>
>>>>>>> 497df68054f187bdcebc3f54618cb224480a61f2

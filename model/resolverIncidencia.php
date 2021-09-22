<?php

    session_start();

    # Incluimos la clase usuario
    require_once('conexion.php');

    class ResolverIncidencias extends Conexion
    {
        public function resolverIncidencia($resolucion,$id)
        {	
            parent::conectar();

            $v_user= $_SESSION['username'];

            $query ='update unaj.incidencias 
            set estado=2,
            username= "'.$v_user.'",
            fecha_cerrado= curdate(),
            resolucion= "'.$resolucion.'"
            where id= '.$id;

            $resEmp =parent::query($query);

            //$asunto= "Información de citepUba";
            //$header= "From: info@lyseis.com.ar" . "\r\n";
            //$email="mfdiaz76@gmail.com";
            //$mail= @mail($email,$asunto,$resolucion,$header);

            $para = 'martin.caccia@gmail.com';
            $asunto    = 'Resolucion de incidencia del usuario ' + $v_user;
            $descripcion   = 'Resolucion: ' + $resolucion;
            $de = 'From: gymeidos@gmail.com';
            if (mail($para, $asunto, $descripcion, $de))
            {
                echo "Correo enviado satisfactoriamente";
            }
            else 
            {
                echo "Fallo el envio de email";
            }
            /*                
            if ($mail){
                echo "<h4>El mail se envio Coqui!</h4>";
            }
            else 
            {
                echo "<h4>Error al enviar el mail!</h4>";
            }
            */
			parent::cerrar();
		}
	}			

    if (isset($_POST['resolverIncidencias']))
	{
		$foo = new ResolverIncidencias();

		$foo->resolverIncidencia($_GET['resolucion'],$_GET['id']);
   	}
?>
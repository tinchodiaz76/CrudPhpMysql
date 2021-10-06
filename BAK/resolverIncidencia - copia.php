<?php

    session_start();

    # Incluimos la clase usuario
    require_once('conexion.php');

    class ResolverIncidencias extends Conexion
    {
        public function resolverIncidencia($resolucion,$id,$email)
        {	
            parent::conectar();

            $v_user= $_SESSION['username'];

            $query ='update unaj.incidencias 
            set estado=2,
            username= "'.$v_user.'",
            fecha_cerrado= curdate(),
            resolucion= "'.$resolucion.'"
            where id= '.$id;

            //echo "<html><p>query: " + $query + "</p></html>";
            //die;

            $resEmp = parent::query($query);
            //echo "<html><p>RES: " + $resEmp + "</p></html>";
            //die();
            //if ($resEmp)
            //{
                require('../include/sendEmail.php');
                //Seteos para envio de email:
                $addAddress = $email; //'martin.caccia@gmail.com'; //$email;
                $addCC = 'mfdiaz76@gmail.com';
                $subject    = 'Resolución de incidencia para el usuario ' + $v_user;
                $bodyContent   = 'Resolución: ' + $resolucion;
                //Envio de email:
                sendEmail($addAddress, $addCC, $subject, $bodyContent);
            //}
			parent::cerrar();
		}
	}			

    if (isset($_POST['resolverIncidencias']))
	{
		$foo = new ResolverIncidencias();

		$foo->resolverIncidencia($_GET['resolucion'],$_GET['id'],$_GET['email']);
   	}
?>
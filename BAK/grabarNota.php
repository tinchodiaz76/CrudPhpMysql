<?php

    session_start();

    # Incluimos la clase usuario
    require_once('conexion.php');

    class GrabarNotas extends Conexion
    {
        public function grabarNota($nota,$id)
        {	
            parent::conectar();

            $v_user= $_SESSION['username'];

            $query ='update unaj.incidencias 
            set estado=1,
            username= "'.$v_user.'",
            fecha_cerrado= curdate(),
            nota= "'.$nota.'"
            where id= '.$id;

            $resEmp =parent::query($query);

			parent::cerrar();
		}
	}			

    if (isset($_POST['grabarNotas']))
	{
		$foo = new GrabarNotas();

		$foo->grabarNota($_GET['nota'],$_GET['id']);
   	}
?>
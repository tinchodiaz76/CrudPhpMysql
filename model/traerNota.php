<?php 
    // Arrays para guardar mensajes y errores:

    session_start();

    # Incluimos la clase usuario
    require_once('conexion.php');

    class TraerNotas extends Conexion
    {
        public function traerNota($inc_id)
        {	
            parent::conectar();

            /*
            $query =  'select inc.id, IFNULL(replace(inc.nota,null,"'.''.'"),inc.nota) nota
            from unaj.incidencias inc
            where inc.id= '.$inc_id;
            */
            $query =  'select inc.id, IF(inc.nota IS NULL, "'.''.'", inc.nota)  nota
            from unaj.incidencias inc
            where inc.id= '.$inc_id;

            $resEmp =parent::query($query);

            while($row = mysqli_fetch_array($resEmp))
            {
                //echo json_encode($row); 
                $id=$row['id'];
                $nota=$row['nota'];
                
                $incidencia[] = array('id'=> $id, 'nota'=> $nota);
            }

            if (!empty($incidencia)) 
            {
                //mysqli_free_result($resEmp);
                //include('cerrar_conexion.php');
                //Creamos el JSON
                $json_string = json_encode($incidencia);
                echo $json_string;
            }
            else 
            {
                $incidencia = [];

                //mysqli_free_result($resEmp);
                //include('cerrar_conexion.php');
                $json_string = json_encode($incidencia);
                echo $json_string;
            }	
            parent::cerrar();
		}
	}

    if (isset($_POST['nota']))
	{
		$foo = new TraerNotas();

		$foo->traerNota($_GET['inc_id']);
   	}
?>

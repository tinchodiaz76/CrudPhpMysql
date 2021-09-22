﻿<?php 
    // Arrays para guardar mensajes y errores:

    session_start();

    # Incluimos la clase usuario
    require_once('conexion.php');

    class TraerTiposIncidencias extends Conexion
    {
        public function traerTipoIncidencia()
        {	
            parent::conectar();

            $query =  'select id, descripcion, resolucion
            from unaj.resoluciones_incidencias';

            $resEmp =parent::query($query);

            while($row = mysqli_fetch_array($resEmp))
            {
                //echo json_encode($row); 
                $Tipo_Incidencia=$row['id'];
                $Descrip_Inciden=$row['descripcion'];
                $Texto_Resolucion=$row['resolucion'];

                $incidencia[] = array('Tipo_Incidencia'=> $Tipo_Incidencia,
                 'Descrip_Inciden'=> $Descrip_Inciden, 
                 'Texto_Resolucion'=> $Texto_Resolucion);

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

    if (isset($_POST['traerTiposIncidencias']))
	{
    
		$foo = new TraerTiposIncidencias();

		$foo->traerTipoIncidencia();
    }
?>

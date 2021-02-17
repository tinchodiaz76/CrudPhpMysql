<?php 
	session_start();

	# Incluimos la clase usuario
	require_once('conexion.php');

	class RespuestasFrecuentes extends Conexion
	{
		public function TraerRespuestasFrecuentes($tipo_id, $id_pregunta)
    	{	
		
			parent::conectar();

			$query =  'select respuesta
							from ywayqssx_MA.respuestas_frecuentes
							where tipo_id= '.$tipo_id.'
							and id_pregunta= '.$id_pregunta.'
							order by orden_aparicion asc';

			$resEmp =parent::query($query);


			while($row = mysqli_fetch_array($resEmp))
			{
				$respuesta= $row['respuesta'];

				$incidencias[] = array('respuesta'=> $respuesta);
			}
			if (!empty($incidencias)) 
			{
				//mysqli_free_result($resEmp);
				//include('cerrar_conexion.php');
				//Creamos el JSON
				$json_string = json_encode($incidencias);
				echo $json_string;
			}
			else 
			{
					$incidencias = [];

					//mysqli_free_result($resEmp);
					//include('cerrar_conexion.php');
					$json_string = json_encode($incidencias);
					echo $json_string;
			}
			# Cerramos la conexion
			parent::cerrar();
		}
	}			

	if (isset($_POST['traerRespuestasFrecuentes']))
	{
		$foo = new RespuestasFrecuentes();

		$foo->TraerRespuestasFrecuentes($_GET['tipo_id'],$_GET['id_pregunta']);
   	}
?>
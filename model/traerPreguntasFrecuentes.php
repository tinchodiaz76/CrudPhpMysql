<?php 

	session_start();

	# Incluimos la clase usuario
	require_once('conexion.php');

	class PreguntasFrecuentes extends Conexion
	{
		public function TraerPreguntasFrecuentes()
    	{	
		
			parent::conectar();
			
			$query =  'select tipo_id, id_pregunta, pregunta
							from unaj.preguntas_frecuentes
							where tipo_id=1
							order by orden_aparicion asc';

			$resEmp =parent::query($query);


			while($row = mysqli_fetch_array($resEmp))
			{
				//echo $row['pregunta'];

				$tipo_id= $row['tipo_id'];
				$id_pregunta=$row['id_pregunta'];
				$pregunta=$row['pregunta'];
		
				$incidencias[] = array('tipo_id'=> $tipo_id, 'id_pregunta'=>$id_pregunta,
				'pregunta'=> $pregunta
						);
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

	if (isset($_POST['traerPreguntasFrecuentes']))
	{
		$foo = new PreguntasFrecuentes();

		$foo->TraerPreguntasFrecuentes();
   	}
	
?>
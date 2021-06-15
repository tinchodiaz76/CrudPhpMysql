<?php 

	session_start();

 	# Incluimos la clase usuario
	require_once('conexion.php');

	class TraerMasInformacion extends Conexion
	{
		public function TraerMasInfo($Tipo_incidencia)
    	{	
			parent::conectar();

			if (!empty($Tipo_incidencia))
			{
				$query='select mas_informacion
						from unaj.tipinciden 
						where tipo_incidencia='.$Tipo_incidencia;
				
				$resEmp =parent::query($query);

				while($row = mysqli_fetch_array($resEmp))
				{
					$mas_informacion=$row['mas_informacion'];
					$incidenciamasInfo[] = array('mas_informacion'=> $mas_informacion);
				}
			

				if (!empty($incidenciamasInfo)) 
				{
				//mysqli_free_result($resEmp);
				//include('cerrar_conexion.php');
				//Creamos el JSON
				$json_string = json_encode($incidenciamasInfo);
				echo $json_string;
				}
				else 
				{
					$incidenciamasInfo = [];
	
					//mysqli_free_result($resEmp);
					//include('cerrar_conexion.php');
					$json_string = json_encode($incidenciamasInfo);
					echo $json_string;
				}	
			
				# Cerramos la conexion
				parent::cerrar();
			}
		}
		
	}

	if (isset($_POST['traerMasInfo']))
	{
	
		$foo = new TraerMasInformacion();

		$foo->TraerMasInfo($_GET['Tipo_incidencia']);
   	}

?>

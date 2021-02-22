<?php 

	session_start();

 	# Incluimos la clase usuario
	require_once('conexion.php');

	class Areas extends Conexion
	{
		public function TraerAreas()
    	{	
		
			parent::conectar();

			$v_user= $_SESSION['username'];

			$query = 'select id_area,descrip_area,estado
                    from ywayqssx_MA.area_inciden
                    where tipo_id=1
                    and estado=0
                    order by id_area asc';

			$resEmp =parent::query($query);

			while($row = mysqli_fetch_array($resEmp))
			{
				/*echo json_encode($row); */

				$id_area=$row['id_area'];
				$descrip_area=$row['descrip_area'];
				$estado= $row['estado'];
						
				$areas[] = array('id_area'=> $id_area, 'descrip_area'=> $descrip_area, 'estado'=> $estado);
			}

			if (!empty($areas)) 
			{
				//mysqli_free_result($resEmp);
				//include('cerrar_conexion.php');
				//Creamos el JSON
				$json_string = json_encode($areas);
				echo $json_string;
			}
			else 
			{
					$areas = [];

					//mysqli_free_result($resEmp);
					//include('cerrar_conexion.php');
					$json_string = json_encode($areas);
					echo $json_string;
			}
			# Cerramos la conexion
			parent::cerrar();

		}
		
	}

	  		
	if (isset($_POST['traerAreas']))
	{
	
		$foo = new Areas();

		$foo->TraerAreas();
   	}

?>

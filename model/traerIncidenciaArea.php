<?php 

	session_start();

 	# Incluimos la clase usuario
	require_once('conexion.php');

	class IncidenciaArea extends Conexion
	{
		public function TraerIncidenciaArea($v_area)
    	{	
			parent::conectar();
		
			if (empty($v_area))
			{
				$query='select id from  
										(select * from unaj.area_incidente
										 where estado=0	
										order by id asc
										) t1
						limit 1';
				
				$resEmp =parent::query($query);

				while($row = mysqli_fetch_array($resEmp))
				{
					$id_area=$row['id'];
				}
			
				$query = 'select tipo_id, id_area, tipo_incidencia, descrip_inciden, texto_resolucion,estado
				from unaj.tipinciden
				where tipo_id=1
				and id_area='.$id_area.'
				and estado=0
				order by tipo_incidencia asc';
			}
			else
			{
				
				$query = 'select tipo_id, id_area, tipo_incidencia, descrip_inciden, 
				texto_resolucion,estado
				from unaj.tipinciden
				where tipo_id=1
				and id_area='.$v_area.'
				and estado=0
				order by tipo_incidencia asc';
			}


			
			$resEmp =parent::query($query);

			while($row = mysqli_fetch_array($resEmp))
			{
				/*echo json_encode($row); */

				$tipo_id=$row['tipo_id'];
				$id_area=$row['id_area'];
				$tipo_incidencia= $row['tipo_incidencia'];
				$descrip_inciden= $row['descrip_inciden'];
				$texto_resolucion= $row['texto_resolucion'];
				$estado= $row['estado'];

				$incidenciaarea[] = array('tipo_id'=> $tipo_id, 'id_area'=> $id_area, 'tipo_incidencia'=> $tipo_incidencia,'descrip_inciden'=>$descrip_inciden, 'texto_resolucion'=> $texto_resolucion, 'estado'=> $estado);
			}

			if (!empty($incidenciaarea)) 
			{
				//mysqli_free_result($resEmp);
				//include('cerrar_conexion.php');
				//Creamos el JSON
				$json_string = json_encode($incidenciaarea);
				echo $json_string;
			}
			else 
			{
					$areas = [];

					//mysqli_free_result($resEmp);
					//include('cerrar_conexion.php');
					$json_string = json_encode($incidenciaarea);
					echo $json_string;
			}
			# Cerramos la conexion
			parent::cerrar();

		}
		
	}

	  		
	if (isset($_POST['traerIncidenciaArea']))
	{
	
		$foo = new IncidenciaArea();

		$foo->TraerIncidenciaArea($_GET['id_area']);
   	}

?>

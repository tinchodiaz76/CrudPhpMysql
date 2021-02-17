<?php 

	session_start();

 	# Incluimos la clase usuario
	require_once('conexion.php');

	class Incidencias extends Conexion
	{
		public function TraerIncidencias()
    	{	
		
			parent::conectar();

			$v_user= $_SESSION['username'];

			$query = 'select inc.apellido, inc.nombre, inc.dni, inc.telefono,
							inc.email, tip.descrip_inciden,
							inc.descrip_incidencia usuario_descripcion, 
							CASE 
								when estado=0 THEN "'.'Abierta'.'"
								ELSE "'.'Cerrada'.'"
							END estado_descrip,
							date_format(inc.fecha_creacion, "'.'%d/%m/%Y'.'") fecha_creacion,
							inc.id
							from ywayqssx_MA.incidencias inc, ywayqssx_MA.usuxperfil per, ywayqssx_MA.tipinciden tip
							where per.username= "'.$v_user.'"
							and inc.estado=0    
							and inc.tipo_incidencia = per.tipo_incidencia
							and tip.tipo_incidencia= inc.tipo_incidencia';

			$resEmp =parent::query($query);

			while($row = mysqli_fetch_array($resEmp))
			{
				/*echo json_encode($row); */

				$apellido=$row['apellido'];
				$nombre=$row['nombre'];
				$dni=$row['dni'];
				$telefono=$row['telefono'];
				$email=$row['email'];
				$descrip_inciden=$row['descrip_inciden'];
				$usuario_descripcion= $row['usuario_descripcion'];
				$estado_descrip= $row['estado_descrip'];
				$fecha_creacion= $row['fecha_creacion'];
				$id= $row['id'];

		
				$incidencias[] = array('apellido'=> $apellido, 'nombre'=> $nombre, 'dni'=> $dni, 'telefono'=> $telefono,
				'email'=> $email, 'descrip_inciden'=>$descrip_inciden, 'usuario_descripcion'=>$usuario_descripcion,
				'estado_descrip'=>$estado_descrip,
				'fecha_creacion'=>$fecha_creacion, 'id'=>$id);
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

	  		
	if (isset($_POST['trarIncidencias']))
	{
	
	
		$foo = new Incidencias();

		$foo->TraerIncidencias();
   	}

?>

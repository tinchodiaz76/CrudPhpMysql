<?php
session_start();
include('../include/functions.php');
include('../include/db_conn.php');
//Obtener valores del formulario.
$id = $_POST['id']; 
$tipo = $_POST['tipo'];
$desc = $_POST['desc'];
$orden = $_POST['orden'];
$activo = $_POST['activo'];
$action = $_POST['action'];
//Fin obtener valores del formulario. 

/*
$arr = array(
	'stack'=>'overflow',
	'key'=> $desc
  );
echo json_encode($arr);
die();

$desc = isset($_GET['desc']);
$jsondata = array();
$jsondata["data"] = array('desc' => $desc);
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata, JSON_FORCE_OBJECT);
die();
*/		

//ABM
switch($action)
{
	case 'insert':
		$accion_desc = "Se insertó la pregunta frecuente con exito.";	
		$Query_ins = "INSERT INTO unaj.preguntas_frecuentes (tipo_id, pregunta, orden_aparicion, activo) VALUES ($tipo,'".$desc."',$orden,$activo)";
		// insert into unaj.preguntas_frecuentes(tipo_id, id_pregunta, pregunta, orden_aparicion, activo) values (1,3,'prueba',3,1);					
		if (mysqli_query($con, $Query_ins)) {
			mysqli_close($con);		
			$arr = array(
				'stack'=>$accion_desc,
				'key'=> $desc
			  );
			echo json_encode($arr);		
		}else{
			$arr = array(
				'stack'=>'Se produjo un error, vuelva a intentarlo nuevamente.',
				'key'=> $desc
			  );
			echo json_encode($arr);	
		}	
		break;	
	case 'edit':		
		$accion_desc = "Se actualizó la pregunta frecuente $id con exito.";	
		$Query_upd= "UPDATE unaj.preguntas_frecuentes SET orden_aparicion= ".$orden. ", pregunta = '".$desc."' WHERE id_pregunta =".$id;
		if (mysqli_query($con, $Query_upd)) {
			mysqli_close($con);		
			$arr = array(
				'stack'=>$accion_desc,
				'key'=> $desc
			  );
			echo json_encode($arr);		
		}else{
			$arr = array(
				'stack'=>'Se produjo un error, vuelva a intentarlo nuevamente.',
				'key'=> $desc
			  );
			echo json_encode($arr);	
		}		
		break;
	case 'delete':
		$accion_desc = "Se elimino la pregunta frecuente $id con exito.";	
		$Query_del= "UPDATE unaj.preguntas_frecuentes SET activo = 0 WHERE id_pregunta =".$id;
		if (mysqli_query($con, $Query_del)) {
			mysqli_close($con);		
			$arr = array(
				'stack'=>$accion_desc,
				'key'=> $desc
			  );
			echo json_encode($arr);		
		}else{
			$arr = array(
				'stack'=>'Se produjo un error, vuelva a intentarlo nuevamente.',
				'key'=> $desc
			  );
			echo json_encode($arr);	
		}	
		break;
	case 'activar':
		$accion_desc = "Se activo la pregunta frecuente $id con exito.";	
		$Query_act= "UPDATE unaj.preguntas_frecuentes SET activo = 1 WHERE id_pregunta =".$id;
		if (mysqli_query($con, $Query_act)) {
			mysqli_close($con);		
			$arr = array(
				'stack'=>$accion_desc,
				'key'=> $desc
				);
			echo json_encode($arr);		
		}else{
			$arr = array(
				'stack'=>'Se produjo un error, vuelva a intentarlo nuevamente.',
				'key'=> $desc
			  );
			echo json_encode($arr);	
		}	
		break;
}

?>
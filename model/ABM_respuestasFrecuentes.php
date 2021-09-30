<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
include('../include/functions.php');
include('../include/db_conn.php');
//Obtener valores del formulario.
$id = $_POST['id']; 
$tipo = $_POST['tipo'];
$id_pregunta = $_POST['id_pregunta'];
$desc = $_POST['desc'];
$orden = $_POST['orden'];
$activo = $_POST['activo'];
$action = $_POST['action'];
//Fin obtener valores del formulario. 

//ABM
switch($action)
{
	case 'insert':
		$accion_desc = "Se insertó la respuesta frecuente con exito.";	
		$Query_ins = "INSERT INTO unaj.respuestas_frecuentes (tipo_id, id_pregunta, respuesta, link, orden_aparicion, activo) VALUES ($tipo, $id_pregunta, '".$desc."', '', $orden, $activo)";		
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
		$accion_desc = "Se actualizó la respuesta frecuente $id con exito.";	
		$Query_upd= "UPDATE unaj.respuestas_frecuentes SET orden_aparicion=".$orden. ", respuesta = '".$desc."' WHERE id_respuesta =".$id;
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
		$accion_desc = "Se elimino la respuesta frecuente $id con exito.";	
		$Query_del= "UPDATE unaj.respuestas_frecuentes SET activo = 0 WHERE id_respuesta =".$id;
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
		$accion_desc = "Se activo la respuesta frecuente $id con exito.";	
		$Query_act= "UPDATE unaj.respuestas_frecuentes SET activo = 1 WHERE id_respuesta =".$id;
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
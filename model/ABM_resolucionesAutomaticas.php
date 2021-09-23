<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
include('../include/functions.php');
include('../include/db_conn.php');
//Obtener valores del formulario.
$id = $_POST['id']; 
$tipo_id = $_POST['tipo_id'];
$area_id = $_POST['area_id'];
$desc = $_POST['desc'];
$resolucion = $_POST['resolucion'];
$infoad = $_POST['infoad'];
$activo = $_POST['activo'];
$action = $_POST['action'];
//Fin obtener valores del formulario. 

//ABM
switch($action)
{
	case 'insert':
		$accion_desc = "Se insertó la resolucion automatica con exito.";	
		$Query_ins = "INSERT INTO unaj.resoluciones_incidencias (tipo_id, area_id, descripcion, resolucion, informacion_adicional, estado) VALUES ($tipo_id, $area_id, '".$desc."', '".$resolucion."', $infoad, $activo)";		
		if (mysqli_query($con, $Query_ins)) {
			mysqli_close($con);		
			$arr = array(
				'stack'=>$accion_desc,
				'key'=> $desc
			  );
			echo json_encode($arr);		
		}else{
			$arr = array(
				//'stack'=>'Se produjo un error, vuelva a intentarlo nuevamente.',
				'stack'=> $Query_ins,
				'key'=> $desc
			  );
			echo json_encode($arr);	
		}	
		break;	
	case 'edit':		
		$accion_desc = "Se actualizó la resolucion automatica $id con exito.";	
		$Query_upd= "UPDATE unaj.resoluciones_incidencias SET descripcion = '".$desc."' WHERE id =".$id;
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
		$accion_desc = "Se elimino la resolucion automatica $id con exito.";	
		$Query_del= "UPDATE unaj.resoluciones_incidencias SET estado = 0 WHERE id =".$id;
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
		$accion_desc = "Se activo la resolucion automatica $id con exito.";	
		$Query_act= "UPDATE unaj.resoluciones_incidencias SET activo = 1 WHERE id =".$id;
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
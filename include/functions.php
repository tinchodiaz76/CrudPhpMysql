<?php
/* Html_OptionList_render
$result: Resulset de la consulta sql para popular los option
		 El primer campo del select corresponde al value del option y el segundo campo a la descripcion
$multiple: Atributo 1 o 0 para definir si el elemento html select es multiple 
$SelectId: El ID y name del elemento html select
$output: Variable de concatenacion y retorno de la funcion
*/
function Html_OptionList_render($result, $multiple, $SelectId, $size)
{
	//Links content string variable
    $output = '';
	if ($size==NULL){
		$size=10;
	}
	if ($multiple==1)
	{
		$output = "<select multiple='multiple' size=".$size." id=".$SelectId." name=".$SelectId." class='demo2'>";
		
	}	
	else
	{
		$output = "<select size=".$size." id=".$SelectId." name=".$SelectId." class='demo2'>";
	}
					while ($row = mysqli_fetch_row($result)) 
					{
						$cantColumns = mysqli_num_fields($result);
						if ($cantColumns==3) //Me fijo la cantidad de columnas, si son 3 la tercera columna me indica si debe ser selected o no.
						{
							if ($row[2]==1) //Se fija si debe ser selected o no.
							{
								$output .= "<option value=" . $row[0] . " selected>" . $row[1] . "</option>";
							}
							else
							{
								$output .= "<option value=" . $row[0] . ">" . $row[1] . "</option>";							
							}
						}	
						else //Si la consulta solo me trae dos columnas.
						{
							$output .= "<option value=" . $row[0] . ">" . $row[1] . "</option>";							
						}
					}
	//$output .= "<option value='1' selected>Prueba</option>";					
	$output .= "</select>";
    
	echo $output;
	//return $output;
}

/* List_render
$result: Resulset de la consulta sql para popular los option
		 El primer campo del select corresponde al value del option y el segundo campo a la descripcion
$multiple: Atributo 1 o 0 para definir si el elemento html select es multiple 
$SelectId: El ID y name del elemento html select
$size: Tamaño (si se le pasa tamaño se convierte en un listbox multiple)
$class: Clase css a aplicar al select
$output: Variable de concatenacion y retorno de la funcion
*/
function List_render($result, $multiple, $SelectId, $size, $class, $selectedValue)
{
	//Links content string variable
    $output = '';
	if ($size==NULL){
		$size="";
	}else {
		$size="size='$size'";
	}
	if ($class==NULL){
		$class="class='form-control'";
	}else {
		$class="class='$class'";
	}
	if ($selectedValue==NULL){
		$SValue="";
	}else {
		$SValue="value='$selectedValue'";
	}
	if ($multiple==1)
	{
		$output = "<select multiple='multiple' ".$size." id=".$SelectId." name=".$SelectId." ".$class." ".$SValue.">";
	}	
	else
	{
		$output = "<select id=".$SelectId." name=".$SelectId." ".$class." ".$SValue.">";
	}
					while ($row = mysqli_fetch_row($result)) 
					{
						//$cantColumns = mysqli_num_fields($result);
						if ($selectedValue==$row[0]) //Me fijo si el valor coincide con el seleccionado, si coincide es selected.
						{						
							$output .= "<option value=" . $row[0] . " selected>" . $row[1] . "</option>";
						}	
						else //No es valor selected.
						{
							$output .= "<option value=" . $row[0] . ">" . $row[1] . "</option>";							
						}
					}				
	$output .= "</select>";
    
	echo $output;
	//return $output;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//Funcion para redireccionar a otra pagina
function header_redirect($location, $ft, $number) {    
	header("Location: ".$location, $ft, $number);
	exit();
}

//Recibe el src de la DB y devuelve img correspondiente, si es null asigna imagen por default
function imgPic($src, $w, $h, $a) {
	if ($w == NULL or $h == NULL){
		if ($a == NULL){
				$w=40;
				$h=40;				
		}		
	}
	if ($src === NULL) {
		$src='../../img/profilePic/default-user.png';
		$a='Por favor tomar foto';
	}
	$img= "<img src='$src' width='$w' height='$h' alt='$a' />";
	return $img;
}

//Recibe el numero del tipo de medicion y devuelve la descripcion
function mediciones($tipo) {
	$tipo_desc="";
	switch ($tipo) {
		case 1:
			$tipo_desc="Bicep Der";
			break;
		case 2:
			$tipo_desc="Bicep Izq";
			break;			
		case 3:
			$tipo_desc="Pecho";
			break;			
		case 4:
			$tipo_desc="Espalda";
			break;			
		case 5:
			$tipo_desc="Cuadricep Der";
			break;			
		case 6:
			$tipo_desc="Cuadricep Izq";
			break;	
		case 7:
			$tipo_desc="Gemelo Der";
			break;	
		case 8:
			$tipo_desc="Gemelo Izq";
			break;	
		case 9:
			$tipo_desc="Cintura";
			break;	
		case 10:
			$tipo_desc="Peso";
			break;	
		case 11:
			$tipo_desc="BMI";
			break;				
		default:
			$tipo_desc="NN";
	}	
	return $tipo_desc;
}

//Recibe Sex de la DB y devuelve la descripcion
function sex_desc($tipo){	
	$sex_desc="";
	switch ($tipo) {
		case 1:
			$sex_desc="Hombre";
			break;
		case 2:
			$sex_desc="Mujer";
			break;			
		default:
			$sex_desc="Indefinido";
	}	
	return $sex_desc;
}
?>
<?php
// include '../../include/db_conn.php';
// page_protect();
//Include functions file
session_start();
include('../include/functions.php');
require_once('conexion.php');
class Incidencias extends Conexion
{
	public function TraerPreguntas()
    {	
		parent::conectar();

//Respuesta validacion del CRUD/ABM:
$Validation = '';
if (isset($_REQUEST['Validation']))
{
	$Validation = $_REQUEST['Validation'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Eidos Gym</title>
    <link rel="stylesheet" href="../neon/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
    <link rel="stylesheet" href="../neon/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
    <link rel="stylesheet" href="../neon/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
    <link rel="stylesheet" href="../neon/css/neon.css"  id="style-resource-5">
    <!-- link rel="stylesheet" href="../neon/css/custom.css"  id="style-resource-6" -->
	<!-- Estilo de campo requeridos -->
	<style>
		.error {color: #FF0000;}
	</style>	

    <script src="../neon/js/jquery-1.10.2.min.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.spinner.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.slider.js"></script>

    <SCRIPT LANGUAGE="JavaScript">
		function checkIt(evt) {
		    evt = (evt) ? evt : window.event
		    var charCode = (evt.which) ? evt.which : evt.keyCode
		    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		        status = "This field accepts numbers only."
		        return false
		    }
		    status = ""
		    return true
		}
	</SCRIPT>

</head>
<?php
//Inicializacion valores campos input para insert y update
$desc_input = "";

//Insert
if ($_SERVER["REQUEST_METHOD"] == "POST") {	

	//Obtener valores del formulario.
	 $edit_hidden = $_POST['edit_hidden'];	
	 $id_hidden = $_POST['id_hidden'];	
	 $desc = $_POST['desc'];
	//Fin obtener valores del formulario.  
	
	if ($edit_hidden == 'edit'){
		$accion_desc = "actualizó";	
		$Query_ins= "UPDATE `unaj.preguntas_frecuentes` SET `Desc` = '".$desc."' WHERE id =".$id_hidden;		
	}else{
		$accion_desc = "insertó";	
		$Query_ins = "INSERT INTO `unaj.preguntas_frecuentes` (`Desc`) VALUES ('".$desc."')";		
	}

	//echo "Query_ins: ". $Query_ins;
	//die();

	if (mysqli_query($con, $Query_ins)) {
		$location = 'ABM_preguntasFrecuentes.php?Validation=Se '.$accion_desc.' la pregunta frecuente con exito.';
		mysqli_close($con);
		header_redirect($location, true, 303);

	} else {
		$InsError = "Ocurrió un error. <br/> Error: " . $Query_ins . "<br/>" . mysqli_error($con);
		$location = 'ABM_preguntasFrecuentes.php?Validation='.$InsError;
		mysqli_close($con);		
		header_redirect($location, true, 303);	
	}
}	

//Edit y Delete
//echo "id: ". isset($_REQUEST['id']);
//echo "action: ".isset($_REQUEST['action']);
//die();
if (isset($_REQUEST['id']) && isset($_REQUEST['action'])) {
	$id = $_REQUEST['id'];
	$action = $_REQUEST['action'];
	switch($_REQUEST['action'])
		{
			case 'edit':
				$query  = "select * from unaj.preguntas_frecuentes where id=".$id;
				//echo $query;
				//die();
				$result = mysqli_query($con, $query);				
				if (mysqli_affected_rows($con) != 0) {
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					$desc_input = $row['Desc'];				
				}				
				break;

			case 'delete':			
				$Query_del= "UPDATE unaj.preguntas_frecuentes SET activo = 0 WHERE id =".$id;
				if (mysqli_query($con, $Query_del)) {
					$location = 'ABM_preguntasFrecuentes.php?Validation=Se eliminó la pregunta frecuente con exito.';
					mysqli_close($con);
					header_redirect($location, true, 303);

				} else {
					$InsError = "No se pudo eliminar la pregunta frecuente. <br/> Error: " . $Query_del . "<br/>" . mysqli_error($con);
					$location = 'ABM_preguntasFrecuentes.php?Validation='.$InsError;
					mysqli_close($con);		
					header_redirect($location, true, 303);	
				}
				break;
		}		

	//echo "Query_ins: ". $Query_ins;
	//die();
		
}else{
$id="";
$action="";	
}	
//echo "id: ". $id;
//echo "action: ".$action;
//die();
?>
    <body class="page-body  page-fade">

    	<div class="page-container">	
	
		<div class="sidebar-menu">
	
			<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="index.php">
					<img src="../img/UNAJ.JPG" width="100%" height="100%" alt="UNAJ" />
				</a>
			</div>
			
					<!-- logo collapse icon -->
					<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
			</div>
							
			
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>
			
			</header>
    		<?php include('../include/nav.php'); ?>
    	</div>

    		<div class="main-content">
		
				<div class="row">
					
					<!-- Profile Info and Notifications -->
					<div class="col-md-6 col-sm-8 clearfix">	
							
					</div>
					
					
					<!-- Raw Links -->
					<div class="col-md-6 col-sm-4 clearfix hidden-xs">
						
						<ul class="list-inline links-list pull-right">

							<li>Bienvenido <?php echo $_SESSION['username']; ?> 
							</li>								
						
							<li>
								<a href="../logout.php">
									Cerrar Sesión<i class="entypo-logout right"></i>
								</a>
							</li>
						</ul>
						
					</div>
					
				</div>

		<h4>UNAJ</h4>
		<h3>Preguntas Frecuentes</h3>
		<hr />
		<h4>Preguntas Frecuentes <span class="error"><?php echo $Validation; ?></span></h4>
		<hr />		
		<form action="ABM_preguntasFrecuentes.php" method="POST" class="form-horizontal form-groups-bordered">
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Descripción:</label>					
					<div class="col-sm-5">
						<input type="text" name="desc" id="desc" class="form-control" data-rule-minlength="4" placeholder="Ingrese nombre" maxlength="30" value="<?php echo $desc_input; ?>" required/>
					</div>
			</div>

			<div class="form-group">		
					<div class="col-sm-offset-3 col-sm-5">
						<button type="submit" class="btn btn-primary">Guardar Cambios</button>	
						<input type="hidden" name="edit_hidden" id="edit_hidden" value="<?php echo $action; ?>" />
						<input type="hidden" name="id_hidden" id="id_hidden" value="<?php echo $id; ?>" />
					</div>
			</div>				
		
		</form>
		<br/><br/><br/>
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>ID</th>
					<th>Descripción</th>
					<th>Activo</th>
					<th>Acción</th>
				</tr>
			</thead>
				<tbody>

						<?php
							$query  = "select * from unaj.preguntas_frecuentes";
							//echo $query;
							//die();
							// $result = mysqli_query($con, $query);
							$result =parent::query($query);
							
							// if (mysqli_affected_rows($con) != 0) {
							    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							        $msgid   = $row['id_pregunta'];
							                							                							                
									//$expiry        = (!isset($row1['expiry']) || is_null($row1['expiry'])) ? ' ' : $row1['expiry'];
									//$sub_type_name = (!isset($row1['sub_type_name']) || is_null($row1['sub_type_name'])) ? ' ' : $row1['sub_type_name'];									
									//La fecha de expiracion habria que calcularla en realidad con la fecha de ultimo pago del socio.
									//$expiry = date('Y-m-d', strtotime("+1 months", strtotime($row['cdate'])));
									$activo = ($row['activo'] == 1) ? 'SI' : 'NO';
									//$img = imgPic($row['UserPicProfile'], "", "", "");
									
									echo "<tr>";																														
									echo "<td>" . $msgid . "</td>";
									echo "<td>" . $row['pregunta'] . "</td>";
									echo "<td>" . $activo . "</td>";
																		
									echo "<td>";
									echo"	<a href='ABM_preguntasFrecuentes.php?action=edit&id=" . $msgid . "' class='btn btn-primary btn-blue a-btn-slide-text'>";
									echo"		<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>";
									echo"		<span><strong>Edit</strong></span>";            
									echo"	</a>";
																				
									echo"	<a href='ABM_preguntasFrecuentes.php?action=delete&id=" . $msgid . "' class='btn btn-primary btn-red a-btn-slide-text'>";
									echo"		<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";
									echo"		<span><strong>Delete</strong></span>";            
									echo"	</a>";									
									echo"</td>";
									echo"</tr>";
											
							    }
							// }
						}
					}
					$foo = new Incidencias();
					$foo->TraerPreguntas();	
					// parent::cerrar();		
						?>									
					</tbody>
				</table>

		<script type="text/javascript">
			jQuery(document).ready(function($)
			{
				$("#table-1").dataTable({
					"sPaginationType": "bootstrap",
					"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"bStateSave": true
				});
				
				$(".dataTables_wrapper select").select2({
					minimumResultsForSearch: -1
				});
			});
		</script>

			<?php include('../include/footer.php'); ?>
    	</div>
		
    <script src="../neon/js/gsap/main-gsap.js" id="script-resource-1"></script>
    <script src="../neon/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
    <script src="../neon/js/bootstrap.min.js" id="script-resource-3"></script>
    <script src="../neon/js/joinable.js" id="script-resource-4"></script>
    <script src="../neon/js/resizeable.js" id="script-resource-5"></script>
    <script src="../neon/js/neon-api.js" id="script-resource-6"></script>
    <script src="../neon/js/jquery.validate.min.js" id="script-resource-7"></script>
    <script src="../neon/js/neon-login.js" id="script-resource-8"></script>
    <script src="../neon/js/neon-custom.js" id="script-resource-9"></script>
    <script src="../neon/js/neon-demo.js" id="script-resource-10"></script>

	<link rel="stylesheet" href="../neon/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="../neon/js/select2/select2.css"  id="style-resource-2">

	<script src="../neon/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="../neon/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="../neon/js/select2/select2.min.js" id="script-resource-9"></script>

    </body>
</html>






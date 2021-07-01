<?php
// page_protect();
session_start();
include('../include/functions.php');
// require_once('conexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Unaj</title>
    <link rel="stylesheet" href="../neon/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
    <link rel="stylesheet" href="../neon/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
    <link rel="stylesheet" href="../neon/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
    <link rel="stylesheet" href="../neon/css/neon.css"  id="style-resource-5">
    <link rel="stylesheet" href="../neon/css/custom.css"  id="style-resource-6">

	<!-- Estilos span error y modal -->
	<style>
		.error {color: #FF0000;}

		.modal-backdrop {
			display: none;
			z-index: 1040 !important;
		}
		.modal-content {
			margin: 2px auto;
			z-index: 1100 !important;
		}
	</style>	

    <!-- Theme framework -->
	<script src="../js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="../js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="../js/demonstration.min.js"></script>

    <!-- script src="../neon/js/jquery-1.10.2.min.js"></script -->

	<script src="../js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.spinner.js"></script>
	<script src="../js/plugins/jquery-ui/jquery.ui.slider.js"></script>
        
	<!-- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" -->


	<!-- js form -->
	<!-- script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script -->
	<!-- script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script -->	
	<!-- exportacion a excel -->
	<!-- script src="https://cdn.rawgit.com/unconditional/jquery-table2excel/master/src/jquery.table2excel.js"></script -->	

	<script>
		$(document).ready(function(){
			$("form").submit(function(event){
				event.preventDefault();
  				//alert("Submitted");
				var formData = {
				"id": document.getElementById("id_hidden").value, 
				"tipo" : document.getElementById("Tipo_id").value, 
				"desc" : document.getElementById("desc").value,
				"orden": document.getElementById("orden_aparicion").value,
				"activo": document.getElementById("activo").value,
				"action": document.getElementById("action_hidden").value
				};
				var formAction = document.getElementById("formAction_hidden").value;
				abm_ajax(formAction, formData);
			});
			
			function abm_ajax(formAction, formData)
			{
				//alert('formAction: ' + formAction);
				//alert('formData: ' + JSON.stringify(formData));
				$.ajax({
				url: ''+formAction+'',
				method:"POST",  
				data : formData, 
				success:function(response)
				{	
					//alert('success');
					response = JSON.parse(response);
					//alert('response:'+response);
					//alert('response.stack: '+ response.stack);
					//alert('response.key: '+ response.key);					                
                	//Open the modal                	
					$("#modalBody").html(response.stack);
					$("#myModal2").modal("show");
					//Recargo el dataGrid:
					dataGridLoad();
				},
				error: function(error) {
					alert('error');
					alert('error: '+error);
				}
				});
			}
			
		});

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
	</script>
	<!-- Fin js form -->

</head>

    <body class="page-body  page-fade">
		<div class="row">
			<h3>Preguntas Frecuentes <span class="error"></span></h3>
		</div>
		<hr />		
		<form action="" class="form-horizontal form-groups-bordered">
			<div class="form-group">
				<div class="row">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Tipo:</label>					
						<div class="col-sm-5">
							<input type="number" name="tipo" id="Tipo_id" class="form-control" data-rule-minlength="1" placeholder="Ingrese el tipo" maxlength="2" value="<?php echo $Tipo_id; ?>" required/>
						</div>
				</div>
				<br/>
				<div class="row">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Descripción:</label>					
						<div class="col-sm-5">
							<input type="text" name="desc" id="desc" class="form-control" data-rule-minlength="4" placeholder="Ingrese descripcion de la pregunta" maxlength="30" value="<?php  ?>" required/>
						</div>
				</div>
				<br/>
				<div class="row">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Orden:</label>					
						<div class="col-sm-5">
							<input type="number" name="orden" id="orden_aparicion" class="form-control" data-rule-minlength="1" placeholder="Ingrese el orden de aparicion" maxlength="2" value="<?php  ?>" required/>
						</div>
				</div>
				<br/>
				<div class="row">
					<label for="field-1" class="col-sm-3 control-label"><span class="error"></span> Activo:</label>					
						<div class="col-sm-5">
							<input type="number" name="activo" id="activo" class="form-control" data-rule-minlength="1" placeholder="Ingrese status, 1=Activo / 0=Inactivo" maxlength="1" value="<?php echo $Activo; ?>" required/>
						</div>
				</div>							
			</div>

			<div class="form-group">		
				<div class="col-sm-offset-3 col-sm-5">
					<button type="submit" id="guardar" name="guardar" class="btn btn-primary btn-blue" >Guardar</button>	
					<input type="hidden" name="action_hidden" id="action_hidden" value="insert" />
					<input type="hidden" name="id_hidden" id="id_hidden" value="" />
					<input type="hidden" name="formAction_hidden" id="formAction_hidden" value="model/ABM_preguntasFrecuentes.php" />
				</div>
			</div>				
		
		</form>			
		<br/><br/>
		        <!-- AJAX content -->
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12">					
							<div id="loaderPF" class="text-center"><b>Loading...</b>&nbsp;&nbsp;&nbsp;<img src="img/loader.gif"></div>
							<!-- AJAX -->
							<div id="aContent"></div>
							<!-- END AJAX -->
						</div>
					</div>
				</div>
				<!-- END AJAX content -->
		<br/>

		<script>
			$(document).ready(function(){
				dataGridLoad();
			});
			function dataGridLoad(){									
				$.ajax({
				url : 'model/dataGrid_preguntasFrecuentes.php',
				type:'POST',					
				beforeSend:function(objeto){
					$("#aContent").fadeOut();
					$("#loaderPF").fadeIn();
				},
				success:function(data){					
					$("#loaderPF").fadeOut();
					$("#aContent").html(data).fadeIn();

					$("#table-1").dataTable({
						"sPaginationType": "bootstrap",
						"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
						"bStateSave": true
					});                
					$(".dataTables_wrapper select").select2({
						minimumResultsForSearch: -1
					});
					
				}
				});
			}
		</script>


<script src="../neon/js/gsap/main-gsap.js" id="script-resource-1"></script>
<script src="../neon/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
<script src="../neon/js/bootstrap.min.js" id="script-resource-3"></script>
<script src="../neon/js/joinable.js" id="script-resource-4"></script>
<script src="../neon/js/resizeable.js" id="script-resource-5"></script>
<!-- este rompe todo: -->
<script src="../neon/js/neon-api.js" id="script-resource-6"></script>
<script src="../neon/js/jquery.validate.min.js" id="script-resource-7"></script>
<script src="../neon/js/neon-login.js" id="script-resource-8"></script>
<script src="../neon/js/neon-custom.js" id="script-resource-9"></script>
<script src="../neon/js/neon-demo.js" id="script-resource-10"></script>
<!-- Agregado por filtro, resultados, paginador tabla -->
<link rel="stylesheet" href="../neon/js/select2/select2-bootstrap.css"  id="style-resource-1">
<link rel="stylesheet" href="../neon/js/select2/select2.css"  id="style-resource-2">
<script src="../neon/js/jquery.dataTables.min.js" id="script-resource-7"></script>
<script src="../neon/js/dataTables.bootstrap.js" id="script-resource-8"></script>
<script src="../neon/js/select2/select2.min.js" id="script-resource-9"></script>
<!-- Fin Agregado por filtro, resultados, paginador tabla -->

    </body>
	<!-- Ajax Modal -->
	<div id="myModal2" class="modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modalBody">
				<p>Modal body text goes here.</p>
			</div>
			<div class="modal-footer">				
				<button type="button" class="btn btn-primary btn-blue" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
	</div>

</html>
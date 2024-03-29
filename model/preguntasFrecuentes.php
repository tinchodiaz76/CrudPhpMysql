﻿        
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
/*05/10/2021				
				"tipo" : 1, /*document.getElementById("Tipo_id").value, 
05/10/2021*/
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
                	//Paso la respuesta al modal: 
					$("#modalTitle").html('UNAJ | Preguntas Frecuentes');               	
					$("#modalBody").html('<b>'+response.stack+'</b>');
					//Muestro el modal:
					$("#myModal2").modal("show");
					//limpio form:
					abmClear();
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

		//funciones fuera del document.ready:
		function modal_ok()
		{
			//alert('modal_ok');
			var formData = {
			"id": document.getElementById("id_hidden").value, 
			"tipo" : '', 
			"desc" : '',
			"orden": '',
			"activo": '',
			"action": document.getElementById("action_hidden").value
			};
			var formAction = document.getElementById("formAction_hidden").value;
			abm_ajax2(formAction, formData);
			//cierro modal:
			$('#actdel').modal('hide');
			//blanqueo inicializo form:
			abmClear();
		}

		function abm_ajax2(formAction, formData)
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
				//Paso la respuesta al modal: 
				$("#modalTitle").html('UNAJ | Preguntas Frecuentes');               	
				$("#modalBody").html('<b>'+response.stack+'</b>');
				//Muestro el modal:
				$("#myModal2").modal("show");
				//limpio form:
				abmClear();
				//Recargo el dataGrid:
				dataGridLoad();
			},
			error: function(error) {
				alert('error');
				alert('error: '+error);
			}
			});
		}

		function abmClear(){
			document.getElementById("id_hidden").value = ''; 
/*05/10/2021
			document.getElementById("Tipo_id").value = ''; 
05/10/2021*/
			document.getElementById("desc").value = ''; 
			document.getElementById("orden_aparicion").value = ''; 
			document.getElementById("activo").value = ''; 
			document.getElementById("action_hidden").value = 'insert'; 
			document.getElementById("guardar").innerHTML = 'Guardar';
		}

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

		<form action="" class="form-horizontal form-groups-bordered">
			<div class="row">
				<h3 style="margin-left: 20px;">Preguntas Frecuentes <span class="error"></span>
					<button class="btn btn-primary btn-green align-right" style="margin-left: 10px;" onclick="abmClear();">
						<i class="glyphicon glyphicon-plus"></i> 
						<strong>Nueva</strong>
					</button>
				</h3>
			</div>
			<hr />
			<div class="form-group">
<!--05/10/2021
				<div class="row">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Tipo:</label>					
						<div class="col-sm-5">
							<input type="number" name="tipo" id="Tipo_id" class="form-control" data-rule-minlength="1" placeholder="Ingrese el tipo" maxlength="1" value="<?php echo $Tipo_id; ?>" required/>
						</div>
				</div>
				<br/>
/*05/10/2021-->
				<div class="row">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Descripción:</label>					
						<div class="col-sm-5">
							<input type="text" name="desc" id="desc" class="form-control" data-rule-minlength="4" placeholder="Ingrese descripcion de la pregunta" maxlength="3000" value="<?php  ?>" required/>
						</div>
				</div>
				<br/>
				<div class="row">
					<label for="field-1" class="col-sm-3 control-label"><span class="error">*</span> Orden:</label>					
						<div class="col-sm-5">
							<input type="number" name="orden" id="orden_aparicion" class="form-control" data-rule-minlength="1" placeholder="Ingrese el orden de aparicion" maxlength="3" value="<?php  ?>" required/>
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

		<!-- Trae el dataGrid de preguntas frecuentes -->
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
				}
				});
			}
		</script>
    
	<!-- Ajax Modal para informar status de exito de las operaciones -->
	<div id="myModal2" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header btn-blue">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>				
					<h5 class="modal-title" style="color: white; font-weight: bolder;" id="modalTitle">Modal title</h5>
				</div>
				<div class="modal-body" style="color: black; font-weight: bolder;" id="modalBody">
					<p><b>Modal body text goes here.</b></p>
				</div>
				<div class="modal-footer" style="padding:10px 10px;">				
					<button type="button" class="btn btn-primary btn-blue" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal boton delete -->
	<div id="actdel" class="modal fade" tabindex="-1" role="dialog" >
		<div class="modal-dialog" role="document" >
			<div class="modal-content" style="border-radius: 10px; border:black 1px solid;">
				<div class="modal-header btn-blue" style="border-radius: 10px 10px 0px 0px;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title" style="color: white; font-weight: bolder;" id="modalTitle2">Modal title</h5>
				</div>
				<div class="modal-body" style="color: black; font-weight: bolder; border-radius: 10px;" id="modalBody2">
					<p>Modal body text goes here.</p>
				</div>
				<div class="modal-footer" style="padding:10px 10px;">				
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary btn-blue" onclick="return modal_ok()">OK</button>
				</div>
			</div>
		</div>
	</div>


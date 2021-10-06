<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
// page_protect();
include('../include/db_conn.php');
include('../include/functions.php');

if (isset($_GET['area_id']))
{
  $area_id= $_GET['area_id'];	
}
else
{
  $area_id= 1;
}
?>
<!-- IMPORTANTE: Para que las funcionalidades de filtro, paginador, orden, etc de la table funcionen tiene que estar contenido en un div -->
<!-- div -->


		<!-- data grid -->
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>ID</th>
					<th>Area_id</th>
					<!-- th>Tipo incidencia</th -->
					<th>Descripción</th>
                    <th>Resolución</th>
                    <th>Información adicional</th>					
					<th>Activo</th>
					<th>Acción</th>
                    <!-- th>
                        <a onclick="ResultsToTable();" class="btn btn-primary btn-green a-btn-slide-text">
                            <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                            <span><strong>Excel</strong></span>            
                        </a>  
                    </th -->
				</tr>                
			</thead>
			<tbody>

						<?php
							$query  = "select * from unaj.resoluciones_incidencias where area_id=".$area_id;
							//echo $query;
							//die();
							$result = mysqli_query($con, $query);
							
							// if (mysqli_affected_rows($con) != 0) {
							    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							        $msgid   = $row['id'];
							                							                							                
									$activo = ($row['estado'] == 0) ? 'SI' : 'NO';	
									$infoAdic = ($row['informacion_adicional'] == 1) ? 'SI' : 'NO';					
									
									echo "<tr id='" . $msgid . "'>";																														
									echo "<td class=\"row-data\">" . $msgid . "</td>";
									echo "<td class=\"row-data\">" . $row['area_id'] . "</td>";
									//echo "<td class=\"row-data\">" . $row['tipo_id'] . "</td>";									
									echo "<td class=\"row-data\">" . $row['descripcion'] . "</td>";
                                    echo "<td class=\"row-data\">" . $row['resolucion'] . "</td>";
									echo "<td class=\"row-data\">" . $infoAdic . "</td>";
									echo "<td class=\"row-data\">" . $activo . "</td>";
																		
									echo "<td>";                                    
									echo"	<a onclick=\"abm(" . $msgid . ",'edit');\" class='btn btn-primary btn-blue a-btn-slide-text'>";
									echo"		<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>";
									echo"		<span><strong>Edit</strong></span>";            
									echo"	</a>";
									if ($row['estado'] == 0){											
                                        echo"	<a onclick=\"abm2(" . $msgid . ",'delete');\" class='btn btn-primary btn-red a-btn-slide-text'>";
                                        echo"		<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";
                                        echo"		<span><strong>Delete</strong></span>";            
                                        echo"	</a>";	
                                    } else {
                                        echo"	<a onclick=\"abm2(" . $msgid . ",'activar');\" class='btn btn-primary btn-green a-btn-slide-text'>";
                                        echo"		<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";
                                        echo"		<span><strong>Activar</strong></span>";            
                                        echo"	</a>";	
                                    }        
									echo"</td>";
									//echo "<td></td>"; //excel
									echo"</tr>";											
							    }		
					?>	
			</tbody>
		</table>

			<script type="text/javascript">
				//Funcionalidad botones abm:
				function abm(rowId, action){				
					//alert('rowId: '+rowId);
					//alert('action: '+action);
					//alert('formAction: '+document.getElementById("formAction_hidden").value);
					document.getElementById("guardar").innerHTML = 'Modificar'; 
					//change values in form with row data:
					var data = document.getElementById(rowId).querySelectorAll(".row-data");                 
					/*returns array of all elements with "row-data" class within the row with given id*/              
					document.getElementById("id_hidden").value = data[0].innerHTML; 
					//document.getElementById("tipo_id").value = data[1].innerHTML; 					
					document.getElementById("area_id").value = data[1].innerHTML; 
					document.getElementById("desc").value = data[2].innerHTML;
					document.getElementById("resolucion").value = data[3].innerHTML;
					var infoAd = ((data[4].innerHTML == 'SI') ? 1 : 0);
					document.getElementById("infoad").value = infoAd;
					var activo = ((data[5].innerHTML == 'SI') ? 0 : 1);
					document.getElementById("activo").value = activo;               
					document.getElementById("id_hidden").value = rowId;
					document.getElementById("action_hidden").value = action;                
				}

				function abm2(rowId, action){	
					switch (action) {
						case 'delete':
							var q_desc = 'Esta seguro que quiere borrar la resolucion automatica '+rowId+' ?';
							break;					
						case 'activar':
							var q_desc = 'Esta seguro que quiere activar la resolucion automatica '+rowId+' ?';
							break;
					}	
					//change input hiddens values:                
					document.getElementById("id_hidden").value = rowId;
					document.getElementById("action_hidden").value = action;		
                	//Paso la respuesta al modal: 
					$("#modalTitle2").html('UNAJ | Resoluciones Automaticas');               	
					$("#modalBody2").html(q_desc);
					//Muestro el modal:
					$("#actdel").modal("show");
					//Recargo el dataGrid:
					//dataGridLoad();                
				}

				//Exportacion a excel
				function ResultsToTable(){
					$("#table-1").table2excel({
						exclude: ".noExl", //this class data should not be excluded in excel
						filename: "RespuestasFrecuentes"
					});
				}
				function ResultsToTable2(){            
					$("#table-1").tableExport({
						formats: ["xlsx","txt", "csv"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
						position: 'top',  // Posicion que se muestran los botones puedes ser: (top, bottom)
						bootstrap: true, //Usar lo estilos de css de bootstrap para los botones (true, false)
						fileName: "RespuestasFrecuentes",    //Nombre del archivo 
					});
				}
			</script>

		<script type="text/javascript">
		
			$(document).ready(function()
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

<!-- /div -->

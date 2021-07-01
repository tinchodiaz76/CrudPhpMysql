<?php
include('../include/db_conn.php');
//page_protect();
//Include functions file
include('../include/functions.php');
?>
<div>

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



		<h2>Socios adeudan mes actual</h2>

		<hr />
		
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>Profile Image</th>
					<th>ID Miembro / DNI</th>
					<th>Nombre y Apellido</th>
					<th>Direccion / Contacto</th>
					<th>Correo Electronico/ Edad / Sexo</th>
					<th>Accion</th>
				</tr>
			</thead>

			<tbody>
				<?php

					$query  = "select * from unaj.preguntas_frecuentes";
					//echo $query;
					$result = mysqli_query($con, $query);

					//if (mysqli_affected_rows($con) != 0) {
					    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					        $msgid   = $row['id_pregunta'];       
							$sexo = ($row['activo'] == 1) ? 'Hombre' : 'Mujer';
							// $img = imgPic($row['UserPicProfile'], "40", "40", "");					                
							echo "<tr>";																										
							echo "<td><div><!-- user Profile Pic -->";
							//echo $img;						
							echo "</div></td>";
							echo "<td>" . $row['Tipo_id'] . "</td>";
							echo "<td>" . $row['pregunta'] . "</td>";
							echo "<td>" . $row['orden_aparicion'] . "</td>";
							echo "<td>" . $sexo . "</td>";
							
							echo "<td>";
							echo"	<a href='ABM_payments.php?id=" . $msgid . "' class='btn btn-primary btn-blue a-btn-slide-text'>";
							echo"		<span class='glyphicon glyphicon-usd' aria-hidden='true'></span>";
							echo"		<span><strong>Add Payment</strong></span>";            
							echo"	</a>";
							echo "</td>";							
							echo "</tr>";
							$msgid = 0;
					    }
					//}

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
			
</div>





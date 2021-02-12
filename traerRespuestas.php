<?php 
			session_start();
			if (isset($_SESSION["user"])){
				$v_user= $_SESSION["user"];
				/*Recupero el nombre del usuario que esta loggeado*/

				include('abre_conexion.php');

				$v_tipo_id= $_GET["tipo_id"];
				$v_id_pregunta= $_GET["id_pregunta"];

				$query =  "select respuesta
							from ywayqssx_MA.respuestas_frecuentes
							where tipo_id= ' $v_tipo_id'
							and id_pregunta= ' $v_id_pregunta'
							order by orden_aparicion asc";
				
							/*Con estado=0 levanta las incidencias pendientes*/
							
							mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

							$resEmp = mysqli_query($conexion,$query);

							while($row = mysqli_fetch_array($resEmp)){
							//echo json_encode($row); 
					
							$respuesta= $row['respuesta'];

					
							$incidencias[] = array('respuesta'=> $respuesta);
				}
				
				if (!empty($incidencias)) 
				{
					mysqli_free_result($resEmp);
					include('cerrar_conexion.php');
					//Creamos el JSON
					$json_string = json_encode($incidencias);
					echo $json_string;
				}
				else {
						$incidencias = [];

						mysqli_free_result($resEmp);
						include('cerrar_conexion.php');
						$json_string = json_encode($incidencias);
						echo $json_string;

				}			
			}
			else {
				echo "Su cesion ha expirado!!!. Vuelva a loguearse!!!";
				echo "<p><a href='index.html'> Volver al formulario</a></p>";
			}
?>
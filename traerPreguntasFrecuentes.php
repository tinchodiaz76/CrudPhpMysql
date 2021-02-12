<?php 
			session_start();
			if (isset($_SESSION["user"])){
				$v_user= $_SESSION["user"];
				/*Recupero el nombre del usuario que esta loggeado*/
				
				include('abre_conexion.php');
				
				$query =  "select tipo_id, id_pregunta,pregunta
							from ywayqssx_MA.preguntas_frecuentes
							where tipo_id=1
							order by orden_aparicion asc";
				
							/*Con estado=0 levanta las preguntas*/
							
							mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

							$resEmp = mysqli_query($conexion,$query);

							while($row = mysqli_fetch_array($resEmp)){
							//echo json_encode($row); 
					
							$tipo_id= $row['tipo_id'];
							$id_pregunta=$row['id_pregunta'];
							$pregunta=$row['pregunta'];
					
							$incidencias[] = array('tipo_id'=> $tipo_id, 'id_pregunta'=>$id_pregunta,
							'pregunta'=> $pregunta
						);
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
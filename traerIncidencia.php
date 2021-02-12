<?php 
    // Arrays para guardar mensajes y errores:
    $aErrores = array();
    $aMensajes = array();
    
                // Comprobar si llegaron los campos requeridos:
                if( isset($_POST['inc_id']) )
                {
                    // apellido
                    if( empty($_POST['inc_id']) )
                    {
                        $aErrores[] = "El ID de la incidencia no puede ser nulo";
                    }

                    // Si han habido errores se muestran, sino se mostrán los mensajes
                    if( count($aErrores) > 0 )
                    {
                        echo "<p>ERRORES ENCONTRADOS:</p>";


                        // Mostrar los errores:
                        for( $contador=0; $contador < count($aErrores); $contador++ ) 
                            {
                            echo $aErrores[$contador]."<br/>";

                            }
                            echo "<p><a href='verIncidencias.html'> Volver al formulario</a></p>";
                        }


                    else                    
                    {
                        
                        $v_inc_id= $_POST["inc_id"];

                        include('abre_conexion.php');

                        $query =  "select inc.id, inc.tipo_incidencia,tip.descrip_inciden,
                        inc.descrip_incidencia usuario_descripcion,
                        concat(inc.nombre,' ', inc.apellido) usuario,
                        replace(tip.texto_resolucion,'XXX',concat(inc.nombre,' ', inc.apellido)) texto_resolucion,
                        inc.email
                        from ywayqssx_MA.incidencias inc, ywayqssx_MA.tipinciden tip
                        where id= '$v_inc_id'
                        and tip.tipo_incidencia= inc.tipo_incidencia
                        and estado= 0";

                        /*Con estado=0 levanta las incidencias pendientes*/

                        mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

                        $resEmp = mysqli_query($conexion,$query);

                        while($row = mysqli_fetch_array($resEmp)){
                            //echo json_encode($row); 
                            $id=$row['id'];
                            $tipo_incidencia=$row['tipo_incidencia'];
                            $descrip_inciden=$row['descrip_inciden'];
                            $usuario_descripcion=$row['usuario_descripcion'];
                            $usuario=$row['usuario'];
                            $texto_resolucion=$row['texto_resolucion'];
                            $email=$row['email'];

                            $incidencia[] = array('id'=> $id, 'tipo_incidencia'=> $tipo_incidencia, 'descrip_inciden'=> $descrip_inciden, 'usuario_descripcion'=> $usuario_descripcion,
                                'usuario'=> $usuario,'texto_resolucion'=>$texto_resolucion,'email'=>$email);
                        }

                        if (!empty($incidencia)) 
                        {
                            mysqli_free_result($resEmp);
                            include('cerrar_conexion.php');
                            //Creamos el JSON
                            $json_string = json_encode($incidencia);
                            echo $json_string;
                        }
                        else {
                                $incidencia = [];
            
                                mysqli_free_result($resEmp);
                                include('cerrar_conexion.php');
                                $json_string = json_encode($incidencia);
                                echo $json_string;
            
                        }	
                    }
                }
                else
                {
                    echo "Error faltan parametros";
                    echo "<p><a href='index.html'> Volver al formulario</a></p>";
                }
?>

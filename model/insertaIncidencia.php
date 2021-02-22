<?php
    // Arrays para guardar mensajes y errores:
	$aErrores = array();
	$aMensajes = array();

    // Patrón para usar en expresiones regulares (admite letras acentuadas y espacios):
    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
    
                // Comprobar si llegaron los campos requeridos:
                if( isset($_POST['email']) && isset($_POST['apellido']) && isset($_POST['nombre'])  && isset($_POST['dni']) && isset($_POST['telefono']) )
                {

                    // apellido
			        if( empty($_POST['apellido']) )
                        $aErrores[] = "Debe especificar el Apellido";
                    else
                    {
                        // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                        if( preg_match($patron_texto, $_POST['apellido']) )
                            $aMensajes[] = "Apellido: [".$_POST['apellido']."]";
                        else
                            $aErrores[] = "El Apellido sólo puede contener letras y espacios";
                    }

                    //nombre
                    if( empty($_POST['nombre']) )
                        $aErrores[] = "Debe especificar el Nombre";
                    else
                    {
                        // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                        if( preg_match($patron_texto, $_POST['nombre']) )
                            $aMensajes[] = "Nombre: [".$_POST['nombre']."]";
                        else
                            $aErrores[] = "El Nombre sólo puede contener letras y espacios";
                    }

                    	// DNI:
                    if(empty($_POST['dni']) )
                        $aErrores[] = "Debe especificar el dni";
                    else
                    {
                        if( is_numeric($_POST['dni']) )
                            $aMensajes[] ="dni: [".$_POST['dni']."]";
                        else
                            $aErrores[] = "El DNI debe contener solo números.";
                    }
            
                    // TELEFONO:
                    if(empty($_POST['telefono']) )
                        $aErrores[] = "Debe especificar el telefono";
                    else
                    {
                        if( is_numeric($_POST['telefono']) )
                            $aMensajes[] ="telefono: [".$_POST['telefono']."]";
                        else
                            $aErrores[] = "El Telefono debe contener solo números.";
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
                            echo "<p><a href='cargaIncidencia.html'> Volver al formulario</a></p>";
                    }
                    else                    
                    {

                        include('abre_conexion.php'); 
                            
                        $query ="insert into ywayqssx_MA.incidencias (email,apellido,nombre,dni,
                        telefono,tipo_incidencia, 
                        descrip_incidencia,estado,fecha_creacion) 
                        values ('$_REQUEST[email]',upper('$_REQUEST[apellido]'),upper('$_REQUEST[nombre]'),'$_REQUEST[dni]',
                        '$_REQUEST[telefono]','$_REQUEST[exampleRadios]',
                        '$_REQUEST[validationTextarea]',0,curdate())";
                
                        $resEmp = mysqli_query($conexion,$query);
        
                        include('cerrar_conexion.php');

                        Header('Location: cargaIncidencia.html');
                    }
                }
                else
                {
                    echo "Error faltan parametros";
                    echo "<p><a href='cargaIncidencia.html'> Volver al formulario</a></p>";
                }
?>

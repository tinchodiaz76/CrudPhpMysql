<?php
    // Arrays para guardar mensajes y errores:
	$aErrores = array();
	$aMensajes = array();


	session_start();
	if (isset($_SESSION["user"]))
	{
	    $v_user= $_SESSION["user"];
	
	    // Comprobar si llegaron los campos requeridos:
        if( isset($_POST['inputResolucion']) &&  isset($_POST["inc_id"]))
        {

            // apellido
            if( empty($_POST['inputResolucion']))
            {
                $aErrores[] = "La Resolucion no puede estar vacia";
            }

            if( empty($_POST['inc_id']))
            {
                $aErrores[] = "El Id de la incidencia no puede ser vacio";
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
                $v_resolucion = $_POST["inputResolucion"];
                $v_id = $_POST["inc_id"];
                $email= $_POST["email"];
                            
                /*Recupero el nombre del usuario que esta loggeado*/
                include('abre_conexion.php'); 
                $query ="update ywayqssx_MA.incidencias 
                        set estado=1,
                        username= '$v_user',
                        fecha_cerrado= curdate(),
                        resolucion= '$v_resolucion'
                        where id= '$v_id'";

                $resEmp = mysqli_query($conexion,$query);
                $asunto= "Información de citepUba";
                $header= "From: info@lyseis.com.ar" . "\r\n";

                $email="mfdiaz76.job@gmail.com";
    
                $mail= @mail($email,$asunto,$v_resolucion,$header);
                                
                if ($mail){
                    echo "<h4>El mail se envio Coqui!</h4>";
                }
                else 
                {
                    echo "<h4>Error al enviar el mail!</h4>";
                }

            }    //include('cerrar_conexion.php');
        }        
        else
        {
            echo "Error faltan parametros";
            echo "<p><a href='verIncidencias.html'> Volver al formulario</a></p>";
        }
    }
    else
    {    
        echo "No se encuentar el usuario Logueado";
        echo "<p><a href='index.html'> Volver al formulario</a></p>";
            
    }
?>
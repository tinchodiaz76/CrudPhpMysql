<?php
	$aErrores = array();
	$aMensajes = array();
    
        // Comprobar si llegaron los campos requeridos:
        if( isset($_POST['usuario']) &&  isset($_POST['password']))
        {
             //nombre
            if( empty($_POST['usuario']))
            {
	
               	$aErrores[] = "El Usuario no puede ser nulo";
            }
            if( empty($_POST['password']))
            {
	
        	$aErrores[] = "El Password no puede ser nulo";
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
                            echo "<p><a href='index.html'> Volver al formulario</a></p>";
            }
            else                    
		    {

			    $v_usuario = $_POST['usuario'];
		        $v_password  = $_POST['password'];
                
			    include('abre_conexion.php'); 

			    $query ="select count(1) as cantidad from ywayqssx_MA.users where username= '$v_usuario' and password= '$v_password' ";
			
    			$resEmp = mysqli_query($conexion,$query);	

	    		$json_response = array(); 

	            while($row = mysqli_fetch_array($resEmp)){
        	            $v_cant= $row[0];
	        	}  
                
	            mysqli_free_result($resEmp);
            
                if ($v_cant=="0")
                {
?>
                    <script>
                        window.alert("Verifique el usuario y la clave");
                        location.href ="index.html";
                        //echo "<p><a href='login.html'> Volver al formulario</a></p>";                        
                    </script>
<?php                    
                }
        	    else 
                {
		                session_start();
                		$_SESSION["user"]  = $_REQUEST['usuario'];
		                header("Location: verIncidencias.html");
                }
	        }
	   }
?>
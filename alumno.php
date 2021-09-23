<!DOCTYPE html>
<html>
	<head>

	<meta http-equiv=�Content-Type� content=�text/html; charset=UTF-8? />
    <title>Login - Alumno</title>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Importamos los estilos de Bootstrap -->
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome: para los iconos -->
    <!-- link rel="stylesheet" href="css/font-awesome.min.css" -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <!-- Sweet Alert: alertas JavaScript presentables para el usuario (más bonitas que el alert) -->
    <link rel="stylesheet" href="css/sweetalert.css">
    <!-- Estilos personalizados: archivo personalizado 100% real no feik -->
    <link rel="stylesheet" href="css/style.css">

		<!--&aacute, le pone un acento en la A-->
		<!--&eacute, le pone un acento en la E-->
		<!--&iacute, le pone un acento en la I-->
		<!--&oacute, le pone un acento en la O-->
		<!--&uacute, le pone un acento en la U-->
		<!--&ntilde, le pone la letra Ñ-->

	</head>
<body>

    <div class="container">
     <div class="row">
       <div class="col-xs-12 col-md-4 col-md-offset-4">
         <!-- Margen superior (css personalizado )-->
         <div class="spacing-1"></div>
         
          <form>

               <!-- Estructura del formulario -->
              <fieldset>
        					<p class="center">Hola 
		  	      			<b>
			  			      	<?php 
			   				          session_start();

							            echo $_SESSION['nombres'] . ' ' . $_SESSION['apellido'];
							        ?>
						        </b>
					        </p> 

                  <!-- Caja de texto para usuario -->
                  <label class="sr-only" for="user">Usuario</label>
                  <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
                  <input type="text" class="form-control" id="usuario"  placeholder="Ingresa tu usuario" 
                    value=<?php
                            echo $_SESSION['nro_documento'];
                          ?>
                  >
                  </div>

                  <!-- Div espaciador -->
                  <div class="spacing-2"></div>

                  <!-- Caja de texto para la clave-->
                  <label class="sr-only" for="clave">Contraseña</label>
                  <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                      <input type="password" autocomplete="off" class="form-control" id="password" name="password" placeholder="Ingresa tu password">
                  </div>
                  
                  <!-- Animacion de load (solo sera visible cuando el cliente espere una respuesta del servidor )-->
              
                  <div class="row" id="load" hidden="hidden">

                  <div class="col-xs-12 center text-accent">
                        <span>Validando información...</span>
                  </div>
                  </div>

                  <!-- boton #login para activar la funcion click y enviar el los datos mediante ajax -->
                  <div class="row">
                        <div class="col-xs-8 col-xs-offset-2">
                        <div class="spacing-2"></div>
                        <button type="button" class="btn btn-primary btn-block" name="button" id="login">Iniciar sesion</button>
                        </div>
                  </div>

                  <br>
                  <br>              
              
                  <div id="Error" style="display:none;text-align:center">

                  </div>

                  <br>
                  <br>              
                  
                  <section class="text-accent center">
                    <div class="spacing-2"></div>
                    
                    <p>
                      No tienes una cuenta? <a href="registro.php"> Registrate!</a>
                    </p>
                  </section>
			        </fieldset>
          </form>   

       </div>
     </div>
   </div>

   <!--<script src="js/sweetalert.min.js"></script>-->
    <!-- Js personalizado -->
    <script src="js/consultarAlumno.js"></script>
</body>
</html>
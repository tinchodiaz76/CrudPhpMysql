<?php
// include '../../include/db_conn.php';
// page_protect();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>     
    <title>UNAJ | Incidencias </title>

	<!-- link rel="stylesheet" href="css/verIncidencias.css" -->
    <link rel="stylesheet" href="neon/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
    <link rel="stylesheet" href="neon/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
    <link rel="stylesheet" href="neon/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
    <link rel="stylesheet" href="neon/css/neon.css"  id="style-resource-5">
    <!-- link rel="stylesheet" href="neon/css/custom.css"  id="style-resource-6" -->
    <script src="neon/js/jquery-1.10.2.min.js"></script>

	<style>
		.error {color: #FF0000;}
	</style>	
    
	<meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sweetalert.css">
</head>
    <body class="page-body  page-fade">

    	<div class="page-container">	
	
		<div class="sidebar-menu">	
			<header class="logo-env">	
				<div class="row">
					<div class="col-xs-10 col-md-10 col-lg-10">		
						<!-- logo -->
						<div class="logo">
							<a href="index.php">					
								<img src="./img/UNAJ.JPG" width="100%" height="100%" alt="UNAJ" />
							</a>
						</div>
					</div>	
					<div class="col-xs-2 col-md-2 col-lg-2">
						<!-- logo collapse icon -->
						<div class="sidebar-collapse">
							<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
								<i class="entypo-menu"></i>
							</a>
						</div>
														
						<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
						<div class="sidebar-mobile-menu visible-xs">
							<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
								<i class="entypo-menu"></i>
							</a>
						</div>
					</div>	
				</div>		
			</header>
    		<?php include('include/nav.php'); ?>
    	</div>

    	<div class="main-content">
		
				<div class="row">
					
					<!-- Profile Info and Notifications -->
					<div class="col-md-6 col-sm-8 clearfix">	
						<h2 >Incidencias</h2>	
					</div>
					
					
					<!-- Raw Links -->
					<div class="col-md-6 col-sm-4 clearfix hidden-xs">
					
						<ul class="list-inline links-list pull-right">
							<li >Bienvenido <?php echo $_SESSION['username']; ?></li>											
							<li>
								<a href="logout.php">
								<button type="submit" class="btn btn-primary">Cerrar Sesión<i class="entypo-logout right"></i></button>
								</a>
							</li>
						</ul>
						
					</div>
					
				</div>
			
			<hr>

			<!-- Modal NOTAS DE INCIDENCIA-->
			<div class="modal fade" id="modalNotas" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">
								<!--<span aria-hidden="true">×</span>-->
								<span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">Grabar Notas</h4>
						</div>
						
						<!-- Modal Body -->
						<div class="modal-body">
							<p class="statusMsg"></p>
							<form role="form" id="notasIncidencia">
								<!--Aca va el dato de la ventana emergente-->
							</form>
						</div>

						<!-- Modal Footer -->
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerrarModalNotasIncidencias()">Cerrar</button>
							<button type="button" class="btn btn-primary" action="grabarNota.php" data-dismiss="modal"  onclick="return ValidaNota(this)">Grabar Nota</button>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Modal RESOLUCION DE INCIDENCIA-->
			<div class="modal fade" id="modalResolucionIncidencia" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">
								<!--<span aria-hidden="true">×</span>-->
								<span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">Resolver Incidencia</h4>
						</div>
						
						<!-- Modal Body -->
						<div class="modal-body">
							<p class="statusMsg"></p>
							<form role="form" id="resolverIncidencia">
								<!--Aca va el dato de la ventana emergente-->
							</form>
						</div>

						<!-- Modal Footer -->
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerrarModalResolverIncidencias()">Cerrar</button>
							<button type="button" class="btn btn-primary" action="resolverIncidencia.php" data-dismiss="modal"  onclick="return ValidaResolucion(this)">Grabar Resolucion</button>
						</div>
					</div>
				</div>
			</div>	

			<div class="container">
				<div class="row">
				<div class="col-sm-4">
					<!--<img width="300" src="image/logo-citep-transparete.png">-->
					<!--<img width="200" src="image/logo-unaj-2016.jpg">-->
				</div>			
				<!--<div class="col-md-6">-->
				<div class="row">
						<div class="col"> 
							<button class="btn btn-primary mt-5" onclick="location.href='reporteIncidencias.html'">Reportes</button>
						</div>
						<!-- div class="col">
							<form action="controller/cerrarSesion.php" method="post" >
								<button type="submit" class="btn btn-primary mt-5">Cerrar Sesión</button>
							</form>
						</div -->
				</div>
				<!--</div>-->
				<!--</div>-->
			</div>
			<br>  	
				
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12">
					<h2>Incidencias Pendientes:</h2>
					<div id="loader" class="text-center"><img src="img/loader.gif"></div>

					<!-- AJAX -->
					<div id="outer_div">

					</div>
					<!-- END AJAX -->

					</div>
				</div>
			</div>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
			<script>
				$(document).ready(function(){
					load(1);
				});
				function load(page){
					var parametros = {"action" : "ajax", "page" : page};
					$("#loader").fadeIn();
					$.ajax({
					url : 'model/traerIncidencias.php',
					type:'POST',
					data : parametros,
					beforeSend:function(objeto){
						$("#loader").fadeIn();
					},
					success:function(data){
						$("#loader").fadeOut();
						$("#outer_div").html(data).fadeIn();
					}
					});
				}
			</script>

		    <br>
		    <input type="text" id="incidencia_id">
		    <button id="ejecutarIDResolucion" >Obtener usuarios</button>        
		    <div id="lista-usuarios"></div>
		    <br>
		    <input type="text" id="nota_id">
		    <button id="ejecutarNota" >Obtener Notas</button>        
		    <div id="lista-usuarios"></div>

	

						
			<br/>
			<?php include('include/footer.php'); ?>
		</div>

		<script type="text/javascript">
                ejecutarIDResolucion.style.display = 'none';
                ejecutarNota.style.display ='none';
                incidencia_id.style.display = 'none';
                nota_id.style.display = 'none';

                function ValidaResolucion(){
                    if (document.getElementById('inputResolucion').value == ""){
                        window.alert('[ERROR] El campo Resolucion no puede estar vacio...');
                        return false;
                    }

                    GrabarResolucion();
                }

                function ValidaNota(){
                    if (document.getElementById('inputNota').value == ""){
                        window.alert('[ERROR] El campo Nota no puede estar vacio...');
                        return false;
                    }

                    GrabarNota();
                }


                function GrabarResolucion(){

                    var parametros= {
                        "inc_id" : $('#incidencia_id').val(),
                        "inputResolucion" : $('#inputResolucion').val(),
                        "email" : $('#email').val()
                    };
                    
                    $.ajax({
                        url: 'model/resolverIncidencia.php?resolucion='+  $('#inputResolucion').val() + '&id=' + $('#incidencia_id').val(),
                        type:'POST',
                        data: { "resolverIncidencias":"1"},
                        success: function(respuesta) {

                            window.alert("La incidencia ha sido resuelta.");

                            window.location="verIncidencias.php";
                        },
                        }).fail( function( jqXHR, textStatus, errorThrown ) {
                            if (jqXHR.status === 0) {
                                alert('Not connect: Verify Network.');
                            } else if (jqXHR.status == 404) {
                                alert('Requested page not found [404]');
                            } else if (jqXHR.status == 500) {
                                alert('Internal Server Error [500].');
                            } else if (textStatus === 'parsererror') {
                                alert('Requested JSON parse failed.');
                            } else if (textStatus === 'timeout') {
                                alert('Time out error.');
                            } else if (textStatus === 'abort') {
                                alert('Ajax request aborted.');
                            } else {
                                alert('Uncaught Error: ' + jqXHR.responseText);
                            }
                        });
                }

                
                function GrabarNota(){

                    var parametros= {
                        "inc_id" : $('#nota_id').val(),
                        "inputNota" : $('#inputNota').val()
                    };

                    $.ajax({
                        url: 'model/grabarNota.php?nota='+  $('#inputNota').val() + '&id=' + $('#nota_id').val(),
                        type:'POST',
                        data: { "grabarNotas":"1"},
                        success: function(respuesta) {

                            window.alert("Se grabo la nota en la Incidencia.");

                            window.location="verIncidencias.php";
                        },
                        }).fail( function( jqXHR, textStatus, errorThrown ) {
                            if (jqXHR.status === 0) {
                                alert('Not connect: Verify Network.');
                            } else if (jqXHR.status == 404) {
                                alert('Requested page not found [404]');
                            } else if (jqXHR.status == 500) {
                                alert('Internal Server Error [500].');
                            } else if (textStatus === 'parsererror') {
                                alert('Requested JSON parse failed.');
                            } else if (textStatus === 'timeout') {
                                alert('Time out error.');
                            } else if (textStatus === 'abort') {
                                alert('Ajax request aborted.');
                            } else {
                                alert('Uncaught Error: ' + jqXHR.responseText);
                            }
                        });
                    }

                function cerrarModalResolverIncidencias(){
                    console.log("cerrarModalResolverIncidencias");
                    var pedro  = document.getElementById("resolverIncidencia");
                    // Elimino todos los DIV'S que estan dentros de DATOS
                    while (pedro.firstChild) {
                        pedro.removeChild(pedro.firstChild);
                    }
                }

                function cerrarModalNotasIncidencias(){
                    console.log("cerrarModalNotasIncidencias");
                    var pedro  = document.getElementById("notasIncidencia");
                    // Elimino todos los DIV'S que estan dentros de DATOS
                    while (pedro.firstChild) {
                        pedro.removeChild(pedro.firstChild);
                    }
                }

                /*Esta funcion es llamada por cada click en el boton de la grilla, como parametro recibe el ID de la tabla Incidencias*/
                function obtengoIDResolucion(id) {
/*
                    console.log('id=' || id);
                    console.log('Tipo=' || tipo);
*/                    
                    cerrarModalResolverIncidencias();
                    document.getElementById('incidencia_id').value = id;    /*El id es el valor ID de la tabla Incidencias*/
                                                                        /*El text existe pero no se muestra*/
/*
                      $('#ejecutar').trigger("click");    
*/                      
                    $('#ejecutarIDResolucion').trigger("click");    
                                                            /*Simula el click del boton cuyo id="ejecutar"*/
                                                            /*El boton existe pero no se muestra*/
                                                            /*$("#ejecutar").on("click", getUsers) Anda siempre que exista un unico boton
                                                            con ese ID(ejecutar), por eso se crea el boton ejecutar, 
                                                            porque con el boton de la grilla no
                                                            funciona*/
                };

                                /*Esta funcion es llamada por cada click en el boton de la grilla, como parametro recibe el ID de la tabla Incidencias*/
                function obtengoIDNotas(id) {
/*
                    console.log('id=' || id);
                    console.log('Tipo=' || tipo);
*/                    
                    cerrarModalNotasIncidencias();
                    console.log("cerrarModalNotasIncidencias-Ejecutado");
                    document.getElementById('nota_id').value = id;    /*El id es el valor ID de la tabla Incidencias*/
                                                                        /*El text existe pero no se muestra*/

                    $('#ejecutarNota').trigger("click");      /*Simula el click del boton cuyo id="ejecutar"*/
                                                            /*El boton existe pero no se muestra*/
                                                            /*$("#ejecutar").on("click", getUsers) Anda siempre que exista un unico boton
                                                            con ese ID(ejecutar), por eso se crea el boton ejecutar, 
                                                            porque con el boton de la grilla no
                                                            funciona*/
                };

                $("#ejecutarIDResolucion").on("click", getIncidenciaIDResolucion);       /*Cada vez que le doy click al boton con id="ejecutar" invoca a la funcion "getUsers()"*/

                function getIncidenciaIDResolucion() {
                    //console.log("valor en incidencia_id= " + $('#incidencia_id').val());

                    var parametros= {
                        "inc_id" : $('#incidencia_id').val()      /*inc_id se llama el $_POST["inc_id"]; en el php*/
                    };
                    
                    console.log("parametros_1= " + parametros.inc_id);
                    
                    $.ajax({
                        /*data : parametros,*/
                        /*
                        url: 'model/traerRespuestasFrecuentes.php?tipo_id='+ tipo_id + '&id_pregunta=' + id_pregunta,
                        */
                        url: 'model/traerIncidencia.php?inc_id='+ parametros.inc_id,
                        type:'POST',
                        data: { "traerIncidencia":"1"},
                        dataType:'json',
                        success: function(respuesta) {

//                            var listaUsuarios = $("#lista-usuarios");

                            var listaUsuarios = $("#resolverIncidencia");
                            $.each(respuesta, function(index, incidencia) {
                                    /*
                                    +"<input name=\"nombre\"/>" +"</td>"
                                    \"nombre\"/ En JAVASCRIPT devuelve "nombre"
                                    */
                                 
                                listaUsuarios.append(
                                     `<div class=\"form-group\"/>` 
                                    + `     <label for=\"inputTipo\">Nombre y Apellido</label>` + `</br>`
                                    + `     <input type=\"text\" id=\"inputTipo\" value=\"` +  incidencia.usuario + `\"` + `>` + `</br>`
                                    + `     <label for=\"inputTipo\">Mail</label>` + `</br>`
                                    + `     <input type=\"text\" id=\"email\" value=\"` +  incidencia.email + `\"` + `>`
                                    + `</div>` 
                                    + `<div class=\"form-group\">`
                                    + `     </br>`
                                    + `     <label for=\"inputDescrip\">Descripcion Incidencia</label>` 
                                    + `     </br>`
                                    + `     <textarea class=\"form-control\" id=\"inputDescrip\">` + incidencia.descrip_inciden + `</textarea>` 
                                    + `</div>` 
                                    + `<div class=\"form-group\">` 
                                    + `     </br>`
                                    + `     <label for=\"inputRU\">Reporte Usuario</label>` + `</br>`
                                    + `     <textarea class=\"form-control\" id=\"inputRU\">` + incidencia.usuario_descripcion + `</textarea>`
                                    + `</div>`
                                    + `<div class=\"form-group\">` 
                                    + `     </br>`
                                    + `     <label for=\"inputResolucion\">Resolucion</label>` + `</br>`
                                    + `     <textarea class=\"form-control\" id=\"inputResolucion\">` + incidencia.texto_resolucion + ` </textarea>`
                                    + `     </br>`
                                    + `</div>`
                                );
                            });
                        },
                        
                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        if (jqXHR.status === 0) {
                            alert('Not connect: Verify Network.');
                        } else if (jqXHR.status == 404) {
                            alert('Requested page not found [404]');
                        } else if (jqXHR.status == 500) {
                            alert('Internal Server Error [500].');
                        } else if (textStatus === 'parsererror') {
                            alert('Requested JSON parse failed.');
                        } else if (textStatus === 'timeout') {
                            alert('Time out error.');
                        } else if (textStatus === 'abort') {
                            alert('Ajax request aborted.');
                        } else {
                            alert('Uncaught Error: ' + jqXHR.responseText);
                        }
                    });
                };


                $("#ejecutarNota").on("click", getNotaIncidencia);       /*Cada vez que le doy click al boton con id="ejecutar" invoca a la funcion "getUsers()"*/

                function getNotaIncidencia() {
                    //console.log("valor en incidencia_id= " + $('#incidencia_id').val());

                    var parametros= {
                        "inc_id" : $('#nota_id').val()      /*inc_id se llama el $_POST["inc_id"]; en el php*/
                    };
                    
                    console.log("parametros_1= " + parametros.inc_id);
                    
                    $.ajax({
                        /*data : parametros,*/
                        /*
                        url: 'model/traerRespuestasFrecuentes.php?tipo_id='+ tipo_id + '&id_pregunta=' + id_pregunta,
                        */
                        url: 'model/traerNota.php?inc_id='+ parametros.inc_id,
                        type:'POST',
                        data: { "nota":"1"},
                        dataType:'json',
                        success: function(respuesta) {

//                            var listaUsuarios = $("#lista-usuarios");

                            var listaUsuarios = $("#notasIncidencia");
                            $.each(respuesta, function(index, incidencia) {
                                listaUsuarios.append(
                                    `<div class=\"form-group\">` 
                                    + `     </br>`
                                    + `     <label for=\"inputNota\">Nota</label>` + `</br>`
                                    + `     <textarea class=\"form-control\" id=\"inputNota\">` + incidencia.nota + ` </textarea>`
                                    + `     </br>`
                                    + `</div>`
                                );
                            });
                        },
                        
                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        if (jqXHR.status === 0) {
                            alert('Not connect: Verify Network.');
                        } else if (jqXHR.status == 404) {
                            alert('Requested page not found [404]');
                        } else if (jqXHR.status == 500) {
                            alert('Internal Server Error [500].');
                        } else if (textStatus === 'parsererror') {
                            alert('Requested JSON parse failed.');
                        } else if (textStatus === 'timeout') {
                            alert('Time out error.');
                        } else if (textStatus === 'abort') {
                            alert('Ajax request aborted.');
                        } else {
                            alert('Uncaught Error: ' + jqXHR.responseText);
                        }
                    });
                };
        </script>
		<script src="js/sweetalert.min.js"></script>

    <script src="neon/js/gsap/main-gsap.js" id="script-resource-1"></script>
    <script src="neon/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
    <script src="neon/js/bootstrap.min.js" id="script-resource-3"></script>
    <script src="neon/js/joinable.js" id="script-resource-4"></script>
    <script src="neon/js/resizeable.js" id="script-resource-5"></script>
    <script src="neon/js/neon-api.js" id="script-resource-6"></script>
    <script src="neon/js/jquery.validate.min.js" id="script-resource-7"></script>
    <script src="neon/js/neon-login.js" id="script-resource-8"></script>
    <script src="neon/js/neon-custom.js" id="script-resource-9"></script>
    <script src="neon/js/neon-demo.js" id="script-resource-10"></script>
    </body>
</html>

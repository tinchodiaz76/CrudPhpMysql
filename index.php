<?php
header("Content-Type: text/html;charset=utf-8");
// include '../../include/db_conn.php';
// page_protect();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>UNAJ | Universidad Nacional Arturo Jauretche </title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="neon/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
    <link rel="stylesheet" href="neon/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
    <link rel="stylesheet" href="neon/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
    <link rel="stylesheet" href="neon/css/neon.css"  id="style-resource-5">

	<!-- Estilos span error y modal -->
	<style>
		.error {color: #FF0000;}
		.material-icons.md-24 { font-size: 24px; }
		.inline-icon {
			vertical-align: bottom;
			font-size: 24px !important;
		}
		.modal-backdrop {
			display: none;
			z-index: 1040 !important;
		}
		.modal-content {
			margin: 2px auto;
			z-index: 1100 !important;
		}
		/*
		.modal-header {
			background-color: blue;
			color: white;
		}
		*/
	</style>	

    <!-- Theme framework -->
	<script src="js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>

	<!-- Esta mierda rompe todo: -->
    <!-- script src="neon/js/jquery-1.10.2.min.js"></script -->
	<!-- Se reemplaza por este jquery: -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.spinner.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.slider.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	
</head>

    <body class="page-body  page-fade">

    	<div class="page-container">	
	
		<div class="sidebar-menu">
	
			<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="index.php">
					<img src="img/UNAJ.JPG" width="100%" height="100%" alt="UNAJ" />
				</a>
			</div>
			
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
			
			</header>
    		<?php include('include/nav.php'); ?>
    	</div>

    		<div class="main-content">
		
				<div class="row">					
					<!-- Profile Info and Notifications -->
                    <div class="col-md-6 col-sm-8 clearfix">	
						<h2>UNAJ | Universidad Nacional Arturo Jauretche</h2>
					</div>
										
					<!-- Raw Links -->
					<div class="col-md-6 col-sm-4 clearfix hidden-xs">						
						<ul class="list-inline links-list pull-right">
							<li>Bienvenido <b><?php echo $_SESSION['username']; ?></b> </li>														
							<li>
                                <a href="logout.php">
								    <button type="submit" class="btn btn-primary btn-blue">Cerrar Sesión<i class="entypo-logout right"></i></button>
								</a>
							</li>
						</ul>						
					</div>					
				</div>
                <hr/>

                <!-- AJAX content -->
                <div class="container-fluid">
					<div class="row">
						<div class="col-xs-12">					
							<div id="loader" class="text-center"><b>Loading...</b>&nbsp;&nbsp;&nbsp;<img src="img/loader.gif"></div>
							<!-- AJAX -->
							<div id="ajaxContent"></div>
							<!-- END AJAX -->
						</div>
					</div>
				</div>
				<!-- END AJAX content -->
			</div>
   
			<br/>
			<?php include('include/footer.php'); ?>
		</div>

        <!-- script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script -->
		<!-- script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script -->
		
		<!-- Inicia por default en Traer Incidencias: -->
			<script>
				$(document).ready(function(){
					iniLoad(1);
				});
				function iniLoad(page){
					//alert('traerIncidencias');
					var parametros = {"action" : "ajax", "page" : page};
					$("#loader").fadeIn();
					$.ajax({
					url : 'model/traerIncidencias.php',					
					type:'POST',
					data : parametros,
					beforeSend:function(objeto){
                        $("#ajaxContent").fadeOut();
						$("#loader").fadeIn();
					},
					success:function(data){
						//alert(data);
						$("#loader").fadeOut();
						$("#ajaxContent").html(data).fadeIn();
					}
					});
				}
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

	<!-- Agregado por filtro, resultados, paginador tabla -->
	<link rel="stylesheet" href="neon/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="neon/js/select2/select2.css"  id="style-resource-2">
	<script src="neon/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="neon/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="neon/js/select2/select2.min.js" id="script-resource-9"></script>
	<!-- Fin Agregado por filtro, resultados, paginador tabla -->	

    </body>
</html>

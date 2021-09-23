<ul id="main-menu" class="">
	
    <li id="model/traerIncidencias.php" class="active opened active"><a href="#"><i class="entypo-home"><!-- entypo-gauge --></i><span>Inicio</span></a></li>
<?php
if ($_SESSION['roles']==1)
{
?>	

	<li id="model/preguntasFrecuentes.php"><a href="#">
		<!-- span class="material-icons">edit_note</span -->
		<!-- i class="entypo-clipboard"></i -->
		<i class="inline-icon material-icons md-24">edit_note</i>
		<span>ABM Preguntas Frecuentes</span></a>
	</li>                
				
	<li id="model/respuestasFrecuentes.php"><a href="#">
		<!-- i class="entypo-doc-text"></i -->
		<i class="inline-icon material-icons md-24">edit_note</i>
		<span>ABM Respuestas Frecuentes</span></a>
	</li>
	<li id="model/resolucionesAutomaticas.php"><a href="#">
		<!-- i class="entypo-doc-text"></i -->
		<i class="inline-icon material-icons md-24">edit_note</i>
		<span>ABM Resoluciones Automaticas</span></a>
	</li>	
<?php
}
?>
	<!-- li><a href="category.php"><i class="entypo-users"></i><span>Socios</span></a>
		<ul>
			<li class="active"><a href="view_mem.php"><span>Ver Socios</span></a></li>			
			<li><a href="table_view.php"><span>Experiencia deportiva</span></a></li>
			<li><a href="ABM_FrecDep.php"><span>Frecuencia deportiva</span></a></li>			
			<li><a href="table_view.php"><span>Dieta</span></a></li>
			<li><a href="table_view.php"><span>Ocupaciones</span></a></li>
			<li><a href="table_view.php"><span>Ficha</span></a></li>
			<li><a href="table_view.php"><span>Objetivos</span></a></li>
			<li><a href="table_view.php"><span>Lesiones</span></a></li>
			<li><a href="table_view.php"><span>Estudios médicos</span></a></li>
			<li><a href="table_view.php"><span>Consentimiento</span></a></li>
		</ul>
	</li>

	<li><a href="new_health_status.php"><i class="entypo-user-add"></i><span>Nueva medición</span></a></li> 	

	<li><a href="#"><i class="entypo-briefcase"></i><span>Admin</span></a>
		<ul>
			<li class="active"><a href="ABM_TipoMem.php"><span>Tipos de Membresia</span></a></li>
			<li><a href="ABM_DepAct.php"><span>Deporte/Actividad</span></a></li>
			<li><a href="ABM_Dieta.php"><span>Dieta</span></a></li>
			<li><a href="ABM_Ocupacion.php"><span>Ocupación</span></a></li>
			<li><a href="ABM_Ejercicios.php"><span>Ejercicios</span></a></li>
			<li><a href="ABM_Objetivo.php"><span>Objetivos</span></a></li>
			<li><a href="ABM_ValorCuota.php"><span>Valor Cuota</span></a></li>
		</ul>
	</li>	
	
	<li><a href="new_plan.php"><i class="entypo-box"></i><span>Estadisticas Generales</span></a>
		<ul>
			<li class="active">
				<a href="over_members_month.php"><span>Miembros por mes</span></a>
			</li>
			<li>
				<a href="over_members_year.php"><span>Miembros por Año</span></a>
			</li>
			<li>
				<a href="revenue_month.php"><span>Ingresos por mes</span></a>
			</li>			
		</ul>
	</li>

	<li><a href="new_plan.php"><i class="entypo-alert"></i><span>Alertas</span></a>
		<ul>
			<li class="active">
				<a href="members_unpaid.php"><span>Miembros Pendiente de Pago</span></a>
			</li>
			<li>
				<a href="membership_end.php"><span>Termino de Membresia</span></a>
			</li>
		</ul>
	</li>

	<li><a href="more-userprofile.php"><i class="entypo-folder"></i><span>Perfil</span></a></li -->

	<li><a href="logout.php"><i class="entypo-logout"></i><span>Cerrar Sesión</span></a></li>

</ul>	

<script>
$(document).ready(function(){
 
 function load_page_details(id)
 {
	// alert('id: ' + id);
  $.ajax({
   url: ''+id+'',
   method:"POST",   
   beforeSend:function(objeto){
		// $("#ajaxContent").fadeOut();
		$("#loader").fadeIn();
	},
   success:function(response)
   {	
	$("#loader").fadeOut();
	$("#ajaxContent").html(response).fadeIn();
   }
  });
 }

 $('li').click(function(){	
  var page_id = $(this).attr("id");  
  load_page_details(page_id);
 });
 
});
</script>
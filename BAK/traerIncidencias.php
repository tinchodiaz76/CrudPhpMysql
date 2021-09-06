<?php

    session_start();
    include('../include/db_conn.php');
    include('../include/functions.php');
    $id= 0;
    $v_user= $_SESSION['username'];
    
    if (isset($_GET['estado']))
    {
        $v_estado= $_GET['estado'];
    }
    else
    {
        $v_estado= 1;
    }

    
/*
    $v_estado=$_GET['estado'];
*/
    // consulta principal para recuperar los datos              
    $query = 'select inc.apellido, inc.nombre, inc.dni, inc.telefono,
    inc.email, tip.descrip_inciden,
    IFNULL(inc.descrip_incidencia,"'.'-'.'") usuario_descripcion,
    CASE 
        when inc.estado=0 THEN "'.'Abierta'.'"
        when inc.estado=1 THEN "'.'Progreso'.'"
        ELSE "'.'Cerrada'.'"
    END estado_descrip,
    date_format(inc.fecha_creacion, "'.'%d/%m/%Y'.'") fecha_creacion,
    inc.id, inc.estado
    from unaj.incidencias inc, unaj.usuxperfil per, unaj.tipinciden tip
    where per.username= "'.$v_user.'"
    and inc.estado='.$v_estado.'
    and inc.tipo_incidencia = per.tipo_incidencia
    and tip.tipo_incidencia= inc.tipo_incidencia';                                
  ?>
  		<div class="row">
        <div class="col-sm-2 col-12">
            <h3>Incidencias <span class="error"></span></h3>
            <br>

            <select id="Estado" class="form-select" onchange="selectEstado()">Estado
                	<option value="0">Abierta</option>
                	<option value="1">Con Notas</option>
                	<option value="2">Cerradas</option>
            </select>
 
        </div>
      </div>
		  <hr />
              <!-- data grid -->
              <div>
                    <table class="table table-bordered datatable" id="table-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Descripcion Incidencia</th>
                            <th>Reporte Usuario</th>
                            <th>Estado</th>
                            <th>Fecha Creacion</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $result = mysqli_query($con, $query);
                          //while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                          while($row = mysqli_fetch_array($result)): 
                            $id=$id+1; 
                            if ($row['estado']==1)
                            {
                                $style = "background-color:yellow";
                            }
                            else
                            {
                                $style = "";
                            }
                        ?>
                              <tr style=<?=$style?> >
                                  <td><?=$id?></td>
                                  <td><?=$row['apellido']?></td>
                                  <td><?=$row['nombre']?></td>
                                  <td><?=$row['dni']?></td>
                                  <td><?=$row['telefono']?></td>
                                  <td><?=$row['email']?></td>
                                  <td><?=$row['descrip_inciden']?></td>
                                  <td><?=$row['usuario_descripcion']?></td>
                                  <td><?=$row['estado_descrip']?></td>
                                  <td><?=$row['fecha_creacion']?></td>
                                  <td>
                                    <input type="button" class="btn btn-warning" onclick="obtengoIDNotas(<?=$row['id']?>)" data-toggle="modal" data-target="#modalNotas"> Notas</button>
                                    <div style="width: 20px; height:auto; display:inline-block;"></div>
                                    <input type="button" class="btn btn-primary" style="background-color: #289039;" onclick="obtengoIDResolucion(<?=$row['id']?>)" data-toggle="modal" data-target="#modalResolucionIncidencia"> Resolver</button>
                                  </td>
                              </tr>
                        <?php
                          endwhile;  
                            $id=$id;
                        ?>
                      </tbody>
                    </table>
              </div>

  <script type="text/javascript">

    //Paginacion, busqueda, etc de dataGird:
    $(document).ready(function()
    {
      $("#table-1").dataTable({
        "sPaginationType": "bootstrap",
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "bStateSave": true
      });
      
      $(".dataTables_wrapper select").select2({
        minimumResultsForSearch: -1
      });

      
    });

    /*
    function iniLoad(){
        estadoIncidencia= document.getElementById("Estado").value;
        alert("estadoIncidencia.iniLoad=" + estadoIncidencia);
    }
    */
    
    function selectEstado() 
    { //Se usa cada vez que cambia el valor del estado de la incidencia
        estadoIncidencia= document.getElementById("Estado").value;
        alert("estadoIncidencia.selectEstado=" + estadoIncidencia);

        var parametros = {"action" : "ajax", "page" : page};
					$("#loader").fadeIn();
					$.ajax({
					/*url : 'model/traerIncidencias.php?estado=' + estadoIncidencia,*/
					url : 'model/traerIncidencias.php?estado=' + estadoIncidencia,
					type:'POST',
					//data : parametros,
					beforeSend:function(objeto){
                        alert('1');
                        $("#ajaxContent").fadeOut();
						$("#loader").fadeIn();
					},
					success:function(data){
						alert('2');
						$("#loader").fadeOut();
						$("#ajaxContent").html(data).fadeIn();
					}
					});
        /*iniLoad();*/
        //$_SESSION['estado']=estadoIncidencia;
        //sessionStorage.setItem("EstadoIncidencia", estadoIncidencia);
    }

    //JS Funcionamiento de Notas y Resolver:
    ejecutarIDResolucion.style.display = 'none';
    ejecutarNota.style.display ='none';
    // incidencia_id.style.display = 'none';
    // nota_id.style.display = 'none';

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

                window.location="index.php";
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

                window.location="index.php";
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
        cerrarModalResolverIncidencias();
        document.getElementById('incidencia_id').value = id; /*El id es el valor ID de la tabla Incidencias*/
                                                             /*El text existe pero no se muestra*/  
        getIncidenciaIDResolucion(id);
    };

    /*Esta funcion es llamada por cada click en el boton de la grilla, como parametro recibe el ID de la tabla Incidencias*/
    function obtengoIDNotas(id) {                   
        cerrarModalNotasIncidencias();
        //console.log("cerrarModalNotasIncidencias-Ejecutado");
        document.getElementById('nota_id').value = id;  /*El id es el valor ID de la tabla Incidencias*/
                                                        /*Es un input hidden*/
        getNotaIncidencia(id);
    };

    function getIncidenciaIDResolucion(id) {
        //console.log("valor en incidencia_id= " + $('#incidencia_id').val());

        var parametros= {
            "inc_id" : $('#incidencia_id').val()  /*inc_id se llama el $_POST["inc_id"]; en el php*/
        };
        
        //console.log("parametros_1= " + parametros.inc_id);
        $.ajax({
            url: 'model/traerIncidencia.php?inc_id='+ id,
            type:'POST',
            data: { "traerIncidencia":"1"},
            dataType:'json',
            success: function(respuesta) {
                var listaUsuarios = $("#resolverIncidencia");
                $.each(respuesta, function(index, incidencia) {                      
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
            alert(jqXHR + ' ' + textStatus + ' ' + errorThrown);
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

    function getNotaIncidencia(id) {
        //console.log("valor en incidencia_id= " + $('#incidencia_id').val());
/*
        var parametros= {
            "inc_id" : $('#nota_id').val()      // inc_id se llama el $_POST["inc_id"]; en el php
        };
*/        
        // console.log("parametros_1= " + parametros.inc_id);
        
        $.ajax({
            //url: 'model/traerNota.php?inc_id='+ parametros.inc_id,
            url: 'model/traerNota.php?inc_id='+ id,
            type:'POST',
            data: { "nota":"1"},
            dataType:'json',
            success: function(respuesta) {
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

<!-- Botones al pie de pagina -->
<br>
<input type="hidden" id="incidencia_id">
<button id="ejecutarIDResolucion" >Obtener usuarios</button>        
<div id="lista-usuarios"></div>
<br>
<input type="hidden" id="nota_id">
<button id="ejecutarNota" >Obtener Notas</button>        
<div id="lista-usuarios"></div>

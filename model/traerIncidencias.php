<div class="row">
    <div class="col-sm-2 col-12">
        <h3>Incidencias <span class="error"></span></h3>
        <br>
        <label for="Estado">Estado de Incidencias:</label>
        <select id="Estado" class="form-select" onchange="dataGridLoad()">
                <option select value="0">Abierta</option>
                <option value="1">Con Notas</option>
                <option value="2">Cerradas</option>
        </select>

    </div>

</div>
<hr />
<!-- AJAX content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">					
            <div id="loaderPF" class="text-center"><b>Loading...</b>&nbsp;&nbsp;&nbsp;<img src="img/loader.gif"></div>
            <!-- AJAX -->
            <div id="aContent"></div>
            <!-- END AJAX -->
        </div>
    </div>
</div>
<!-- END AJAX content -->

<script type="text/javascript">
    //Paginacion, busqueda, etc de dataGird:
    $(document).ready(function()
    {
      selectEstado();
    });

    function selectEstado()
    {

                estadoIncidencia= document.getElementById("Estado").value;
				$.ajax({
				url : 'model/dataGrid_traerIncidencias.php?estado=' + estadoIncidencia,
				type:'POST',					
				beforeSend:function(objeto){
					$("#aContent").fadeOut();
					$("#loaderPF").fadeIn();
				},
				success:function(data){					
					$("#loaderPF").fadeOut();
					$("#aContent").html(data).fadeIn();					
				}
				});
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
        var pedro  = document.getElementById("resolverIncidencia");
        // Elimino todos los DIV'S que estan dentros de DATOS
        while (pedro.firstChild) {
            pedro.removeChild(pedro.firstChild);
        }
        var pedro  = document.getElementById("footerResolverIncidencia");
        // Elimino todos los DIV'S que estan dentros de DATOS
        while (pedro.firstChild) {
            pedro.removeChild(pedro.firstChild);
        }
    }


    function cerrarModalNotasIncidencias(){
        var pedro  = document.getElementById("notasIncidencia");
        // Elimino todos los DIV'S que estan dentros de DATOS
        while (pedro.firstChild) {
            pedro.removeChild(pedro.firstChild);
        }

        var pedro  = document.getElementById("footerNotasIncidencia");
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
                var footerResolverIncidencia = $("#footerResolverIncidencia");
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
/*                            +`<button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerrarModalResolverIncidencias()">Cerrar</button>`                            */
                    if (incidencia.estado==2)
                    {
                        footerResolverIncidencia.append(
                            `<div class="modal-footer"> `
                            +`<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>`
                            + `</div> `
                        );
                    }
                    else
                    {
                        footerResolverIncidencia.append(
                            `<div class="modal-footer"> `
                            +`<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>`
                            + `<button type="button" class="btn btn-primary" action="resolverIncidencia.php" data-dismiss="modal"  onclick="return ValidaResolucion(this)">Grabar Resolucion</button> `
                            + `</div> `
                        );
                    }
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
        // console.log("parametros_1= " + parametros.inc_id);
        
        $.ajax({
            //url: 'model/traerNota.php?inc_id='+ parametros.inc_id,
            url: 'model/traerNota.php?inc_id='+ id,
            type:'POST',
            data: { "nota":"1"},
            dataType:'json',
            success: function(respuesta) {
                var listaUsuarios = $("#notasIncidencia");
                footerNotasIncidencia= $("#footerNotasIncidencia");
                $.each(respuesta, function(index, incidencia) {
                    listaUsuarios.append(
                        `<div class=\"form-group\">` 
                        + `     </br>`
                        + `     <label for=\"inputNota\">Nota</label>` + `</br>`
                        + `     <textarea class=\"form-control\" id=\"inputNota\">` + incidencia.nota + ` </textarea>`
                        + `     </br>`
                        + `</div>`
                    );
/*+ `  <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>`*/
                    if  (incidencia.estado==2)
                    {
                        footerNotasIncidencia.append(`<div class="modal-footer">`
                        +`<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>`
                        + `</div>`
                        );
                    }
                    else
                    {
                        footerNotasIncidencia.append(`<div class="modal-footer">`
                        +`<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>`
                        + `  <button type="button" class="btn btn-primary" action="grabarNota.php" data-dismiss="modal"  onclick="return ValidaNota(this)">Grabar Nota</button>`
                        + `</div>`
                        )

                    };
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

<!-- Modal RESOLUCION DE INCIDENCIA-->
<div class="modal fade" id="modalResolucionIncidencia" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                 <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Resolver Incidencia</h4>
            </div>            
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form" id="resolverIncidencia">
                
                </form>
            </div>

            <div class="modal-footer" id="footerResolverIncidencia">
<!--                
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerrarModalResolverIncidencias()">Cerrar</button>
                <button type="button" class="btn btn-primary" action="resolverIncidencia.php" data-dismiss="modal"  onclick="return ValidaResolucion(this)">Grabar Resolucion</button>
-->                
            </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal NOTAS-->
<div class="modal fade" id="modalNotas" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Grabar Notas</h4>
            </div>              

            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form" id="notasIncidencia">
           
                </form>
            </div>
           
           
            <div class="modal-footer" id="footerNotasIncidencia">
<!--            
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerrarModalNotasIncidencias()">Cerrar</button>
                <button type="button" class="btn btn-primary" action="grabarNota.php" data-dismiss="modal"  onclick="return ValidaNota(this)">Grabar Nota</button>
-->                
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

<?php
  session_start();
  include('../include/db_conn.php');
  include('../include/functions.php');
  $id= 0;
  $v_user= $_SESSION['username'];

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
                and inc.estado in (0,1)
                and inc.tipo_incidencia = per.tipo_incidencia
                and tip.tipo_incidencia= inc.tipo_incidencia';                                
  ?>
  		<div class="row">
        <div class="col-sm-2 col-12">
          <h3>Incidencias <span class="error"></span></h3>
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
                            if ($row['estado']==1):
                        ?>
                              <tr>
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
                                    <input type="button" class="btn btn-warning" onclick="obtengoIDNotas(<?=$row['id']?>)" data-toggle="modal" data-target="#modalNotas">Notas</button>
                                    <input type="button" class="btn btn-primary" onclick="obtengoIDResolucion(<?=$row['id']?>)" data-toggle="modal" data-target="#modalResolucionIncidencia">Resolver</button>
                                  </td>
                              </tr>
                        <?php
                          else:
                        ?>
                              <tr>
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
                                    <input type="button" class="btn btn-warning" onclick="obtengoIDNotas(<?=$row['id']?>)" data-toggle="modal" data-target="#modalNotas">Notas</button>
                                    <input type="button" class="btn btn-primary" onclick="obtengoIDResolucion(<?=$row['id']?>)" data-toggle="modal" data-target="#modalResolucionIncidencia">Resolver</button>
                                  </td>
                              </tr>
                        <?php
                          endif;

                          endwhile;  
                            $id=$id;
                        ?>
                      </tbody>
                    </table>
              </div>

  <script type="text/javascript">
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
  </script>                    
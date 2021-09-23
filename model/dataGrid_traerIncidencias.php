<?php
    // page_protect();
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

    $query = 'select inc.apellido, inc.nombre, inc.dni,
        inc.email, tip.descripcion,
        IFNULL(inc.descrip_incidencia,"'.'-'.'") usuario_descripcion,
        CASE 
            when inc.estado=0 THEN "'.'Abierta'.'"
            when inc.estado=1 THEN "'.'Progreso'.'"
            ELSE "'.'Cerrada'.'"
        END estado_descrip,
        date_format(inc.fecha_creacion, "'.'%d/%m/%Y'.'") fecha_creacion,
        date_format(inc.fecha_cerrado, "'.'%d/%m/%Y'.'") fecha_cerrado,
        inc.id, inc.estado
        from unaj.incidencias inc, unaj.usuxperfil per, unaj.resoluciones_incidencias tip
        where per.username= "'.$v_user.'"
        and inc.estado='.$v_estado.'
        and inc.tipo_incidencia = per.tipo_incidencia
        and tip.id= inc.tipo_incidencia';                                
?>

<div>
    <table class="table table-bordered datatable" id="table-1">
        <thead>
          <?php
           if ($v_estado==2) 
            {
              
          ?>
              <tr>
                <th>#</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Descripcion Incidencia</th>
                <th>Reporte Usuario</th>
                <th>Estado</th>
                <th>Fecha Creacion</th>
                <th>Fecha Cierre</th>    
                <th></th>
              </tr>
          <?php
            }                        
          else
            {
          ?>
              <tr>
              <th>#</th>
              <th>Apellido</th>
              <th>Nombre</th>
              <th>DNI</th>
              <th>Email</th>
              <th>Descripcion Incidencia</th>
              <th>Reporte Usuario</th>
              <th>Estado</th>
              <th>Fecha Creacion</th>
              <th></th>
            </tr>
          <?php
            }
          ?>
        </thead>
        <tbody>
        <?php 
          $result = mysqli_query($con, $query);
          //while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          while($row = mysqli_fetch_array($result)): 
            $id=$id+1; 
            switch ($row['estado']) {
              case 1:
                $style = "background-color:#FFFF99";
                break;
              case 2:
                $style = "background-color:#B3FFCC";
                break;
              default:
                $style = "";
            }
          
        ?>
              <tr style=<?=$style?> >
                  <td><?=$id?></td>
                  <td><?=$row['apellido']?></td>
                  <td><?=$row['nombre']?></td>
                  <td><?=$row['dni']?></td>
                  <td><?=$row['email']?></td>
                  <td><?=$row['descripcion']?></td>
                  <td><?=$row['usuario_descripcion']?></td>
                  <td><?=$row['estado_descrip']?></td>
                  <td><?=$row['fecha_creacion']?></td>
        <?php
                  if ($row['estado']==2)
                  {
        ?>                    
                  <td><?=$row['fecha_cerrado']?></td>
                  <td>
                    <input type="button" class="btn btn-warning" onclick="obtengoIDNotas(<?=$row['id']?>)" data-toggle="modal" data-target="#modalNotas"> Nota</button>
                    <div style="width: 20px; height:auto; display:inline-block;"></div>
                    <input type="button" class="btn btn-primary" style="background-color: #289039;" onclick="obtengoIDResolucion(<?=$row['id']?>)" data-toggle="modal" data-target="#modalResolucionIncidencia"> Respuesta</button>
                  </td>
        <?php
                  }
                  else
                  {
        ?>                  
                  <td>
                    <input type="button" class="btn btn-warning" onclick="obtengoIDNotas(<?=$row['id']?>)" data-toggle="modal" data-target="#modalNotas"> Nota</button>
                    <div style="width: 20px; height:auto; display:inline-block;"></div>
                    <input type="button" class="btn btn-primary" style="background-color: #289039;" onclick="obtengoIDResolucion(<?=$row['id']?>)" data-toggle="modal" data-target="#modalResolucionIncidencia"> Resolver</button>
                  </td>                    
        <?php
                  }
        ?>
              </tr>
        <?php
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
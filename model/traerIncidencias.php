<?php

  session_start();

  # Incluimos la clase usuario
  require_once('conexion.php');

  class Incidencias extends Conexion
	{
		public function TraerIncidencias()
    {	
      if (isset($_SESSION['username'])):

        parent::conectar();
        $id= 0;
        $v_user= $_SESSION['username'];
  //      $v_user= 'mfd';

      $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL) ? $_REQUEST['action'] : '';

  //    $action= 'ajax';

      if($action == 'ajax'):

                include 'pagination.php'; // Incluir el archivo de paginación

                // Las variables de paginación
                $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
                $per_page = 5; // La cantidad de registros que desea mostrar
                $adjacents = 4; // Brecha entre páginas después de varios adyacentes
                $offset = ($page - 1) * $per_page;
                // Cuenta el número total de filas de la tabla*/

                $cantreg = 'select count(1) numrows
                from ywayqssx_MA.incidencias inc, ywayqssx_MA.usuxperfil per, ywayqssx_MA.tipinciden tip
                where per.username= "'.$v_user.'"
                and inc.estado=0    
                and inc.tipo_incidencia = per.tipo_incidencia
                and tip.tipo_incidencia= inc.tipo_incidencia';
  ?>

  <?php
                $resEmp =parent::query($cantreg);
                while($row = mysqli_fetch_array($resEmp))
                {
                  $numrows=$row['numrows'];                   
                }
  ?>

  <?php
                //echo $numrows;
                $total_pages = ceil($numrows/$per_page);

                //echo $numrows;
                //echo $total_pages;
                // consulta principal para recuperar los datos
                
                $query = 'select inc.apellido, inc.nombre, inc.dni, inc.telefono,
                inc.email, tip.descrip_inciden,
                IFNULL(replace(inc.descrip_incidencia,null,"'.''.'"),"'.'-'.'") usuario_descripcion,
                CASE 
                  when inc.estado=0 THEN "'.'Abierta'.'"
                  ELSE "'.'Cerrada'.'"
                END estado_descrip,
                date_format(inc.fecha_creacion, "'.'%d/%m/%Y'.'") fecha_creacion,
                inc.id
                from ywayqssx_MA.incidencias inc, ywayqssx_MA.usuxperfil per, ywayqssx_MA.tipinciden tip
                where per.username= "'.$v_user.'"
                and inc.estado=0    
                and inc.tipo_incidencia = per.tipo_incidencia
                and tip.tipo_incidencia= inc.tipo_incidencia
                LIMIT '.$offset.','.$per_page;

                if ($numrows>0):
  ?>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">DNI</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Email</th>
                            <th scope="col">Descrip Inciden</th>
                            <th scope="col">Reporte Usuario</th>
                            <th scope="col">Fecha Creacion</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php 
                        $resEmp =parent::query($query);
                        while($row = mysqli_fetch_array($resEmp)): 
                          $id=$id+1;
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
                          <td><input type="button" class="btn btn-primary" onclick="obtengoID(<?=$row['id']?>)" data-toggle="modal" data-target="#modalForm">Resolver</button></td>
                        </tr>
                      <?php endwhile;  
                            $id=$id;
                      ?>
                      </tbody>
                    </table>
                    <div class="table-pagination pull-right">
                      <?=paginate($page, $total_pages, $adjacents)?>
                    </div>
        <?php else: ?>
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4>Aviso!!!</h4> No hay datos para mostrar
        </div>
        <?php
      endif;
    endif;
  else:
  ?>
      <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4>Aviso!!!</h4> No esta logueado!!
      </div>
  <?php
  endif;
      }
    }

    if (isset($_POST['action']))
    {
      $foo = new Incidencias();
  
      $foo->TraerIncidencias();
    }
?>
<?php
    // Arrays para guardar mensajes y errores:
    $aErrores = array();
    $aMensajes = array();
    


            $filename = "libros.xls";
    
            header("Content-Type: application/xls; charset=UTF-8");
            header("Content-Disposition: attachment; filename=".$filename);


//            require_once('abre_conexion_clase.php');
//            $conn= new Conexion();
//            $conexion=$conn->conectarse();            
            include('abre_conexion.php');

            $query =  "select inc.apellido, inc.nombre, inc.dni, inc.telefono,
                                    inc.email, tip.descrip_inciden,
                                    inc.descrip_incidencia usuario_descripcion, 
                                    case
                                        WHEN estado=0 THEN 'Abierta'
                                        ELSE 'Cerrada'
                                    END estado_descrip,
                                    date_format(inc.fecha_creacion, '%d/%m/%Y') fecha_creacion,
                                    inc.username,
                                    inc.resolucion,
                                    inc.fecha_cerrado
                                    from unaj.incidencias inc, unaj.usuxperfil per,
                                        unaj.resoluciones_incidencias tip
                                    where 1=1";
/*
OJOOOOOO!!!
EMPTY DEVULVE UN FALSE SI $_POST['estado']=0
POR ESO SI ES VACIO HARDCODEO EL ESTADO =0
*/
            if (!empty($_POST['estado']))
            {
                $v_estado= $_POST['estado'];
                
                $query= $query . "
                                 and inc.estado=$v_estado";
            }
            else
            {
                $query= $query . "
                                 and inc.estado=0";
            }

            if (!empty($_POST['consulta']))
            {
                $v_consulta= $_POST['consulta'];
                
                $query= $query . "
                                 and inc.tipo_incidencia=$v_consulta";
            }

            if (!empty($_POST['FDesde']) && !empty($_POST['FHasta']))
            {
                $v_fdesde= $_POST['FDesde'];
                $v_fhasta= $_POST['FHasta'];
                
                $query= $query . "
                                and date_format(fecha_creacion,\"%Y-%m-%d\") between str_to_date('$v_fdesde',\"%Y-%m-%d\") and str_to_date('$v_fhasta',\"%Y-%m-%d\")";
            }

            $query= $query . "
                             and inc.tipo_incidencia = per.tipo_incidencia
                             and tip.tipo_incidencia= inc.tipo_incidencia
                             ";

            mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

            $resEmp = mysqli_query($conexion,$query);

?>

            <table border="1"><!-- width="80%" border="1" aliign="center">-->
                <tr>
                    <th bgcolor="#3399CC" >Apellido</th>
                    <th bgcolor="#3399CC">Nombre</th>
                    <th bgcolor="#3399CC">DNI</th>
                    <th bgcolor="#3399CC">Telefono</th>
                    <th bgcolor="#3399CC">Mail</th>
                    <th bgcolor="#3399CC">Descrip Inciden</th>
                    <th bgcolor="#3399CC">Usuario Descripcion</th>
                    <th bgcolor="#3399CC"> Estado</th>
                    <th bgcolor="#3399CC">Fecha Creacion</th>
                    <th bgcolor="#3399CC">Resolucion</th>
                    <th bgcolor="#3399CC">Fecha Cerrado</th>
                    <th bgcolor="#3399CC">Usuario</th>
                </tr>
<?php
            while ($row=mysqli_fetch_assoc($resEmp))
            {
?>
                <tr>    
                    <td><?php echo $row['apellido'];?></td>
                    <td><?php echo $row['nombre'];?></td>
                    <td><?php echo $row['dni'];?></td>
                    <td><?php echo $row['telefono'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['descrip_inciden'];?></td>
                    <td><?php echo $row['usuario_descripcion'];?></td>
                    <td><?php echo $row['estado_descrip'];?></td>
                    <td><?php echo $row['fecha_creacion'];?></td>
                    <td><?php echo $row['resolucion'];?></td>
                    <td><?php echo $row['fecha_cerrado'];?></td>
                    <td><?php echo $row['username'];?></td>
                </tr>    
<?php
            }
?>
            </table>
<?php
            include('cerrar_conexion.php');
?>



<?php

    session_start();

    # Incluimos la clase usuario
    require_once('conexion.php');

    class InsertaIncidencias extends Conexion
    {
        public function insertaIncidencia($email, 
                                        $apellido,
                                        $nombre,
                                        $dni,
                                        $telefono,
                                        $selectarea,
                                        $selectincidenciaarea,
                                        $validationTextarea,
                                        $selectcarrera,
                                        $selectmaterias
                                        )

        {
            // Patrón para usar en expresiones regulares (admite letras acentuadas y espacios):
            $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";


            parent::conectar();

            $query ='insert into unaj.incidencias (tipo_id,email,
            apellido,nombre,dni,
            telefono,propuesta_codigo, elemento_codigo, id_area,tipo_incidencia, 
            descrip_incidencia,estado,fecha_creacion) 
            values (1,"'.$email.'",
            upper("'.$apellido.'"),upper("'.$nombre.'"),"'.$dni.'",
            "'.$telefono.'","'.$selectcarrera.'","'.$selectmaterias.'",'.$selectarea.','.$selectincidenciaarea.',
            "'.$validationTextarea.'",0,curdate())';
    
            echo $query;
            $resEmp =parent::query($query);

            parent::cerrar();

        }
    }
    
    
    if (isset($_POST['email']) && isset($_POST['apellido']) && isset($_POST['nombre']) &&
            isset($_POST['dni']) && isset($_POST['telefono']) && isset($_POST['selectarea']) &&
            isset($_POST['selectincidenciaarea']) && isset($_POST['validationTextarea']) &&
            isset($_POST['selectcarrera']) && isset($_POST['selectmaterias'])
        )
    {

        $foo = new InsertaIncidencias();

        $foo->insertaIncidencia($_POST['email'], 
        $_POST['apellido'],
        $_POST['nombre'],
        $_POST['dni'],
        $_POST['telefono'],
        $_POST['selectarea'],
        $_POST['selectincidenciaarea'],
        $_POST['validationTextarea'],
        $_POST['selectcarrera'],
        $_POST['selectmaterias']);

    }

?>

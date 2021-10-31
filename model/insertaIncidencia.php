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
                                        $selectarea,
                                        $selectincidenciaarea,
                                        $validationTextarea,
                                        $selectcarrera,
                                        $selectcarreraText,
                                        $selectmaterias,
                                        $selectmateriasText
                                        )

        {
            // Patrón para usar en expresiones regulares (admite letras acentuadas y espacios):
            $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";


            parent::conectar();

            $query ='insert into unaj.incidencias (tipo_id,email,
            apellido,nombre,dni,
            propuesta_codigo, propuesta_descripcion,
            elemento_codigo, elemento_descripcion,
            id_area,tipo_incidencia, 
            descrip_incidencia,estado,fecha_creacion) 
            values (1,"'.$email.'",
            upper("'.$apellido.'"),upper("'.$nombre.'"),"'.$dni.'",
            "'.$selectcarrera.'","'.$selectcarreraText.'",
            "'.$selectmaterias.'","'.$selectmateriasText.'",
            '.$selectarea.','.$selectincidenciaarea.',
            "'.$validationTextarea.'",0,curdate())';
    
            echo $query;
            $resEmp =parent::query($query);

            parent::cerrar();

        }
    }
    
    
    if (isset($_POST['email']) && isset($_POST['apellido']) && isset($_POST['nombre']) &&
            isset($_POST['dni']) && isset($_POST['selectarea']) &&
            isset($_POST['selectincidenciaarea']) && isset($_POST['validationTextarea']) &&
            isset($_POST['selectcarrera']) &&
            isset($_POST['selectcarreraText']) &&
            isset($_POST['selectmaterias']) &&
            isset($_POST['selectmateriasText'])
        )
    {

        $foo = new InsertaIncidencias();

        $foo->insertaIncidencia($_POST['email'], 
        $_POST['apellido'],
        $_POST['nombre'],
        $_POST['dni'],
        $_POST['selectarea'],
        $_POST['selectincidenciaarea'],
        $_POST['validationTextarea'],
        $_POST['selectcarrera'],
        $_POST['selectcarreraText'],
        $_POST['selectmaterias'],
        $_POST['selectmateriasText']);

    }

?>

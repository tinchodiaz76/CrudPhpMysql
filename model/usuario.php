<?php

  # Incluimos la clase conexion para poder heredar los metodos de ella.
  require_once('conexion.php');

  class Usuario extends Conexion
  {

    public function login($user, $clave)
    {

      # Nos conectamos a la base de datos
      parent::conectar();

      // El metodo salvar sirve para escapar cualquier comillas doble o simple y otros caracteres que pueden vulnerar nuestra consulta SQL
      /*
      $user  = parent::salvar($user);
      $clave = parent::salvar($clave);
      */

      $consulta ='select username,roles from unaj.users where username="'.$user.'" and password= "'.$clave.'"';

      $verificar_usuario = parent::verificarRegistros($consulta);
      //echo 'success: ' + $verificar_usuario;

      // si la consulta es mayor a 0 el usuario existe
      if($verificar_usuario > 0)
      {
        $user = parent::consultaArreglo($consulta);
        session_start();
        $_SESSION['username'] = $user['username'];
        $_SESSION['roles'] = $user['roles'];
        // header("location: ../verIncidencias.php");
        echo 'success';
      }
      else
      {
        // El usuario y la clave son incorrectos
        echo 'error_3';
      }
      # Cerramos la conexion
      parent::cerrar();
    }

  }
?>

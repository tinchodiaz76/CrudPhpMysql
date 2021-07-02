
<?php

    # Clase conexion: permite conectar a la base de datos y ejecutar consultas sql

    class Conexion
    {

        # Atributos de la clase conexion
        private $mysqli = '';
        private $usuario = 'root';
        private $clave = 'ciclon';
        private $server = 'localhost';
        private $db = 'unaj'; //unaj


        # Funcion que permite conectarnos a la base de datos
        public function conectar()
        {
            # Creamos un objeto de conexion MySQLI

            /*
            $this->mysqli = new mysqli($this->server, $this->usuario, $this->clave, $this->db);
            */
            $this->mysqli = new mysqli($this->server, $this->usuario, $this->clave, $this->db);
			
			// echo $this->mysqli->host_info . "\n";
			
			/* comprobar si el servidor sigue vivo */
			/*
			if ($this->mysqli->ping()) {
				printf ("¡La conexión está bien!\n");
			} else {
				printf ("Error: %s\n", $this->mysqli->error);
			}
			*/

            # Validamos si existe un error al conectarnos
            if($this->mysqli->connect_errno)
            {
                # Imprimimos el error
                echo 'Fallo al conectarse con MySQL: ' . $this->mysqli->connect_error;
                exit();
            }


            if (!$this->mysqli->set_charset("utf8")) 
            {
              printf("Error cargando el conjunto de caracteres utf8: %s\n", $this->mysqli->error);
              exit();
            } 
            /*
            else 
            {
              printf("Conjunto de caracteres actual: %s\n", $this->mysqli ->character_set_name());
            }
            */

        }


        # Function que retorna un objeto de MySQL
        public function query($consulta)
        {
          #mysqli_query Realiza una consulta a la base de datos
          return $this->mysqli->query($consulta);
        }


        # Funcion que retorna el numero de filas afectadas por una consulta sql
        public function verificarRegistros($consulta)
        {
            # mysqli_num_rows: Obtiene el número de filas de un resultado de una consulta
            return $verificarRegistros = mysqli_num_rows($this->mysqli->query($consulta));
        }


        # Funcion que retorna un arreglo con los registros de una consulta
        public function consultaArreglo($consulta)
        {
          # mysqli_fetch_array Obtiene una fila de resultados como un array asociativo, numérico, o ambos
          return mysqli_fetch_array($this->mysqli->query($consulta));
        }


        # Function que permite cerrar una conexion de MySQL
        public function cerrar()
        {
            # Accedemos al atributo de conexion y cerramos la conexion
            $this->mysqli->close();
        }

        # Escapa los caracteres especiales de un string para evitar las inyecciones sql
        public function salvar($des)
        {
          /*
            mysqli_real_escape_string: Escapa los caracteres especiales de una cadena
            para usarla en una sentencia SQL, tomando en cuenta el conjunto de
            caracteres actual de la conexión.
          */
          $string = $this->mysqli->real_escape_string($des);

          return $string;
        }

        # Serie de filtros para almacenar en base de datos
        public function filtrar($string){

          $res = $this->salvar($string);

          # Asignamos los parametros de busqueda
          $buscar = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');
          $reemplazar = array('&aacute','&eacute', '&iacute', '&oacute', '&uacute', '&Aacute', '&Eacute', '&Iacute', '&Oacute', '&Uacute', '&ntilde', '&Ntilde');

          # str_replace: Reemplaza todas las apariciones del string buscado con el string de reemplazo
          $res = str_replace($buscar, $reemplazar, $string);

          # strtolower: Convierte una cadena a minúsculas
          $res = strtolower($res);

          # trim: Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
          $res = trim($res);

          return $res;
        }

        # Convierte el acento de base de datos a acentos entendibles
        public function rescatar($string)
        {

          # Asignamos los parametros de busqueda
          $buscar = array('&aacute','&eacute', '&iacute', '&oacute', '&uacute', '&Aacute', '&Eacute', '&Iacute', '&Oacute', '&Uacute', '&ntilde', '&Ntilde');
          $reemplazar = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');

          $res = str_replace($buscar, $reemplazar, $string);

          return $res;
        }

    } // End Class

// $a = new Conexion();
// $a->conectar();


?>

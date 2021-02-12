<?php
        session_start();
        // Eliminar el nombre de usuario:
        unset($_SESSION["user"]);
        session_destroy();
        header('Location: index.html');
?>
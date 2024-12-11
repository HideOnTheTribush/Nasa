<?php
session_start();
session_destroy(); // Elimina toda la información de la sesión
header("Location: login.php"); // Redirigir al login
exit;
?>

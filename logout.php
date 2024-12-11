<?php
session_start();
session_destroy(); // Elimina toda la información de la sesión

// Eliminar la cookie
setcookie("username", "", time() - 3600, "/"); // Establecer tiempo en el pasado

header("Location: login.php"); // Redirigir al login
exit;
?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
</head>
<body>
<?php
    // Mostrar el nombre del usuario desde la cookie
    if (isset($_COOKIE['username'])) {
        echo "<p>Bienvenido de nuevo, " . htmlspecialchars($_COOKIE['username']) . "!</p>";
    } else {
        echo "<p>Bienvenido a la página principal!</p>";
    }
    ?>
    <p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>
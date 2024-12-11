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
    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <p>Tu token de la NASA es: <?= htmlspecialchars($_SESSION['token']) ?></p>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>

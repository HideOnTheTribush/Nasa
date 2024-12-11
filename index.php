<?php
session_start();
require 'db.php'; // Conexión a la base de datos
require 'nasa_api.php'; // Archivo con las funciones para consultar la API

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Redirigir al login si no está autenticado
    exit;
}

$apiKey = $_SESSION['token'];  // Obtener el token de la NASA del usuario

// Obtener la foto del día de la NASA
$photoData = getPhotoOfTheDay($apiKey);

// Obtener los asteroides cercanos para un rango de fechas
$startDate = '2024-12-01'; // Puedes modificar estas fechas
$endDate = '2024-12-02';
$asteroidsData = getAsteroids($apiKey, $startDate, $endDate);

// Verificar si se obtuvieron los datos correctamente
if (!$photoData || !$asteroidsData) {
    die("Error al obtener los datos de la API.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - NASA</title>
</head>
<body>
    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>

    <!-- Foto del Día -->
    <h2>Foto del Día</h2>
    <h3><?= htmlspecialchars($photoData['title']) ?></h3>
    <img src="<?= htmlspecialchars($photoData['url']) ?>" alt="<?= htmlspecialchars($photoData['title']) ?>">
    <p><?= htmlspecialchars($photoData['explanation']) ?></p>

    <!-- Asteroides Cercanos -->
    <h2>Asteroides Cercanos</h2>
    <?php foreach ($asteroidsData['near_earth_objects'] as $date => $asteroids): ?>
        <?php foreach ($asteroids as $asteroid): ?>
            <h3><?= htmlspecialchars($asteroid['name']) ?></h3>
            <p>Diámetro máximo: <?= htmlspecialchars($asteroid['estimated_diameter']['kilometers']['estimated_diameter_max']) ?> km</p>
            <p>Velocidad: <?= htmlspecialchars($asteroid['close_approach_data'][0]['relative_velocity']['kilometers_per_second']) ?> km/s</p>
            <p>Distancia lunar: <?= htmlspecialchars($asteroid['close_approach_data'][0]['miss_distance']['lunar']) ?> distancias lunares</p>
        <?php endforeach; ?>
    <?php endforeach; ?>

    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>

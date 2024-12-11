<?php
$host = 'localhost';
$dbname = 'nasa';
$username = 'admin';
$password = 'abc123.';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    echo "Conexión exitosa a la base de datos";
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>

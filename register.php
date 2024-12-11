<?php
session_start();
require 'db.php'; // Conexión a la base de datos

// Comprobamos si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];
    $token = $_POST['token'] ?? ''; // Token opcional

    // Validar que el nombre de usuario y la contraseña no estén vacíos
    if (empty($username) || empty($password)) {
        $error = "El nombre de usuario y la contraseña son obligatorios.";
    } else {
        // Verificar si el nombre de usuario ya existe en la base de datos
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            $error = "El nombre de usuario ya existe. Por favor, elige otro.";
        } else {
            // Cifrar la contraseña
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insertar el nuevo usuario en la base de datos
            $stmt = $pdo->prepare("INSERT INTO users (username, password, token) VALUES (?, ?, ?)");
            $stmt->execute([$username, $hashedPassword, $token]);

            // Mensaje de éxito y redirección al login
            $_SESSION['success'] = "Usuario registrado con éxito. Ahora puedes iniciar sesión.";
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registro de Nuevo Usuario</h1>

    <!-- Mensaje de error si algo falla -->
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" id="username" required>
        <br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <br>

        <label for="token">Token de la API (opcional):</label>
        <input type="text" name="token" id="token">
        <br>

        <button type="submit">Registrar</button>
    </form>

    <!-- Enlace para volver al login -->
    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
</body>
</html>

<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST["nombre_usuario"];
    $clave = password_hash($_POST["clave"], PASSWORD_DEFAULT); // encriptar clave
    $rol = "empleado";

    $sql = "INSERT INTO usuarios (nombre_usuario, clave, rol) VALUES ('$nombre_usuario', '$clave', '$rol')";
    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('Usuario registrado correctamente'); window.location='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Mailu Tattoo</title>
    <link rel="stylesheet" href="assets/estilo.css">
    <link rel="icon" href="assets/icono.ico">
</head>
<body>
    <h2>Crear Cuenta</h2>
    <form method="POST">
        <label>Nombre de usuario:</label>
        <input type="text" name="nombre_usuario" required><br>
        <label>Contraseña:</label>
        <input type="password" name="clave" required><br>
        <button type="submit">Registrarse</button>
    </form>
    <p>¿Ya tenés cuenta? <a href="login.php">Iniciar sesión</a></p>
</body>
</html>

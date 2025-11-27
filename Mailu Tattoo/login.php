<?php
session_start();
include("conexion.php");
require_once("setup.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST["nombre_usuario"];
    $clave = $_POST["clave"];

    $sql = "SELECT * FROM usuarios WHERE nombre_usuario='$nombre_usuario'";
    $resultado = mysqli_query($conexion, $sql);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        if (password_verify($clave, $fila["clave"])) {
            $_SESSION["usuario"] = $fila["nombre_usuario"];
            $_SESSION["rol"] = $fila["rol"];
            header("Location: home.php");
            exit;
        } else {
            echo "<script>alert('Contraseña incorrecta');</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Mailu Tattoo</title>
    <link rel="stylesheet" href="assets/estilo.css">
    <link rel="icon" href="assets/icono.ico">
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="POST">
        <label>Usuario:</label>
        <input type="text" name="nombre_usuario" required><br>
        <label>Contraseña:</label>
        <input type="password" name="clave" required><br>
        <button type="submit">Ingresar</button>
    </form>
    <p>¿No tenés cuenta? <a href="registro.php">Crear una</a></p>
</body>
</html>

<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

$mensaje = "";

if (isset($_POST["nueva_clave"])) {
    $usuario = $_SESSION["usuario"];
    $nueva_clave = $_POST["nueva_clave"];

    // Encriptar clave
    $clave_hash = password_hash($nueva_clave, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET clave='$clave_hash' WHERE nombre_usuario='$usuario'";

    if (mysqli_query($conexion, $sql)) {
        $mensaje = "✅ Contraseña modificada correctamente";
    } else {
        $mensaje = "❌ Error al cambiar la contraseña";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar clave</title>
    <link rel="stylesheet" href="assets/estilo.css">
</head>
<body>

<h2>🔐 Cambiar contraseña</h2>
<p>Usuario: <b><?php echo $_SESSION["usuario"]; ?></b></p>

<form method="POST">
    <input type="password" name="nueva_clave" placeholder="Nueva contraseña" required>
    <br><br>
    <button type="submit">Cambiar clave</button>
</form>

<p><?php echo $mensaje; ?></p>

<a href="home.php">⬅ Volver al inicio</a>

</body>
</html>

<?php
session_start();
include("conexion.php");

// Verificar sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

// --- AGREGAR CLIENTE ---
if (isset($_POST["agregar"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];

    $sql = "INSERT INTO clientes (nombre, apellido, telefono, email) 
            VALUES ('$nombre', '$apellido', '$telefono', '$email')";
    mysqli_query($conexion, $sql);
}

// --- ELIMINAR CLIENTE ---
if (isset($_GET["eliminar"])) {
    $id = $_GET["eliminar"];
    mysqli_query($conexion, "DELETE FROM clientes WHERE id_cliente=$id");
}

// --- EDITAR CLIENTE ---
if (isset($_POST["editar"])) {
    $id = $_POST["id_cliente"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];

    $sql = "UPDATE clientes SET 
            nombre='$nombre', 
            apellido='$apellido', 
            telefono='$telefono', 
            email='$email'
            WHERE id_cliente=$id";
    mysqli_query($conexion, $sql);
}

// --- LISTAR CLIENTES ---
$resultado = mysqli_query($conexion, "SELECT * FROM clientes ORDER BY id_cliente DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión Clientes</title>
    <link rel="stylesheet" href="assets/estilo.css">
    <link rel="icon" href="assets/icono.ico">
</head>
<body>
    <h1>Gestión de Clientes 💉</h1>
    <a href="home.php">🏠 Volver al inicio</a> |
    <a href="logout.php">🚪 Cerrar sesión</a>

    <h2>Agregar nuevo cliente</h2>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Apellido" required>
        <input type="text" name="telefono" placeholder="Teléfono" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="agregar">Agregar</button>
    </form>

    <h2>Lista de clientes</h2>
    <table border="1" align="center" cellpadding="8" style="margin-top: 10px; background: #222; color: #fff;">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Fecha alta</th>
            <th>Acciones</th>
        </tr>

        <?php while($fila = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo $fila["id_cliente"]; ?></td>
            <td><?php echo $fila["nombre"]; ?></td>
            <td><?php echo $fila["apellido"]; ?></td>
            <td><?php echo $fila["telefono"]; ?></td>
            <td><?php echo $fila["email"]; ?></td>
            <td><?php echo $fila["fecha_alta"]; ?></td>
            <td>
                <!-- Botón Editar -->
                <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="id_cliente" value="<?php echo $fila['id_cliente']; ?>">
                    <input type="text" name="nombre" value="<?php echo $fila['nombre']; ?>" required>
                    <input type="text" name="apellido" value="<?php echo $fila['apellido']; ?>" required>
                    <input type="text" name="telefono" value="<?php echo $fila['telefono']; ?>" required>
                    <input type="email" name="email" value="<?php echo $fila['email']; ?>" required>
                    <button type="submit" name="editar">Editar</button>
                </form>
                <!-- Botón Eliminar -->
                <a href="clientes.php?eliminar=<?php echo $fila['id_cliente']; ?>" 
                   onclick="return confirm('¿Seguro que querés eliminar este cliente?')">🗑️</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

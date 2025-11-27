<?php
session_start();
include("conexion.php");

// Verificar sesión activa
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

// --- AGREGAR EMPLEADO ---
if (isset($_POST["agregar"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $especialidad = $_POST["especialidad"];
    $telefono = $_POST["telefono"];

    $sql = "INSERT INTO empleados (nombre, apellido, especialidad, telefono) 
            VALUES ('$nombre', '$apellido', '$especialidad', '$telefono')";
    mysqli_query($conexion, $sql);
}

// --- ELIMINAR EMPLEADO ---
if (isset($_GET["eliminar"])) {
    $id = $_GET["eliminar"];
    mysqli_query($conexion, "DELETE FROM empleados WHERE id_empleado=$id");
}

// --- EDITAR EMPLEADO ---
if (isset($_POST["editar"])) {
    $id = $_POST["id_empleado"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $especialidad = $_POST["especialidad"];
    $telefono = $_POST["telefono"];

    $sql = "UPDATE empleados SET 
            nombre='$nombre',
            apellido='$apellido',
            especialidad='$especialidad',
            telefono='$telefono'
            WHERE id_empleado=$id";
    mysqli_query($conexion, $sql);
}

// --- LISTAR EMPLEADOS ---
$resultado = mysqli_query($conexion, "SELECT * FROM empleados ORDER BY id_empleado DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión Empleados</title>
    <link rel="stylesheet" href="assets/estilo.css">
    <link rel="icon" href="assets/icono.ico">
</head>
<body>
    <h1>Gestión de Empleados 👩‍🎨</h1>
    <a href="home.php">🏠 Volver al inicio</a> |
    <a href="logout.php">🚪 Cerrar sesión</a>

    <h2>Agregar nuevo empleado</h2>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Apellido" required>
        <input type="text" name="especialidad" placeholder="Especialidad (tatuador, recepcionista...)" required>
        <input type="text" name="telefono" placeholder="Teléfono" required>
        <button type="submit" name="agregar">Agregar</button>
    </form>

    <h2>Lista de empleados</h2>
    <table border="1" align="center" cellpadding="8" style="margin-top: 10px; background: #222; color: #fff;">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Especialidad</th>
            <th>Teléfono</th>
            <th>Fecha Alta</th>
            <th>Acciones</th>
        </tr>

        <?php while($fila = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo $fila["id_empleado"]; ?></td>
            <td><?php echo $fila["nombre"]; ?></td>
            <td><?php echo $fila["apellido"]; ?></td>
            <td><?php echo $fila["especialidad"]; ?></td>
            <td><?php echo $fila["telefono"]; ?></td>
            <td><?php echo $fila["fecha_alta"]; ?></td>
            <td>
                <!-- Editar -->
                <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="id_empleado" value="<?php echo $fila['id_empleado']; ?>">
                    <input type="text" name="nombre" value="<?php echo $fila['nombre']; ?>" required>
                    <input type="text" name="apellido" value="<?php echo $fila['apellido']; ?>" required>
                    <input type="text" name="especialidad" value="<?php echo $fila['especialidad']; ?>" required>
                    <input type="text" name="telefono" value="<?php echo $fila['telefono']; ?>" required>
                    <button type="submit" name="editar">Editar</button>
                </form>

                <!-- Eliminar -->
                <a href="empleados.php?eliminar=<?php echo $fila['id_empleado']; ?>" 
                   onclick="return confirm('¿Seguro que querés eliminar este empleado?')">🗑️</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

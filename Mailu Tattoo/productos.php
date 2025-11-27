<?php
session_start();
include("conexion.php");

// Verificar si hay sesión activa
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

// --- AGREGAR PRODUCTO ---
if (isset($_POST["agregar"])) {
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];

    $sql = "INSERT INTO productos (nombre, tipo, stock, precio) 
            VALUES ('$nombre', '$tipo', '$stock', '$precio')";
    mysqli_query($conexion, $sql);
}

// --- ELIMINAR PRODUCTO ---
if (isset($_GET["eliminar"])) {
    $id = $_GET["eliminar"];
    mysqli_query($conexion, "DELETE FROM productos WHERE id_producto=$id");
}

// --- EDITAR PRODUCTO ---
if (isset($_POST["editar"])) {
    $id = $_POST["id_producto"];
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];

    $sql = "UPDATE productos SET 
            nombre='$nombre',
            tipo='$tipo',
            stock='$stock',
            precio='$precio'
            WHERE id_producto=$id";
    mysqli_query($conexion, $sql);
}

// --- LISTAR PRODUCTOS ---
$resultado = mysqli_query($conexion, "SELECT * FROM productos ORDER BY id_producto DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión Productos </title>
    <link rel="stylesheet" href="assets/estilo.css">
    <link rel="icon" href="assets/icono.ico">
</head>
<body>
    <h1>Gestión de Productos 🧴</h1>
    <a href="home.php">🏠 Volver al inicio</a> |
    <a href="logout.php">🚪 Cerrar sesión</a>

    <h2>Agregar nuevo producto</h2>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre del producto" required>
        <input type="text" name="tipo" placeholder="Tipo (ej: tinta, guante, aguja)" required>
        <input type="number" name="stock" placeholder="Stock" min="0" required>
        <input type="number" name="precio" placeholder="Precio" step="0.01" min="0" required>
        <button type="submit" name="agregar">Agregar</button>
    </form>

    <h2>Lista de productos</h2>
    <table border="1" align="center" cellpadding="8" style="margin-top: 10px; background: #222; color: #fff;">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Fecha Alta</th>
            <th>Acciones</th>
        </tr>

        <?php while($fila = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo $fila["id_producto"]; ?></td>
            <td><?php echo $fila["nombre"]; ?></td>
            <td><?php echo $fila["tipo"]; ?></td>
            <td><?php echo $fila["stock"]; ?></td>
            <td>$<?php echo number_format($fila["precio"], 2, ',', '.'); ?></td>
            <td><?php echo $fila["fecha_alta"]; ?></td>
            <td>
                <!-- Formulario Editar -->
                <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                    <input type="text" name="nombre" value="<?php echo $fila['nombre']; ?>" required>
                    <input type="text" name="tipo" value="<?php echo $fila['tipo']; ?>" required>
                    <input type="number" name="stock" value="<?php echo $fila['stock']; ?>" required>
                    <input type="number" step="0.01" name="precio" value="<?php echo $fila['precio']; ?>" required>
                    <button type="submit" name="editar">Editar</button>
                </form>

                <!-- Botón Eliminar -->
                <a href="productos.php?eliminar=<?php echo $fila['id_producto']; ?>" 
                   onclick="return confirm('¿Seguro que querés eliminar este producto?')">🗑️</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

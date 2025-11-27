<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Mailu Tattoo</title>
    <link rel="stylesheet" href="assets/estilo.css">
    <link rel="icon" href="assets/icono.ico">
    <style>
        .menu {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            margin-top: 40px;
        }
        .card {
            background: #222;
            border-radius: 12px;
            padding: 20px;
            width: 220px;
            text-align: center;
            box-shadow: 0 0 10px rgba(233,30,99,0.5);
            transition: 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
            background: #333;
        }
        .card img {
            width: 80px;
            margin-bottom: 10px;
        }
        .logout {
            margin-top: 30px;
        }
        h1 span {
            color: #e91e63;
        }
        
        .modificar {
            position: fixed;
            top: 20px;
            right: 20px;

            background: #ff0055;
            color: white;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 13px;
            text-decoration: none;
            font-weight: 600;

            box-shadow: 0 0 10px rgba(255,0,85,0.5);
            transition: all 0.2s ease;
        }

        .modificar:hover {
            transform: scale(1.05);
            box-shadow: 0 0 18px rgba(255,0,85,0.8);
        }
    </style>
</head>
<body>
    <img src="assets/logo.png" alt="Logo Mailu Tattoo" width="120">
    <h1>Bienvenido, <span><?php echo $_SESSION["usuario"]; ?></span> 👋</h1>
    <p>Panel principal del sistema de gestión de <b>Mailu Tattoo</b></p>

    <a href="cambiar_clave.php" class="modificar">
        🔒 Cambiar clave
    </a>

    <div class="menu">
        <a href="clientes.php" class="card">
            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png" alt="Clientes">
            <h3>Clientes</h3>
            <p>Ver, agregar o modificar clientes</p>
        </a>

        <a href="empleados.php" class="card">
            <img src="https://cdn-icons-png.flaticon.com/512/1995/1995574.png" alt="Empleados">
            <h3>Empleados</h3>
            <p>Gestionar tatuadores y personal</p>
        </a>

        <a href="productos.php" class="card">
            <img src="https://cdn-icons-png.flaticon.com/512/1055/1055646.png" alt="Productos">
            <h3>Productos</h3>
            <p>Control de tintas e insumos</p>
        </a>

    </div>

    <div class="logout">
        <a href="logout.php">🚪 Cerrar sesión</a>
    </div>
</body>
</html>

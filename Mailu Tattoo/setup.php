<?php
$server = "localhost";
$user   = "root";
$pass   = "";
$dbname = "tatuadora_db";

// 1. Conexión al servidor MySQL
$conn = new mysqli($server, $user, $pass);

if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// 2. Crear base de datos
$sql = "CREATE DATABASE IF NOT EXISTS $dbname 
        CHARACTER SET utf8mb4 
        COLLATE utf8mb4_general_ci";

if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    die("❌ Error al crear la base: " . $conn->error);
}

// 3. Conectarse a la base creada
$conn->select_db($dbname);

/* =========================
   TABLA: usuarios
========================= */
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL,
    clave VARCHAR(100) NOT NULL,
    rol ENUM('admin', 'empleado') DEFAULT 'empleado',
    fecha_alta DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB";

if (!$conn->query($sql)) {
    echo "❌ Error tabla usuarios: " . $conn->error . "<br>";
}

/* =========================
   TABLA: empleados
========================= */
$sql = "CREATE TABLE IF NOT EXISTS empleados (
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    especialidad VARCHAR(100),
    telefono VARCHAR(20),
    fecha_alta DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB";

if (!$conn->query($sql)) {
    echo "❌ Error tabla empleados: " . $conn->error . "<br>";
}

/* =========================
   TABLA: clientes
========================= */
$sql = "CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    telefono VARCHAR(20),
    email VARCHAR(100),
    fecha_alta DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB";

if (!$conn->query($sql)) {
    echo "❌ Error tabla clientes: " . $conn->error . "<br>";
}

/* =========================
   TABLA: productos
========================= */
$sql = "CREATE TABLE IF NOT EXISTS productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    tipo VARCHAR(50),
    stock INT,
    precio DECIMAL(10,2),
    fecha_alta DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB";

if (!$conn->query($sql)) {
    echo "❌ Error tabla productos: " . $conn->error . "<br>";
}


$conn->close();
?>

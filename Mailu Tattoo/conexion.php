<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "tatuadora_db";

$conexion = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
?>

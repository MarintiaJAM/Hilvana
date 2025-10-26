<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$servidor_bd   = "localhost";
$usuario_bd    = "root";
$contrasena_bd = "";
$nombre_bd     = "mi_base_datos";

$conexion = new mysqli($servidor_bd, $usuario_bd, $contrasena_bd, $nombre_bd);

if ($conexion->connect_error) {
    die("Error de conexión a MySQL: " . $conexion->connect_error);
}

if (!$conexion->set_charset("utf8mb4")) {
    die("Error al configurar UTF-8: " . $conexion->error);
}

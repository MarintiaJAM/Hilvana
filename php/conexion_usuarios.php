<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$servidor_bd   = "localhost";
$usuario_bd    = "root";
$contrasena_bd = "";
$nombre_bd     = "mi_base_datos";  // <-- Debe ser EXACTAMENTE este nombre (el de la BD que usas)

$conexion = new mysqli($servidor_bd, $usuario_bd, $contrasena_bd, $nombre_bd);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
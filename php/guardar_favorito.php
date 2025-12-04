<?php
session_start();
require "../config.php"; // tu conexión PDO a la base de datos

if (!isset($_POST['nombre'], $_POST['precio'], $_POST['imagen'])) {
    echo "error";
    exit;
}

// SI NO HAY USUARIO LOGEADO → usar id_usuario = 1 TEMPORAL
$id_usuario = 1;

$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$imagen = $_POST['imagen'];

// INSERTAR EN BASE DE DATOS
$sql = $conexion->prepare("INSERT INTO favoritos (id_usuario, nombre, precio, imagen) 
                           VALUES (?, ?, ?, ?)");
$sql->execute([$id_usuario, $nombre, $precio, $imagen]);

echo "ok";

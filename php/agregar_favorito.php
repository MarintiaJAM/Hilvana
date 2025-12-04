<?php
session_start();
require "config.php"; // conexión a jma_hilvana con PDO

$id_usuario = 1; // temporal
$id_producto = $_POST['id_producto'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$imagen = $_POST['imagen'];

// ¿Ya existe?
$sql = $conexion->prepare("SELECT id FROM favoritos WHERE id_usuario = ? AND id_producto = ?");
$sql->execute([$id_usuario, $id_producto]);

if ($sql->rowCount() > 0) {
    // Eliminar
    $del = $conexion->prepare("DELETE FROM favoritos WHERE id_usuario = ? AND id_producto = ?");
    $del->execute([$id_usuario, $id_producto]);
} else {
    // Agregar
    $add = $conexion->prepare("
        INSERT INTO favoritos (id_usuario, id_producto, fecha_agregado, nombre, precio, imagen)
        VALUES (?, ?, NOW(), ?, ?, ?)
    ");
    $add->execute([$id_usuario, $id_producto, $nombre, $precio, $imagen]);
}

header("Location: " . $_SERVER["HTTP_REFERER"]);
exit;
?>


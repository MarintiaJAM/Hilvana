<?php
session_start();
include 'conexion.php';

// Obtener los datos del producto
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$imagen = $_POST['imagen'];

// Revisar si ya existe ese producto en el carrito
$check = "SELECT * FROM carrito WHERE nombre='$nombre'";
$result = mysqli_query($conexion, $check);

if (mysqli_num_rows($result) > 0) {
    // Si ya existe, solo aumenta la cantidad
    $update = "UPDATE carrito SET cantidad = cantidad + 1 WHERE nombre='$nombre'";
    mysqli_query($conexion, $update);
} else {
    // Si no existe, lo agrega
    $insert = "INSERT INTO carrito (nombre, precio, imagen, cantidad) VALUES ('$nombre', '$precio', '$imagen', 1)";
    mysqli_query($conexion, $insert);
}

// Redirigir al carrito
header("Location: carrito.php");
exit();
?>

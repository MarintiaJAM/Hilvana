<?php
session_start();
include 'conexion.php'; // asegúrate de tener tu archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];

    // Inserta el producto al carrito
    $sql = "INSERT INTO carrito (nombre, precio, imagen, cantidad)
            VALUES ('$nombre', '$precio', '$imagen', 1)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Producto agregado al carrito 🛒');
            window.location.href='inicio.html';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

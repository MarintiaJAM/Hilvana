<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $sql = "DELETE FROM carrito WHERE id=$id";
    $conn->query($sql);
}

header("Location: carrito.php");
exit();
?>

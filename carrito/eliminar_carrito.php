<?php
include 'conexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM carrito WHERE id = $id";
    $conn->query($sql);
}

header("Location: carrito.php");
exit();
?>

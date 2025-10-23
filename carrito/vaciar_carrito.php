<?php
include 'conexion.php';
mysqli_query($conexion, "DELETE FROM carrito");
header("Location: carrito.php");
exit();
?>

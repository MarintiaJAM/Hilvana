<?php
session_start();
include 'conexion.php';

// Obtener los productos del carrito
$consulta = "SELECT * FROM carrito";
$resultado = mysqli_query($conexion, $consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras - JMA Hilvana</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>🛒 Tu Carrito</h1>

    <div class="carrito-container">
        <?php
        $total = 0;
        while ($producto = mysqli_fetch_assoc($resultado)) {
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $total += $subtotal;
        ?>
            <div class="carrito-item">
                <img src="<?php echo $producto['imagen']; ?>" width="100">
                <div>
                    <h3><?php echo $producto['nombre']; ?></h3>
                    <p>Precio: $<?php echo $producto['precio']; ?></p>
                    <p>Cantidad: <?php echo $producto['cantidad']; ?></p>
                    <p>Subtotal: $<?php echo $subtotal; ?></p>
                </div>
            </div>
        <?php } ?>
        <hr>
        <h2>Total: $<?php echo $total; ?></h2>
        <a href="vaciar_carrito.php" class="btn-vaciar">Vaciar carrito</a>
    </div>
</body>
</html>

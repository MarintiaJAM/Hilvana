<?php
$conexion = new mysqli("localhost", "root", "", "tienda_ropa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$id = intval($_GET['id'] ?? 0);

$sql = "SELECT productos.*, categorias.nombre_categoria 
        FROM productos 
        LEFT JOIN categorias ON productos.categoria_id = categorias.id_categoria
        WHERE productos.id_producto = $id";

$resultado = $conexion->query($sql);
$producto = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $producto['nombre_producto']; ?> - JMA HILVANA</title>
    <link rel="stylesheet" href="../buscador css/producto.css">
</head>
<body>

<div class="producto-detalle">
    <h1><?php echo $producto['nombre_producto']; ?></h1>
    <p><strong>Categoría:</strong> <?php echo $producto['nombre_categoria']; ?></p>
    <p><strong>Descripción:</strong> <?php echo $producto['descripcion']; ?></p>
    <p><strong>Talla:</strong> <?php echo $producto['talla']; ?></p>
    <p><strong>Color:</strong> <?php echo $producto['color']; ?></p>
    <p><strong>Precio:</strong> $<?php echo number_format($producto['precio'], 2); ?></p>

    <div class="galeria">
        <button class="nav-btn" id="prevBtn">&#10094;</button>
        <img id="galeria-img" src="<?php echo $producto['imagen_principal']; ?>" alt="Imagen del producto">
        <button class="nav-btn" id="nextBtn">&#10095;</button>
    </div>

    <a href="buscador.php" class="volver-btn">← Volver al buscador</a>
</div>

<script>
    const imagenes = [
        "<?php echo $producto['imagen_principal']; ?>",
        "<?php echo $producto['imagen_secundaria']; ?>"
    ];
    let indice = 0;

    const img = document.getElementById('galeria-img');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    prevBtn.addEventListener('click', () => {
        indice = (indice - 1 + imagenes.length) % imagenes.length;
        img.src = imagenes[indice];
    });

    nextBtn.addEventListener('click', () => {
        indice = (indice + 1) % imagenes.length;
        img.src = imagenes[indice];
    });
</script>

</body>
</html>

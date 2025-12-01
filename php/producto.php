<?php
// Conexión
$conexion = new mysqli("localhost", "root", "", "tienda_ropa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Validar id
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("Producto inválido.");
}

// Consultar producto
$sql = "SELECT productos.*, categorias.nombre_categoria 
        FROM productos 
        LEFT JOIN categorias ON productos.categoria_id = categorias.id_categoria
        WHERE productos.id_producto = $id";
$resultado = $conexion->query($sql);
if (!$resultado || $resultado->num_rows === 0) {
    die("Producto no encontrado.");
}
$producto = $resultado->fetch_assoc();

// Consultar tallas y colores disponibles
$tallas_res = $conexion->query("SELECT talla FROM producto_tallas WHERE id_producto = $id");
$colores_res = $conexion->query("SELECT color FROM producto_colores WHERE id_producto = $id");

$tallas = [];
$colores = [];
if ($tallas_res) {
    while ($fila = $tallas_res->fetch_assoc()) {
        $tallas[] = $fila['talla'];
    }
}
if ($colores_res) {
    while ($fila = $colores_res->fetch_assoc()) {
        $colores[] = $fila['color'];
    }
}

// Preparar imágenes
$imagenes = [];
if (!empty($producto['imagen_principal'])) {
    $imagenes[] = $producto['imagen_principal'];
}
if (!empty($producto['imagen_secundaria'])) {
    $imagenes[] = $producto['imagen_secundaria'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($producto['nombre_producto']); ?> - JMA HILVANA</title>
    <link rel="stylesheet" href="../buscador css/producto.css">
</head>
<body>

<div class="producto-detalle">
    <h1><?php echo htmlspecialchars($producto['nombre_producto']); ?></h1>
    <p><strong>Categoría:</strong> <?php echo htmlspecialchars($producto['nombre_categoria']); ?></p>
    <p><strong>Descripción:</strong> <?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></p>
    <p><strong>Precio:</strong> $<?php echo number_format((float)$producto['precio'], 2); ?></p>

    <!-- Galería: una imagen visible y botones para cambiar -->
    <div class="galeria">
        <button class="nav-btn" id="prevBtn" aria-label="Imagen anterior">&#10094;</button>
        <img id="galeria-img" src="<?php echo htmlspecialchars($imagenes[0] ?? ''); ?>" alt="Imagen del producto">
        <button class="nav-btn" id="nextBtn" aria-label="Imagen siguiente">&#10095;</button>
    </div>

    <!-- Selección de talla y color y agregar al carrito -->
    <form method="post" action="agregar_carrito.php" class="seleccion">
        <input type="hidden" name="id_producto" value="<?php echo (int)$producto['id_producto']; ?>">

        <label for="talla">Selecciona talla:</label>
        <select name="talla" id="talla" required>
            <?php if (count($tallas) > 0): ?>
                <?php foreach ($tallas as $t): ?>
                    <option value="<?php echo htmlspecialchars($t); ?>"><?php echo htmlspecialchars($t); ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">No disponible</option>
            <?php endif; ?>
        </select>

        <label for="color">Selecciona color:</label>
        <select name="color" id="color" required>
            <?php if (count($colores) > 0): ?>
                <?php foreach ($colores as $c): ?>
                    <option value="<?php echo htmlspecialchars($c); ?>"><?php echo htmlspecialchars($c); ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">No disponible</option>
            <?php endif; ?>
        </select>

        <button type="submit" class="carrito-btn">Agregar al carrito</button>
    </form>

    <a href="buscador.php" class="volver-btn">← Volver al buscador</a>
</div>

<script>
// Imágenes para la galería
const imagenes = <?php echo json_encode($imagenes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
let indice = 0;

const img = document.getElementById('galeria-img');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

function actualizarImagen() {
    if (imagenes.length > 0) {
        img.src = imagenes[indice];
    }
}

prevBtn.addEventListener('click', () => {
    if (imagenes.length === 0) return;
    indice = (indice - 1 + imagenes.length) % imagenes.length;
    actualizarImagen();
});

nextBtn.addEventListener('click', () => {
    if (imagenes.length === 0) return;
    indice = (indice + 1) % imagenes.length;
    actualizarImagen();
});
</script>

</body>
</html>

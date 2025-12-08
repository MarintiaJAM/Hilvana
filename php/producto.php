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
     <link rel="icon" type="image/png" class="logopestaña" href="../img/logo.jpg">
      <!-- 💅 Fuentes y estilos -->
    <!-- Fuente principal desde Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap">

    <!-- Librería de íconos Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="../buscador css/producto.css">
</head>
<body>

<div class="producto-container">
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


<div class="producto-precio-fav">
    <h2>$<?php echo number_format($producto['precio'], 2); ?></h2>

    <button class="btn-fav" onclick="toggleFav(this)">
        <i class="fa-regular fa-heart"></i> <!-- Vacío -->
    </button>
</div>


<script>
function toggleFav(btn) {
    const icon = btn.querySelector("i");

    if (icon.classList.contains("fa-regular")) {
        icon.classList.remove("fa-regular");
        icon.classList.add("fa-solid"); // ahora se rellena
    } else {
        icon.classList.remove("fa-solid");
        icon.classList.add("fa-regular"); // vuelve a vacío
    }
}
</script>



<p class="label">COLOR:</p>
<div class="colores-opciones">
    <?php foreach($colores as $c): ?>
        <button type="button" class="color-btn" data-color="<?php echo $c; ?>">
            <?php echo htmlspecialchars($c); ?>
        </button>
    <?php endforeach; ?>
</div>

<div class="galeria-miniaturas">
    <img src="<?php echo $producto['imagen_principal']; ?>" class="mini-img" onclick="cambiarImagen(this)">
    <img src="<?php echo $producto['imagen_secundaria']; ?>" class="mini-img" onclick="cambiarImagen(this)">
</div>

<script>
function cambiarImagen(elemento) {
    document.querySelector(".producto-imagen img").src = elemento.src;

    document.querySelectorAll(".mini-img").forEach(img => img.classList.remove("active"));
    elemento.classList.add("active");
}
</script>

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

<form method="post" action="agregar_carrito.php" id="formSeleccion">
    <input type="hidden" name="color" id="colorSeleccionado">
    <input type="hidden" name="talla" id="tallaSeleccionada">
    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
    <button type="submit" class="agregar-btn">AGREGAR</button>
</form>

<form method="get" action="../php/checkout.php">
    <input type="hidden" name="id_producto" value="<?php echo (int)$producto['id_producto']; ?>">
    <button type="submit" class="agregar-btn">COMPRAR</button>
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


<script>
// -------- MINIATURAS ----------
const thumbs = document.querySelectorAll('.thumb');
const principal = document.getElementById('galeria-img');

thumbs.forEach(t => {
    t.addEventListener('click', () => {
        document.querySelector('.thumb.activo').classList.remove('activo');
        t.classList.add('activo');
        principal.src = t.src;
    });
});

// -------- TALLA Y COLOR ----------
const tallaBtns = document.querySelectorAll('.talla-btn');
const colorBtns = document.querySelectorAll('.color-btn');

const tallaInput = document.getElementById('tallaSeleccionada');
const colorInput = document.getElementById('colorSeleccionado');

tallaBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('.talla-btn.seleccionado')?.classList.remove('seleccionado');
        btn.classList.add('seleccionado');
        tallaInput.value = btn.dataset.talla;
    });
});

colorBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('.color-btn.seleccionado')?.classList.remove('seleccionado');
        btn.classList.add('seleccionado');
        colorInput.value = btn.dataset.color;
    });
});
</script>
</div

</body>
</html>

<?php
$conexion = new mysqli("localhost", "root", "", "tienda_ropa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$query = $conexion->real_escape_string($_GET['query'] ?? '');
$categoria_id = $conexion->real_escape_string($_GET['categoria_id'] ?? '');
$talla = $conexion->real_escape_string($_GET['talla'] ?? '');
$color = $conexion->real_escape_string($_GET['color'] ?? '');

$condiciones = [];

if ($query !== '') {
    $condiciones[] = "(nombre_producto LIKE '%$query%' OR descripcion LIKE '%$query%')";
}
if ($categoria_id !== '') {
    $condiciones[] = "categoria_id = '$categoria_id'";
}
if ($talla !== '') {
    $condiciones[] = "talla = '$talla'";
}
if ($color !== '') {
    $condiciones[] = "color = '$color'";
}

$sql = "SELECT * FROM productos";
if (count($condiciones) > 0) {
    $sql .= " WHERE " . implode(" AND ", $condiciones);
}

$resultado = $conexion->query($sql);
$resultados = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $resultados[] = $fila;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscador - JMA HILVANA</title>
    
    <link rel="stylesheet" href="../buscador css/buscadorcss.css">
</head>
    
<body>
    <h1>Buscador de productos - JMA HILVANA</h1>
    <form method="get" action="buscador.php">
        <input type="text" name="query" placeholder="Buscar por nombre o descripción..." value="<?php echo htmlspecialchars($query); ?>">

        <select name="categoria_id">
            <option value="">Todas las categorías</option>
            <option value="1" <?php if ($categoria_id == '1') echo 'selected'; ?>>PLAYERAS</option>
            <option value="2" <?php if ($categoria_id == '2') echo 'selected'; ?>>CONJUNTOS</option>
            <option value="3" <?php if ($categoria_id == '3') echo 'selected'; ?>>VESTIDOS Y FALDAS</option>
            <option value="4" <?php if ($categoria_id == '4') echo 'selected'; ?>>PANTALONES Y SHORTS</option>
            <option value="5" <?php if ($categoria_id == '5') echo 'selected'; ?>>BLUSAS</option>
            <option value="6" <?php if ($categoria_id == '6') echo 'selected'; ?>>LICENCIAS</option>
            <option value="7" <?php if ($categoria_id == '7') echo 'selected'; ?>>SUDADERAS</option>
            <option value="8" <?php if ($categoria_id == '8') echo 'selected'; ?>>CHAMARRAS</option>
            <option value="9" <?php if ($categoria_id == '9') echo 'selected'; ?>>ACCESORIOS</option>
        </select>

        <select name="talla">
            <option value="">Todas las tallas</option>
            <option value="CH" <?php if ($talla == 'CH') echo 'selected'; ?>>CH</option>
            <option value="M" <?php if ($talla == 'M') echo 'selected'; ?>>M</option>
            <option value="G" <?php if ($talla == 'G') echo 'selected'; ?>>G</option>
            <option value="EG" <?php if ($talla == 'EG') echo 'selected'; ?>>EG</option>
            <option value="Única" <?php if ($talla == 'Única') echo 'selected'; ?>>Única</option>
        </select>

        <select name="color">
            <option value="">Todos los colores</option>
            <option value="Blanco" <?php if ($color == 'Blanco') echo 'selected'; ?>>Blanco</option>
            <option value="Azul" <?php if ($color == 'Azul') echo 'selected'; ?>>Azul</option>
            <option value="Azul y negro" <?php if ($color == 'Azul y negro') echo 'selected'; ?>>Azul y negro</option>
            <option value="Rosa y blanco" <?php if ($color == 'Rosa y blanco') echo 'selected'; ?>>Rosa y blanco</option>
        </select>

        <button type="submit">Buscar</button>
    </form>

    <?php if (isset($_GET['query']) || $categoria_id || $talla || $color): ?>
        <h2>Resultados de búsqueda</h2>
        <?php if (count($resultados) > 0): ?>
            <div class="resultados">
                <?php foreach ($resultados as $producto): ?>
                    <div class="producto">
                        <div class="imagen-container">
                            <img src="<?php echo $producto['imagen_principal']; ?>" alt="Imagen principal" class="imagen imagen-principal">
                            <img src="<?php echo $producto['imagen_secundaria']; ?>" alt="Imagen secundaria" class="imagen imagen-secundaria">
                        </div>
                        <div class="info">
                            <h3><?php echo $producto['nombre_producto']; ?></h3>
                            <p><?php echo $producto['descripcion']; ?></p>
                            <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
                            <a href="producto.php?id=<?php echo $producto['id_producto']; ?>" class="ver-btn">Ver</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php
$sql = "SELECT * FROM productos";
$resultado = $conexion->query($sql);

echo "<p>Total de productos encontrados: " . $resultado->num_rows . "</p>";
?>
        <?php else: ?>
            <p>No se encontraron resultados.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>

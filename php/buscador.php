<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "conexion_usuarios.php";

$conexion = new mysqli("localhost", "root", "", "tienda_ropa");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$query = $conexion->real_escape_string($_GET['query'] ?? '');
$categoria_id = $conexion->real_escape_string($_GET['categoria_id'] ?? '');
$color = $conexion->real_escape_string($_GET['color'] ?? '');
$talla = $conexion->real_escape_string($_GET['talla'] ?? '');

$condiciones = [];

if ($query !== '') {
    $condiciones[] = "(productos.nombre_producto LIKE '%$query%' OR productos.descripcion LIKE '%$query%')";
}
if ($categoria_id !== '') {
    $condiciones[] = "productos.categoria_id = '$categoria_id'";
}
if ($color !== '') {
    $condiciones[] = "producto_colores.color = '$color'";
}
if ($talla !== '') {
    $condiciones[] = "producto_tallas.talla = '$talla'";
}

$sql = "SELECT DISTINCT productos.*, categorias.nombre_categoria
        FROM productos
        LEFT JOIN categorias ON productos.categoria_id = categorias.id_categoria
        LEFT JOIN producto_tallas ON productos.id_producto = producto_tallas.id_producto
        LEFT JOIN producto_colores ON productos.id_producto = producto_colores.id_producto";

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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buscador</title>
  <link rel="icon" type="image/png" class="logopestaña" href="../img/logo.jpg">
      <!-- 💅 Fuentes y estilos -->
    <!-- Fuente principal desde Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap">

    <!-- Librería de íconos Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="../buscador css/buscadorcss.css">
    <link rel="stylesheet" href="../buscador css/header.css">
  <link rel="stylesheet" href="../menu lateral css/menu.css">

  <!--vinculacion con el Bot-->
    <script src="https://cdn.botpress.cloud/webchat/v2.3/inject.js"></script>
    <script src="https://files.bpcontent.cloud/2025/04/08/00/20250408004514-XCWJKZK6.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css">
   <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

</head>
<body>
 <!-- 🧭 ENCABEZADO PRINCIPAL -->
    <header>
        <!-- 🔸 Barra superior con anuncio -->
        <nav class="top-bar-anuncio">
            <p>Habilita nuestro bot para ayudarte en tu busqueda</p>
        </nav>

        <!-- 🔸 Menú de navegación principal -->
        <nav class="menu" id="Menu">

            <!-- Botón hamburguesa (☰) para abrir menú lateral en dispositivos pequeños -->
            <button class="hamburger-btn" id="hamburgerBtn">
                <i class="fas fa-bars"></i>
            </button>

            <!-- 🔹 Logo de la tienda -->
            <div class="logo">
                <a href="inicio.php">
                    <img src="../img/logo.jpg" alt="Logo">
                </a>
            </div>

            <!-- 🔹 Título centrado en la barra -->
            <div class="navbar-center">
                <h1>JMA HILVANA</h1>
            </div>
            
            <!-- 🔹 Sección superior con búsqueda, carrito y login -->
            <div class="top-bar">

                <!-- 🛒 Icono de carrito, enlaza con carrito.php -->
                <div class="car-shopping">
                    <a href="carrito.php" id="car-shopping-btn">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>

                <!-- Botón de Inicio de Sesión -->
                <div class="Login">
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <!-- Si el usuario YA inició sesión -->
                        <a href="perfil.php" class="login-button"> <i class="fas fa-user"></i></a>
                        <?php else: ?>
                        <!-- Si el usuario NO ha iniciado sesión -->
                        <a href="registrar.php" class="login-buton"> <i class="fas fa-user"></i></a>
                        <?php endif; ?>

                </div>

                <div class="favorites">
                    <button type="button" id="favorites-btn">
                        <i class="fa-solid fa-heart"></i>
                    </button>
                </div>
            </div>
        </nav>
        
        <!-- 🔸 MENÚ LATERAL (que se despliega al dar clic al botón hamburguesa) -->
        <div id="sideMenu" class="side-menu">
            <button class="close-btn" onclick="toggleSideMenu()">
                <i class="fas fa-times"></i>
            </button>
            <ul>
                <li><a href="inicio.html"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="#"><i class="fas fa-info-circle"></i> Guia de tallas</a></li>
                <li><a href="#"><i class="fas fa-tshirt"></i> Sobre nuestros productos</a></li>
                <li><a href="#"><i class="fas fa-info-circle"></i> Problemas</a></li>
                <li><a href="#"><i class="fas fa-phone"></i> Contacto</a></li>
                <li><a href="#"><i class="fas fa-info-circle"></i> Terminos y condiciones</a></li>
                <li><a href="#"><i class="fas fa-info-circle"></i> Privacidad</a></li>
                <div class="Bot" id="Habilitar_bot">
        <section>
    <button onclick="Habilitar_bot();" id="boton_bot">Habilitar bot</button>
</section>
</div>
</ul>
        </div>

        <!-- Fondo oscuro que aparece detrás del menú lateral -->
        <div id="overlay" class="overlay" onclick="toggleSideMenu()"></div>
    </header>

<div class="buscador-container">
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
                            <p><?php echo nl2br($producto['descripcion']); ?></p>
                            <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
                            <div class="btn-ver">
                                <a href="producto.php?id=<?php echo $producto['id_producto']; ?>" class="ver-btn">Ver</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
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

<script>
document.getElementById('categoria_id').addEventListener('change', function() {
    if (this.value == '12' || this.value == '8') {
        document.getElementById('extraCategoria').style.display = 'block';
    } else {
        document.getElementById('extraCategoria').style.display = 'none';
    }
});
</script>

</body>
<script src="../menujs/jsmenu.js"></script>
<script src="../JavaScript/bot.js"></script>

</html>


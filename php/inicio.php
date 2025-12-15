<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "conexion_usuarios.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- 🪶 Logo y título que aparece en la pestaña del navegador -->
    <title>JMA HILVANA</title>
    <link rel="icon" type="image/png" href="../img/logo.jpg">

    <!-- 💅 Fuentes y estilos -->
    <!-- Fuente principal desde Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap">

    <!-- Librería de íconos Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Enlaces a tus archivos CSS -->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../menu lateral css/menu.css">

</head>

<body>
    <!-- 🧭 ENCABEZADO PRINCIPAL -->
    <header>
        <!-- 🔸 Barra superior con anuncio -->
        <nav class="top-bar-anuncio">
            <p>Envío y devoluciones gratis a partir de $800 pesos mexicanos</p>
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

                <!-- 🔍 Barra de búsqueda -->
                <div class="search-bar">
                    <div class="search-container">
                        <button type="button" id="searchButton" onclick="window.location.href='../php/buscador.php'">
                            <i class="fas fa-search"></i>
                        </button>
                        <div class="search-suggestions" id="searchSuggestions"></div>
                    </div>
                </div>

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
                <!-- ❤ Botón de favoritos -->
               <div class="favorites">
    <a href="favoritos.php" id="favorites-btn">
        <i class="fa-solid fa-heart"></i>
    </a>
</div>

        
        <!-- 🔸 MENÚ LATERAL (que se despliega al dar clic al botón hamburguesa) -->
        <div id="sideMenu" class="side-menu">
            <button class="close-btn" onclick="toggleSideMenu()">
                <i class="fas fa-times"></i>
            </button>
            <ul>
              <li><a href="../php/inicio.php"><i class="fas fa-home"></i> Inicio</a></li>
              <li><a href="../Sitios extra/info.php?seccion=guia"><i class="fas fa-info-circle"></i> Guía de tallas</a></li>
              <li><a href="../Sitios extra/info.php?seccion=productos"><i class="fas fa-tshirt"></i> Sobre nuestros productos</a></li>
              <li><a href="../Sitios extra/info.php?seccion=problemas"><i class="fas fa-info-circle"></i> Problemas</a></li>
              <li><a href="../Sitios extra/info.php?seccion=contacto"><i class="fas fa-phone"></i> Contacto</a></li>
              <li><a href="../Sitios extra/info.php?seccion=terminos"><i class="fas fa-info-circle"></i> Términos y condiciones</a></li>
              <li><a href="../Sitios extra/info.php?seccion=privacidad"><i class="fas fa-info-circle"></i> Privacidad</a></li>
              <li><a href="../php/bitacora.php"><i class="fas fa-book"></i> Bitácora de cambios</a></li>
            </ul>
        </div>

        <!-- Fondo oscuro que aparece detrás del menú lateral -->
        <div id="overlay" class="overlay" onclick="toggleSideMenu()"></div>
    </header>

    <!-- 🖼 Sección de encabezado visual (puede usarse para banners o imágenes de portada) -->
    <section class="header">
        <section id="inicio">
            <h2 class="title"></h2>
        </section>
    </section>

    <!-- 🧵 SECCIÓN DE PRODUCTOS -->
    <div class="container">
        <section class="producto-container">

 <?php
$conexion = new mysqli("localhost", "root", "", "tienda_ropa");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT nombre_producto, precio, imagen_principal, imagen_secundaria FROM productos";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        ?>
        <!-- 🛍️ PRODUCTO -->
        <div class="producto">
            <div class="imagen-container">
                <img src="<?php echo $fila['imagen_principal']; ?>" 
                     alt="<?php echo $fila['nombre_producto']; ?>" 
                     class="imagen principal">
                <img src="<?php echo $fila['imagen_secundaria']; ?>" 
                     alt="<?php echo $fila['nombre_producto']; ?> secundaria" 
                     class="imagen secundaria">
                <button class="favorito"><i class="fa-regular fa-heart"></i></button>

                <!-- ⭐ FAVORITO FUNCIONAL -->
        <form action="agregar_favorito.php" method="POST">
            <input type="hidden" name="id_producto" value="2"> <!-- Cambia por el ID real -->
            <input type="hidden" name="nombre" value="Camisa Cross Ribbon Sailor Lace Collar V1 y V2">
            <input type="hidden" name="precio" value="350">
            <input type="hidden" name="imagen" value="../img/Cross Ribbon Sailor Lace Collar Blouse_ Dear My Love.jpg">
            <button type="submit" class="favorito">
                <i class="fa-regular fa-heart"></i>
            </button>
        </form>

                <form action="agregar_carrito.php" method="POST">
                    <input type="hidden" name="nombre" value="<?php echo $fila['nombre_producto']; ?>">
                    <input type="hidden" name="precio" value="<?php echo $fila['precio']; ?>">
                    <input type="hidden" name="imagen" value="<?php echo $fila['imagen_principal']; ?>">
                    <button type="submit" class="carrito">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                </form>
            </div>

            <!-- Información del producto -->
            <div class="info">
                <h3><?php echo $fila['nombre_producto']; ?></h3>
                <p class="precio">$<?php echo number_format($fila['precio'], 2); ?></p>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p>No hay productos disponibles.</p>";
}

$conexion->close();
?>
</section>
</div>

    <!-- 👠 PIE DE PÁGINA -->
    <footer class="footer">
        <div class="footer-top">
            <!-- Columna 1 -->
            <div class="footer-column">
                <h4>Servicio al cliente</h4>
                <ul>
                    <li><a href="#">Ayuda y contacto</a></li>
                    <li><a href="#">Cambios y devoluciones</a></li>
                    <li><a href="#">Pedidos</a></li>
                </ul>
            </div>

            <!-- Columna 2 -->
            <div class="footer-column">
                <h4>Sobre Nosotros</h4>
                <ul>
                    <li><a href="#">Nuestra historia</a></li>
                    <li><a href="#">Información de la corporación</a></li>
                </ul>
            </div>

            <!-- Columna 3 -->
            <div class="footer-column">
                <h4>Legal</h4>
                <ul>
                    <li><a href="#">Políticas de Privacidad</a></li>
                    <li><a href="#">Terminos y Condiciones</a></li>
                    <li><a href="#">Cookies</a></li>
                </ul>
            </div>
        </div>

        <!-- Parte inferior del pie -->
        <div class="footer-bottom">
            <div class="country-selector">
                <a href="#">Mexico</a> | <a href="#">Español</a>
            </div>
            <div class="copyright">
                &copy; 2025 JMA HILVANA. Todos los derechos reservados.
                </div>
            </div>
        </footer>

    <script src="../JavaScript/script.js"></script>
    <script src="../menujs/jsmenu.js"></script>


</body>
</html>
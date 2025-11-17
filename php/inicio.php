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
    <link rel="stylesheet" href="../css/boton.css">
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
                <a href="inicio.html">
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

                <!-- ❤️ Botón de favoritos -->
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
            </ul>
        </div>

        <!-- Fondo oscuro que aparece detrás del menú lateral -->
        <div id="overlay" class="overlay" onclick="toggleSideMenu()"></div>
    </header>

    <!-- 🖼️ Sección de encabezado visual (puede usarse para banners o imágenes de portada) -->
    <section class="header">
        <section id="inicio">
            <h2 class="title"></h2>
        </section>
    </section>

    <!-- 🧵 SECCIÓN DE PRODUCTOS -->
    <div class="container">
        <section class="producto-container">

            <!-- 🛍️ PRODUCTO 1 -->
            <div class="producto">
                <div class="imagen-container">
                    <!-- Imagen principal y secundaria para efecto hover -->
                    <img src="../img/Black and Dark Blue Ouji Shorts with Overlay.jpg" alt="Vkei1" class="imagen principal">
                    <img src="../img/c78ffdd6-c961-4909-a889-85566237c00e.jpg" alt="Vkei1.1" class="imagen secundaria">

                    <!-- Botón de favoritos -->
                    <button class="favorito">
                        <i class="fa-regular fa-heart"></i>
                    </button>

                    <!-- 🛒 Formulario para agregar al carrito -->
                    <form action="agregar_carrito.php" method="POST">
                        <input type="hidden" name="nombre" value="Conjunto de Ropa Estilo Vkei Azul y Negro">
                        <input type="hidden" name="precio" value="4000">
                        <input type="hidden" name="imagen" value="../img/Black and Dark Blue Ouji Shorts with Overlay.jpg">
                        <button type="submit" class="carrito">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </form>
                </div>

                <!-- Información del producto -->
                <div class="info">
                    <h3>Conjunto de Ropa Estilo Vkei Azul y Negro</h3>
                    <p class="precio">$4000</p>
                </div>
            </div>

            <!-- 🛍️ PRODUCTO 2 -->
            <div class="producto">
                <div class="imagen-container">
                    <img src="../img/Cross Ribbon Sailor Lace Collar Blouse_ Dear My Love.jpg" alt="Vkei2" class="imagen principal">
                    <img src="../img/dd667753-bc0c-48e5-858b-a4674f988da4.jpg" alt="Vkei2.1" class="imagen secundaria">
                    <button class="favorito"><i class="fa-regular fa-heart"></i></button>

                    <form action="agregar_carrito.php" method="POST">
                        <input type="hidden" name="nombre" value="Camisa Cross Ribbon Sailor Lace Collar V1 y V2">
                        <input type="hidden" name="precio" value="350">
                        <input type="hidden" name="imagen" value="../img/Cross Ribbon Sailor Lace Collar Blouse_ Dear My Love.jpg">
                        <button type="submit" class="carrito">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </form>
                </div>

                <div class="info">
                    <h3>Camisa Cross Ribbon Sailor Lace Collar V1 y V2</h3>
                    <p class="precio">$350</p>
                </div>
            </div>

            <!-- 🛍️ PRODUCTO 3 -->
            <div class="producto">
                <div class="imagen-container">
                    <img src="../img/8d6d4e4e-fef1-45b6-9a9f-4b89672b9bea.jpg" alt="Vkei3" class="imagen principal">
                    <img src="../img/a8fdb29f-06f2-45e3-ac2a-4c281dd735de.jpg" alt="Vkei3.1" class="imagen secundaria">
                    <button class="favorito"><i class="fa-regular fa-heart"></i></button>

                    <form action="agregar_carrito.php" method="POST">
                        <input type="hidden" name="nombre" value="Capa Azul Estilo Vkei V1 y V2">
                        <input type="hidden" name="precio" value="700">
                        <input type="hidden" name="imagen" value="../img/8d6d4e4e-fef1-45b6-9a9f-4b89672b9bea.jpg">
                        <button type="submit" class="carrito">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </form>
                </div>

                <div class="info">
                    <h3>Capa Azul Estilo Vkei V1 y V2</h3>
                    <p class="precio">$700</p>
                </div>
            </div>

            <!-- 🛍️ PRODUCTO 4 -->
            <div class="producto">
                <div class="imagen-container">
                    <img src="../img/c83d08db-3986-427c-9050-afb4ad899304.jpg" alt="Vkei4" class="imagen principal">
                    <img src="../img/descarga (5).jpg" alt="Vkei4.1" class="imagen secundaria">
                    <button class="favorito"><i class="fa-regular fa-heart"></i></button>

                    <form action="agregar_carrito.php" method="POST">
                        <input type="hidden" name="nombre" value="Cuello de Holanes Rosa Blanca, Moño Negro">
                        <input type="hidden" name="precio" value="150">
                        <input type="hidden" name="imagen" value="../img/c83d08db-3986-427c-9050-afb4ad899304.jpg">
                        <button type="submit" class="carrito">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </form>
                </div>

                <div class="info">
                    <h3>Cuello de Holanes Rosa Blanca, Moño Negro</h3>
                    <p class="precio">$150</p>
                </div>
            </div>

        </section>
    </div>

    <!-- PIE DE PÁGINA -->
    <footer class="footer">
        <div class="footer-top">
            <!-- Columna 1 -->
            <div class="footer-column">
                <h4>Customer Service</h4>
                <ul>
                    <li><a href="#">Help & Contact</a></li>
                    <li><a href="#">Returns & Exchanges</a></li>
                    <li><a href="#">Shipping Info</a></li>
                    <li><a href="#">Order Tracking</a></li>
                </ul>
            </div>

            <!-- Columna 2 -->
            <div class="footer-column">
                <h4>About Us</h4>
                <ul>
                    <li><a href="#">Our Story</a></li>
                    <li><a href="#">Sustainability</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Corporate Info</a></li>
                </ul>
            </div>

            <!-- Columna 3 -->
            <div class="footer-column">
                <h4>Legal</h4>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
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
    <!-- Botón para subir -->
<button id="btnSubir" title="Ir arriba">
  ↑
</button>


</body>
</html>

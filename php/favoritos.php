<?php
/******************************************************
 * FAVORITOS.PHP
 * Funciona igual que carrito.php pero para favoritos.
 * Usa únicamente $_SESSION para almacenar productos.
 ******************************************************/

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ✅ Inicializar favoritos si no existe
if (!isset($_SESSION['favoritos'])) {
    $_SESSION['favoritos'] = [];
}

/******************************************************
 * ✅ ELIMINAR UN FAVORITO INDIVIDUAL
 ******************************************************/
if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar' && isset($_POST['index'])) {

    $index = $_POST['index'];

    if (isset($_SESSION['favoritos'][$index])) {
        unset($_SESSION['favoritos'][$index]);
        $_SESSION['favoritos'] = array_values($_SESSION['favoritos']); // Reindexar
    }

    header("Location: favoritos.php");
    exit;
}

/******************************************************
 * ✅ VACIAR TODOS LOS FAVORITOS
 ******************************************************/
if (isset($_POST['accion']) && $_POST['accion'] === 'vaciar_favoritos') {

    unset($_SESSION['favoritos']);

    header("Location: favoritos.php");
    exit;
}

// ✅ Obtener favoritos actuales
$favoritos = $_SESSION['favoritos'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos - JMA Hilvana</title>
    <link rel="icon" type="image/png" href="../img/logo.jpg">

    <!-- Estilos -->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/carrito.css">
    <link rel="stylesheet" href="../menu lateral css/menu.css">

    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header>
    <nav class="top-bar-anuncio">
        <p>Envío y devoluciones gratis a partir de $800 pesos mexicanos</p>
    </nav>

    <nav class="menu" id="Menu">
        <button class="hamburger-btn" id="hamburgerBtn">
            <i class="fas fa-bars"></i>
        </button>

        <div class="logo">
            <a href="inicio.php">
                <img src="../img/logo.jpg" alt="Logo">
            </a>
        </div>

        <div class="navbar-center">
            <h1>JMA HILVANA</h1>
        </div>

        <div class="top-bar">
            <div class="search-bar">
                <div class="search-container">
                    <button type="button" id="searchButton" onclick="window.location.href='../php/buscador.php'">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="car-shopping">
                <a href="carrito.php" id="car-shopping-btn">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>

            <div class="Login">
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <a href="perfil.php" class="login-button"><i class="fas fa-user"></i></a>
                <?php else: ?>
                    <a href="registrar.php" class="login-buton"><i class="fas fa-user"></i></a>
                <?php endif; ?>
            </div>

            <div class="favorites">
                <a href="favoritos.php" class="favorites">
                    <i class="fa-solid fa-heart"></i>
                </a>
            </div>
        </div>
    </nav>
</header>

<section class="favoritos-layout">

    <!-- IZQUIERDA: LISTA DE FAVORITOS -->
    <div class="favoritos-left">

        <h2 style="font-weight:700; color:#333;">❤ Tus Favoritos</h2>

        <?php if (empty($favoritos)): ?>
            <p style="text-align:center;">No tienes productos en favoritos. ❤</p>

        <?php else: ?>

            <?php foreach ($favoritos as $index => $producto): ?>
                <div class="producto-card">

                    <!-- Información del producto -->
                    <div class="producto-info">
                        <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                        <div class="producto-texto">
                            <h3><?= htmlspecialchars($producto['nombre']) ?></h3>
                            <span>$<?= htmlspecialchars($producto['precio']) ?></span>
                        </div>
                    </div>

                    <!-- Botón eliminar -->
                    <form method="POST">
                        <input type="hidden" name="index" value="<?= $index ?>">
                        <input type="hidden" name="accion" value="eliminar">
                        <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>

                </div>
            <?php endforeach; ?>

            <!-- Botones inferiores -->
            <div class="favoritos-botones">
                <form method="POST">
                    <input type="hidden" name="accion" value="vaciar_favoritos">
                    <button type="submit" class="btn-vaciar">Vaciar Favoritos</button>
                </form>

                <a href="inicio.php">
                    <button type="button" class="btn-seguir">Seguir Viendo Productos</button>
                </a>
            </div>

        <?php endif; ?>
    </div>

    <!-- DERECHA: INFORMACIÓN DE CUENTA -->
    <div class="favoritos-right">
        <h2>Tu cuenta</h2>
        <p>Para guardar tus prendas y realizar compras, inicia sesión o crea una cuenta.</p>
        <a href="registrar.php" class="btn-fav-crear">Crear cuenta</a>
        <a href="registrar.php" class="btn-fav-acceder">Acceder</a>
    </div>

</section>

<footer class="footer">
    <div class="footer-top">
        <div class="footer-column">
            <h4>Servicio al cliente</h4>
            <ul>
                <li><a href="#">Ayuda y contacto</a></li>
                <li><a href="#">Cambios y devoluciones</a></li>
                <li><a href="#">Pedidos</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h4>Sobre Nosotros</h4>
            <ul>
                <li><a href="#">Nuestra historia</a></li>
                <li><a href="#">Información de la corporación</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h4>Legal</h4>
            <ul>
                <li><a href="#">Políticas de Privacidad</a></li>
                <li><a href="#">Terminos y Condiciones</a></li>
                <li><a href="#">Cookies</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="country-selector">
            <a href="#">Mexico</a> | <a href="#">Español</a>
        </div>
        <div class="copyright">
            &copy; 2025 JMA HILVANA. Todos los derechos reservados.
        </div>
    </div>
</footer>

<script src="../menujs/jsmenu.js"></script>

</body>
</html>

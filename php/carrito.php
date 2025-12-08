<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "conexion_usuarios.php";
require_once "conexion_usuarios.php";

// 🛒 Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Vaciar carrito
if (isset($_POST['accion']) && $_POST['accion'] === 'vaciar') {
    unset($_SESSION['carrito']);
    header("Location: carrito.php");
    exit;
}

// Eliminar producto individual
if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar' && isset($_POST['index'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['carrito'][$index])) {
        unset($_SESSION['carrito'][$index]);
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
    header("Location: carrito.php");
    exit;
}

$carrito = $_SESSION['carrito'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - JMA Hilvana</title>
    <link rel="icon" type="image/png" href="../img/logo.jpg">

    <!-- Estilos del menú -->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/carrito.css">
    <link rel="stylesheet" href="../menu lateral css/menu.css">

    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

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
                    <button type="button" id="searchButton">
                        <i class="fas fa-search"></i>
                    </button>
                    <div class="search-suggestions" id="searchSuggestions"></div>
                </div>
            </div>

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
                <a href="favoritos.php" class="favorites">
                     <i class="fa-solid fa-heart"></i>
                </button>
            </div>
        </div>
    </nav>

    <div id="sideMenu" class="side-menu">
        <button class="close-btn" onclick="toggleSideMenu()">
            <i class="fas fa-times"></i>
        </button>
        <ul>
            <li><a href="inicio.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="#"><i class="fas fa-tshirt"></i> Productos</a></li>
            <li><a href="#"><i class="fas fa-info-circle"></i> Nosotros</a></li>
            <li><a href="#"><i class="fas fa-phone"></i> Contacto</a></li>
        </ul>
    </div>
    <div id="overlay" class="overlay" onclick="toggleSideMenu()"></div>
</header>

<!-- Contenido del carrito -->
<section class="carrito-layout">

    <!-- IZQUIERDA: Prendas -->
    <div class="carrito-izquierda">

        <h2 style="font-weight:700; color:#333;">🛒 Tu Carrito</h2>

        <?php if (empty($_SESSION['carrito'])): ?>
            <p>Tu carrito está vacío.</p>
        <?php else: ?>
            <?php foreach ($_SESSION['carrito'] as $index => $producto): ?>
                <div class="producto-card">
                    <div class="producto-info">
                        <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Producto">
                        <div class="producto-texto">
                            <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                            <span>$<?php echo htmlspecialchars($producto['precio']); ?></span>
                        </div>
                    </div>

                    <form method="POST" action="">
                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                        <input type="hidden" name="accion" value="eliminar">
                        <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="carrito-botones">
            <form method="POST" action="">
                <input type="hidden" name="accion" value="vaciar">
                <button type="submit" class="btn-vaciar">Vaciar Carrito</button>
            </form>

            <a href="inicio.php">
                <button type="button" class="btn-seguir">Seguir Comprando</button>
            </a>
        </div>
    </div>

    <!-- DERECHA: Total -->
    <div class="carrito-derecha">

        <?php 
            $total = 0;
            foreach ($_SESSION['carrito'] as $p) {
                $total += $p['precio'];
            }
        ?>

        <div class="total-box">
            <h3>Total del Carrito</h3>
            <p class="total-precio">$<?php echo number_format($total, 2); ?></p>
            <button class="btn-pagar">Ir a pagar</button>
        </div>

    </div>

</section>

<script src="../JavaScript/script.js"></script>
<script src="../menujs/jsmenu.js"></script>

</html>

<?php
session_start();
require_once "config.php"; // Conexión a jma_hilvana

$id_usuario = 1; // Temporal

// Traer favoritos del usuario
$sql = $conexion->prepare("SELECT * FROM favoritos WHERE id_usuario = ?");
$sql->execute([$id_usuario]);
$favoritos = $sql->fetchAll(PDO::FETCH_ASSOC);

// Eliminar favorito
if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar' && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    $sql = $conexion->prepare("DELETE FROM favoritos WHERE id_usuario = ? AND id_producto = ?");
    $sql->execute([$id_usuario, $id_producto]);
    header("Location: favoritos.php");
    exit;
}

// Vaciar favoritos
if (isset($_POST['accion']) && $_POST['accion'] === 'vaciar_favoritos') {
    $sql = $conexion->prepare("DELETE FROM favoritos WHERE id_usuario = ?");
    $sql->execute([$id_usuario]);

    header("Location: favoritos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos - JMA Hilvana</title>
    <link rel="icon" type="image/png" href="../img/logo.jpg">

    <!-- Estilos del menú -->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/carrito.css"> <!-- Aquí irá tu nuevo CSS -->
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

            <div class="Login">
                <a href="registrar.php" class="login-button">
                    <i class="fas fa-user"></i>
                </a>
            </div>

            <div class="favorites">
                <button type="button" id="favorites-btn">
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


<!-- ===========================================================
                NUEVA ESTRUCTURA DE FAVORITOS
=========================================================== -->

<section class="favoritos-layout">

    <!-- -------- LISTA IZQUIERDA ---------- -->
    <div class="favoritos-left">

        <?php if (empty($favoritos)): ?>

            <p style="text-align:center;">No tienes productos en favoritos. ❤</p>

        <?php else: ?>

            <?php foreach ($favoritos as $producto): ?>

                <div class="producto-card">
                    <div class="producto-info">
                        <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                        <div class="producto-texto">
                            <h3><?= htmlspecialchars($producto['nombre']) ?></h3>
                            <span>$<?= htmlspecialchars($producto['precio']) ?></span>
                        </div>
                    </div>

                    <form method="POST" action="">
                        <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
                        <input type="hidden" name="accion" value="eliminar">
                        <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>
                </div>

            <?php endforeach; ?>

            <div class="favoritos-botones">
                <form method="POST" action="">
                    <input type="hidden" name="accion" value="vaciar_favoritos">
                    <button type="submit" class="btn-vaciar">Vaciar Favoritos</button>
                </form>

                <a href="inicio.php">
                    <button type="button" class="btn-seguir">Seguir Viendo Productos</button>
                </a>
            </div>

        <?php endif; ?>

    </div>

    <!-- -------- COLUMNA DERECHA ---------- -->
    <div class="favoritos-right">
        <h2>Tu cuenta</h2>
        <p>Para guardar tus prendas y realizar compras, inicia sesión o crea una cuenta.</p>
    <a href="registrar.php">
    <a href="registrar.php" class="btn-fav-crear">Crear cuenta</a>
<a href="registrar.php">
        <a href="registrar.php" class="btn-fav-acceder">Acceder</a>
    </div>

</section>

<script src="../JavaScript/script.js"></script>
<script src="../menujs/jsmenu.js"></script>

</body>
</html>

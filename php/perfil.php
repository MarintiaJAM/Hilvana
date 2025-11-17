<?php
if (session_status() == PHP_SESSION_NONE) {
  //Si el usuario no tiene sesión, la iniciamos
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: iniciar_sesion.php");
    exit;
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
}

require_once "conexion_usuarios.php";

$usuario_id = $_SESSION['usuario_id'];

// ✅ Incluimos también el campo 'foto' en la consulta
$sql = "SELECT nombre, correo, foto, rol FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$rol_usuario    = $_SESSION["usuario_rol"];

// Si el usuario no tiene foto, usar la imagen por defecto
if (empty($usuario['foto'])) {
    $usuario['foto'] = "imagenes/default.png";
}

// Ejemplos de datos
$compras = [
    ["producto" => "Camiseta blanca poison", "precio" => 25],
    ["producto" => "Pantalón negro", "precio" => 40]
];

$favoritos = [
    ["producto" => "Vestido floral", "precio" => 35],
    ["producto" => "Chaqueta de cuero", "precio" => 80]
];

$carrito = [
    ["producto" => "Zapatillas deportivas", "precio" => 60],
    ["producto" => "Gorra", "precio" => 15]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perfil</title>
  <link rel="icon" type="image/png" class="logopestaña" href="../img/logo.jpg">
      <!-- 💅 Fuentes y estilos -->
    <!-- Fuente principal desde Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap">

    <!-- Librería de íconos Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <link rel="stylesheet" href="../css/perfil.css" />
  <link rel="stylesheet" href="../css/navbar.css" />
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
        </nav>
        
        <!-- 🔸 MENÚ LATERAL (que se despliega al dar clic al botón hamburguesa) -->
        <div id="sideMenu" class="side-menu">
            <button class="close-btn" onclick="toggleSideMenu()">
                <i class="fas fa-times"></i>
            </button>
            <ul>
                <li><a href="inicio.html"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="#"><i class="fas fa-tshirt"></i> Productos</a></li>
                <li><a href="#"><i class="fas fa-info-circle"></i> Nosotros</a></li>
                <li><a href="#"><i class="fas fa-phone"></i> Contacto</a></li>
            </ul>
        </div>

        <!-- Fondo oscuro que aparece detrás del menú lateral -->
        <div id="overlay" class="overlay" onclick="toggleSideMenu()"></div>
    </header>

<div class="user-profile">
  <div class="profile-header">

    <!-- 🖼️ Foto de perfil -->
    <div class="foto-container">
      <img src="<?= htmlspecialchars($usuario['foto']) ?>" alt="Foto de perfil" class="profile-pic" />

      <!-- 📸 Formulario para cambiar foto -->
      <form action="subir_foto.php" method="POST" enctype="multipart/form-data" class="foto-form">
        <label for="foto" class="cambiar-foto-btn">Cambiar foto</label>
        <input type="file" name="foto" id="foto" accept="image/*" onchange="this.form.submit()" hidden>
      </form>
    </div>

    <!-- Información del usuario -->
    <div class="user-info">
      <h2><?= htmlspecialchars($usuario['nombre']) ?></h2>
      <p><?= htmlspecialchars($usuario['correo']) ?></p>
      <small> Rol: <?= htmlspecialchars($rol_usuario) ?></small>
    </div>
  </div>


<!-- BASES DE DATOS PARA ADMINISTRADORES -->
<?php if ($usuario['rol'] === 'admin'): ?>
  <div class="admin-panel">
    <a href="editar.php?id=<?= (int)$usuario_id ?>" class="admin-btn">Editar Perfil</a>
    <a href="eliminar.php?id=<?= (int)$usuario_id ?>" class="admin-btn" onclick="return confirm('¿Seguro de eliminar tu cuenta?');">Eliminar Perfil</a>
    <a href="admin_panel.php" class="admin-btn">Usuarios registrados</a>
    <a href="salir.php" class="admin-btn">Cerrar Sesión</a>
  </div>
<?php else: ?>
  <!-- BOTONES DE USUARIO NORMAL -->
  <div class="admin-panel">
    <a href="editar.php?id=<?= (int)$usuario_id ?>" class="admin-btn">Editar Perfil</a>
    <a href="eliminar.php?id=<?= (int)$usuario_id ?>" class="admin-btn" onclick="return confirm('¿Seguro de eliminar tu cuenta?');">Eliminar Perfil</a>
    <a href="salir.php" class="admin-btn">Cerrar Sesión</a>
  </div>
<?php endif; ?>



  <!-- Pestañas -->
  <div class="profile-tabs">
    <button class="tab-btn active" data-tab="compras">🛍️ Mis compras</button>
    <button class="tab-btn" data-tab="favoritos">❤️ Favoritos</button>
    <button class="tab-btn" data-tab="carrito">🛒 Carrito</button>
  </div>

  <!-- COMPRAS -->
  <div class="tab-content active" id="compras">
    <h3>Historial de compras</h3>
    <ul>
      <?php foreach($compras as $item): ?>
        <li><?= htmlspecialchars($item['producto']) ?> - $<?= htmlspecialchars($item['precio']) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- FAVORITOS -->
  <div class="tab-content" id="favoritos">
    <h3>Favoritos</h3>
    <ul>
      <?php foreach($favoritos as $item): ?>
        <li><?= htmlspecialchars($item['producto']) ?> - $<?= htmlspecialchars($item['precio']) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- CARRITO -->
  <div class="tab-content" id="carrito">
    <h3>Carrito</h3>
    <ul>
      <?php foreach($carrito as $item): ?>
        <li><?= htmlspecialchars($item['producto']) ?> - $<?= htmlspecialchars($item['precio']) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<script src="../JavaScript/perfil.js"></script>
<script src="../menujs/jsmenu.js"></script>
</body>
</html>

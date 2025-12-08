<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: iniciar_sesion.php");
    exit;
}

require_once "conexion_usuarios.php";

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT nombre, correo, foto, rol FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$rol_usuario = $_SESSION["usuario_rol"];

if (empty($usuario['foto'])) {
    $usuario['foto'] = "imagenes/default.png";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perfil</title>

  <link rel="icon" type="image/png" class="logopestaña" href="../img/logo.jpg">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <link rel="stylesheet" href="../css/perfil.css" />
  <link rel="stylesheet" href="../css/navbar.css" />
  <link rel="stylesheet" href="../menu lateral css/menu.css">
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
                    <div class="search-suggestions" id="searchSuggestions"></div>
                </div>
            </div>
    </nav>

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

    <div id="overlay" class="overlay" onclick="toggleSideMenu()"></div>
</header>

<div class="user-profile">
  <div class="profile-header">

    <div class="foto-container">
      <img src="<?= htmlspecialchars($usuario['foto']) ?>" alt="Foto de perfil" class="profile-pic" />

      <form action="subir_foto.php" method="POST" enctype="multipart/form-data" class="foto-form">
        <label for="foto" class="cambiar-foto-btn">Cambiar foto</label>
        <input type="file" name="foto" id="foto" accept="image/*" onchange="this.form.submit()" hidden>
      </form>
    </div>

    <div class="user-info">
      <h2><?= htmlspecialchars($usuario['nombre']) ?></h2>
      <p><?= htmlspecialchars($usuario['correo']) ?></p>
      <small> Rol: <?= htmlspecialchars($rol_usuario) ?></small>
    </div>
  </div>

<?php if ($usuario['rol'] === 'admin'): ?>
  <div class="admin-panel">
    <a href="editar.php?id=<?= (int)$usuario_id ?>" class="admin-btn">Editar Perfil</a>
    <a href="eliminar.php?id=<?= (int)$usuario_id ?>" class="admin-btn" onclick="return confirm('¿Seguro de eliminar tu cuenta?');">Eliminar Perfil</a>
    <a href="admin_panel.php" class="admin-btn">Usuarios registrados</a>
    <a href="salir.php" class="admin-btn">Cerrar Sesión</a>
  </div>
<?php else: ?>
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

  <!-- CONTENIDO DE PESTAÑAS -->
  
  <!-- MIS COMPRAS -->
  <div class="tab-content active" id="compras">
      <h3>Historial de compras</h3>
      <?php include "../minis/checkout_mini.php"; ?>
  </div>

  <!-- FAVORITOS -->
  <div class="tab-content" id="favoritos">
      <h3>Favoritos</h3>
      <?php include "../minis/favoritos_mini.php"; ?>
  </div>

  <!-- CARRITO -->
  <div class="tab-content" id="carrito">
      <h3>Carrito</h3>
      <?php include "../minis/carrito_mini.php"; ?>
  </div>

</div>

<script src="../JavaScript/perfil.js"></script>
<script src="../menujs/jsmenu.js"></script>
</body>
</html>

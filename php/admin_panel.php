<?php
require_once "conexion_usuarios.php";

/* Verificar sesión activa */
if (!isset($_SESSION["usuario_id"])) {
    header("Location: iniciar_sesion.php");
    exit;
}

/* Variables del usuario actual */
$nombre_usuario = $_SESSION["usuario_nombre"];
$correo_usuario = $_SESSION["usuario_correo"];
$rol_usuario    = $_SESSION["usuario_rol"];

/* Si es administrador, consulta todos los usuarios */
if ($rol_usuario === "admin") {
    $consulta = $conexion->query(
        "SELECT id, nombre, correo, creado_en
         FROM usuarios
         ORDER BY id DESC"
    );
} else {
    /* Si es usuario normal, consulta solo su propia cuenta */
    $id_usuario = (int)$_SESSION["usuario_id"];
    $consulta = $conexion->query(
        "SELECT id, nombre, correo, creado_en
         FROM usuarios
         WHERE id = $id_usuario"
    );
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Zona privada</title>
  <link rel="stylesheet" href="../css/estilo.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="contenedor">
    <div class="tarjeta">
      <div class="encabezado">
        <h1>Zona privada</h1>
      </div>
      <p class="sub">
        Bienvenido, <strong><?= htmlspecialchars($nombre_usuario) ?></strong> 
        (<?= htmlspecialchars($correo_usuario) ?>)
        <br>
        <small>Rol: <?= htmlspecialchars($rol_usuario) ?></small>
      </p>

      <!-- Navegación -->
      <p class="nav">
        <?php if ($rol_usuario === "admin"): ?>
          <a href="registrar.php">Crear usuario</a>
        <?php endif; ?>
        <a href="inicio.php">Inicio</a>
        <a href="salir.php">Cerrar sesión</a>
      </p>

      <hr class="hr">

      <?php if ($rol_usuario === "admin"): ?>
        <h2>Usuarios registrados</h2>
      <?php else: ?>
        <h2>Tu información</h2>
      <?php endif; ?>

      <?php if ($consulta && $consulta->num_rows > 0): ?>
        <table class="tabla">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Creado</th>
              <?php if ($rol_usuario === "admin"): ?>
                <th>Acciones</th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php while ($fila = $consulta->fetch_assoc()): ?>
              <tr>
                <td><?= (int)$fila["id"] ?></td>
                <td><?= htmlspecialchars($fila["nombre"]) ?></td>
                <td><?= htmlspecialchars($fila["correo"]) ?></td>
                <td><?= htmlspecialchars($fila["creado_en"]) ?></td>

                <?php if ($rol_usuario === "admin"): ?>
                  <td class="filas-acciones">
                    <a href="editar.php?id=<?= (int)$fila['id'] ?>">Editar</a>
                    <a href="eliminar.php?id=<?= (int)$fila['id'] ?>" onclick="return confirm('¿Seguro de eliminar?');">Eliminar</a>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p class="mensaje mensaje--error">No hay usuarios registrados.</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>

<?php
require_once "conexion.php";

/* Verificar sesión activa */
if (!isset($_SESSION["usuario_id"])) {
    header("Location: iniciar_sesion.php");
    exit;
}

$nombre_usuario = $_SESSION["usuario_nombre"];
$correo_usuario = $_SESSION["usuario_correo"];

/* Consultar lista de usuarios */
$consulta = $conexion->query(
    "SELECT id, nombre, correo, creado_en
     FROM usuarios
     ORDER BY id DESC"
);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Zona privada</title>
  <link rel="stylesheet" href="estilo.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="contenedor">
    <div class="tarjeta">
      <div class="encabezado">
        <h1>Zona privada</h1>
      </div>
      <p class="sub">Bienvenido, <strong><?= htmlspecialchars($nombre_usuario) ?></strong> (<?= htmlspecialchars($correo_usuario) ?>)</p>

      <!-- Navegación -->
      <p class="nav">
        <a href="registrar.php">Crear usuario</a>
        <a href="privado.php">Inicio</a>
        <a href="salir.php">Cerrar sesión</a>
      </p>

      <hr class="hr">

      <h2>Usuarios registrados</h2>

      <?php if ($consulta && $consulta->num_rows > 0): ?>
        <table class="tabla">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Creado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($fila = $consulta->fetch_assoc()): ?>
              <tr>
                <td><?= (int)$fila["id"] ?></td>
                <td><?= htmlspecialchars($fila["nombre"]) ?></td>
                <td><?= htmlspecialchars($fila["correo"]) ?></td>
                <td><?= htmlspecialchars($fila["creado_en"]) ?></td>
                <td class="filas-acciones">
                  <a href="editar.php?id=<?= (int)$fila['id'] ?>">Editar</a>
                  <a href="eliminar.php?id=<?= (int)$fila['id'] ?>" onclick="return confirm('¿Seguro de eliminar?');">Eliminar</a>
                </td>
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
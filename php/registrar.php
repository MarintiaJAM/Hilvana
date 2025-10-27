<?php
require_once "conexion_usuarios.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre     = trim($_POST["nombre"] ?? "");
    $correo     = trim($_POST["correo"] ?? "");
    $contrasena = $_POST["contrasena"] ?? "";

    if ($nombre === "" || $correo === "" || $contrasena === "") {
        $mensaje = "Todos los campos son obligatorios.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo no es válido.";
    } else {
        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, correo, contrasena_hash) VALUES (?, ?, ?)";
        $sentencia = $conexion->prepare($sql);

        if ($sentencia) {
            $sentencia->bind_param("sss", $nombre, $correo, $contrasena_hash);
            if ($sentencia->execute()) {
                $mensaje = "Usuario registrado exitosamente.";
            } else {
                if ($conexion->errno === 1062) {
                    $mensaje = "El correo ya está registrado.";
                } else {
                    $mensaje = "Error al registrar: " . $conexion->error;
                }
            }
            $sentencia->close();
        } else {
            $mensaje = "Error al preparar la consulta: " . $conexion->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de usuario</title>
  <link rel="stylesheet" href="../css/estilo.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="contenedor">
    <div class="tarjeta">
      <div class="encabezado">
        <h1>Registro de usuario</h1>
      </div>
      <p class="sub">Crea una cuenta para acceder a la zona privada.</p>

      <!-- Mensaje -->
      <?php if ($mensaje !== ""): ?>
        <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
      <?php endif; ?>

      <!-- Formulario -->
      <form method="post" action="registrar.php" novalidate>
        <div class="campo">
          <label for="nombre">Nombre</label>
          <input id="nombre" name="nombre" type="text" required maxlength="100" autocomplete="name">
        </div>

        <div class="campo">
          <label for="correo">Correo</label>
          <input id="correo" name="correo" type="email" required maxlength="120" autocomplete="email">
        </div>

        <div class="campo">
          <label for="contrasena">Contraseña</label>
          <input id="contrasena" name="contrasena" type="password" required minlength="6" autocomplete="new-password">
        </div>

        <div class="barra-acciones">
          <button class="boton" type="submit">Crear cuenta</button>
          <a class="boton boton-sec" href="iniciar_sesion.php">Iniciar sesión</a>
        </div>
      </form>

      <hr class="hr">

      <!-- Navegación -->
      <p class="nav">
        <a href="registrar.php">Registrar</a>
        <a href="iniciar_sesion.php">Iniciar sesión</a>
        <a href="salir.php">Salir</a>
      </p>
    </div>
  </div>
</body>
</html>
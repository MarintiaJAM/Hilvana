<?php
require_once "conexion_usuarios.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo     = trim($_POST["correo"] ?? "");
    $contrasena = $_POST["contrasena"] ?? "";

    if ($correo === "" || $contrasena === "") {
        $mensaje = "Todos los campos son obligatorios.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo no es válido.";
    } else {
        $sql = "SELECT id, nombre, correo, contrasena_hash, rol FROM usuarios WHERE correo = ?";
        $sentencia = $conexion->prepare($sql);

        if ($sentencia) {
            $sentencia->bind_param("s", $correo);
            $sentencia->execute();
            $resultado = $sentencia->get_result();

            if ($resultado && $resultado->num_rows === 1) {
                $usuario = $resultado->fetch_assoc();
                if (password_verify($contrasena, $usuario["contrasena_hash"])) {
                    $_SESSION["usuario_id"]     = $usuario["id"];
                    $_SESSION["usuario_nombre"] = $usuario["nombre"];
                    $_SESSION["usuario_correo"] = $usuario["correo"];
                    $_SESSION['usuario_rol']   = $usuario['rol'];

                    header("Location: perfil.php");
                    exit;
                } else {
                    $mensaje = "La contraseña es incorrecta.";
                }
            } else {
                $mensaje = "No se encontró una cuenta con ese correo.";
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
  <title>Iniciar sesión</title>
  <link rel="icon" type="image/png" href="../img/logo.jpg">
  <link rel="stylesheet" href="../css/estilo.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="contenedor">
    <div class="tarjeta">
      <div class="encabezado">
        <h1>Iniciar sesión</h1>
      </div>
      <p class="sub">Accede con tu correo y contraseña.</p>

      <!-- Mensaje -->
      <?php if ($mensaje !== ""): ?>
        <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
      <?php endif; ?>

      <!-- Formulario -->
      <form method="post" action="iniciar_sesion.php" novalidate>
        <div class="campo">
          <label for="correo">Correo</label>
          <input id="correo" name="correo" type="email" required maxlength="120" autocomplete="email">
        </div>

        <div class="campo">
          <label for="contrasena">Contraseña</label>
          <input id="contrasena" name="contrasena" type="password" required minlength="6" autocomplete="current-password">
        </div>

        <div class="barra-acciones">
          <button class="boton" type="submit">Entrar</button>
          <a class="boton boton-sec" href="registrar.php">Crear cuenta</a>
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
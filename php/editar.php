<?php
require_once "conexion_usuarios.php";

/* 🔒 Protección: solo administradores pueden acceder */
if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_rol"] !== "admin") {
    header("Location: acceso_denegado.php"); // o privado.php, si prefieres
    exit;
}

/* Validar parámetro id */
$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
if ($id <= 0) {
    die("ID inválido.");
}

/* Obtener datos actuales */
$usuario = null;
$sql_sel = "SELECT id, nombre, correo FROM usuarios WHERE id = ?";
$sentencia_sel = $conexion->prepare($sql_sel);
if (!$sentencia_sel) { die("Error al preparar la consulta: " . $conexion->error); }
$sentencia_sel->bind_param("i", $id);
$sentencia_sel->execute();
$resultado_sel = $sentencia_sel->get_result();
if ($resultado_sel && $resultado_sel->num_rows === 1) {
    $usuario = $resultado_sel->fetch_assoc();
} else {
    die("Usuario no encontrado.");
}
$sentencia_sel->close();

/* Procesar POST */
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre           = trim($_POST["nombre"] ?? "");
    $correo           = trim($_POST["correo"] ?? "");
    $contrasena_nueva = $_POST["contrasena_nueva"] ?? "";

    if ($nombre === "" || $correo === "") {
        $mensaje = "Nombre y correo son obligatorios.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo no es válido.";
    } else {
        if ($contrasena_nueva !== "") {
            $contrasena_hash = password_hash($contrasena_nueva, PASSWORD_DEFAULT);
            $sql_up = "UPDATE usuarios SET nombre=?, correo=?, contrasena_hash=? WHERE id=?";
            $sentencia_up = $conexion->prepare($sql_up);
            if ($sentencia_up) {
                $sentencia_up->bind_param("sssi", $nombre, $correo, $contrasena_hash, $id);
                if ($sentencia_up->execute()) {
                    $mensaje = "Usuario actualizado con nueva contraseña.";
                    $usuario["nombre"] = $nombre;
                    $usuario["correo"] = $correo;
                } else {
                    $mensaje = $conexion->errno === 1062
                        ? "El correo ya está registrado en otro usuario."
                        : "Error al actualizar: " . $conexion->error;
                }
                $sentencia_up->close();
            }
        } else {
            $sql_up = "UPDATE usuarios SET nombre=?, correo=? WHERE id=?";
            $sentencia_up = $conexion->prepare($sql_up);
            if ($sentencia_up) {
                $sentencia_up->bind_param("ssi", $nombre, $correo, $id);
                if ($sentencia_up->execute()) {
                    $mensaje = "Usuario actualizado.";
                    $usuario["nombre"] = $nombre;
                    $usuario["correo"] = $correo;
                } else {
                    $mensaje = $conexion->errno === 1062
                        ? "El correo ya está registrado en otro usuario."
                        : "Error al actualizar: " . $conexion->error;
                }
                $sentencia_up->close();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar usuario</title>
  <link rel="stylesheet" href="../css/estilo.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="contenedor">
    <div class="tarjeta">
      <div class="encabezado">
        <h1>Editar usuario</h1>
      </div>
      <p class="sub">Modifica la información del usuario seleccionado.</p>

      <?php if ($mensaje !== ""): ?>
        <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
      <?php endif; ?>

      <form method="post" action="editar.php?id=<?= (int)$usuario['id'] ?>" novalidate>
        <div class="campo">
          <label for="nombre">Nombre</label>
          <input id="nombre" name="nombre" type="text" required maxlength="100"
                 value="<?= htmlspecialchars($usuario['nombre']) ?>">
        </div>

        <div class="campo">
          <label for="correo">Correo</label>
          <input id="correo" name="correo" type="email" required maxlength="120"
                 value="<?= htmlspecialchars($usuario['correo']) ?>">
        </div>

        <div class="campo">
          <label for="contrasena_nueva">Contraseña nueva (opcional)</label>
          <input id="contrasena_nueva" name="contrasena_nueva" type="password" minlength="6"
                 placeholder="Déjalo vacío para no cambiarla">
        </div>

        <div class="barra-acciones">
          <button class="boton" type="submit">Guardar cambios</button>
          <a class="boton boton-sec" href="privado.php">Volver</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
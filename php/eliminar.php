<?php
require_once "conexion_usuarios.php";

/* Iniciar sesión si no está iniciada */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Verificar inicio de sesión */
if (!isset($_SESSION["usuario_id"])) {
    header("Location: iniciar_sesion.php");
    exit;
}

/* Validar ID recibido */
$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
if ($id <= 0) {
    die("ID inválido.");
}

/* Si no es admin y trata de eliminar otro usuario, se bloquea */
if ($_SESSION["usuario_rol"] !== "admin" && $_SESSION["usuario_id"] !== $id) {
    header("Location: acceso_denegado.php");
    exit;
}

/* Verificar existencia del usuario */
$sql_sel = "SELECT id FROM usuarios WHERE id = ?";
$sentencia_sel = $conexion->prepare($sql_sel);
if (!$sentencia_sel) {
    die("Error al preparar la consulta: " . $conexion->error);
}
$sentencia_sel->bind_param("i", $id);
$sentencia_sel->execute();
$resultado = $sentencia_sel->get_result();
if (!$resultado || $resultado->num_rows !== 1) {
    die("Usuario no encontrado.");
}
$sentencia_sel->close();

/* Ejecutar eliminación */
$sql_del = "DELETE FROM usuarios WHERE id = ?";
$sentencia_del = $conexion->prepare($sql_del);
if (!$sentencia_del) {
    die("Error al preparar la eliminación: " . $conexion->error);
}
$sentencia_del->bind_param("i", $id);

if ($sentencia_del->execute()) {
    $sentencia_del->close();

    /* Si el usuario eliminó su propia cuenta */
    if ($_SESSION["usuario_id"] === $id) {
        session_destroy();
        header("Location: registrar.php?mensaje=cuenta_eliminada");
        exit;
    } else {
        /* Si fue un admin eliminando otra cuenta */
        header("Location: admin_panel.php?mensaje=usuario_eliminado");
        exit;
    }

} else {
    $sentencia_del->close();
    die("Error al eliminar: " . $conexion->error);
}
?>
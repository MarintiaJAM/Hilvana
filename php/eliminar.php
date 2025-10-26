<?php
require_once "conexion_usuarios.php";

/* 🔒 Protección: solo administradores pueden acceder */
if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_rol"] !== "admin") {
    header("Location: acceso_denegado.php"); // o privado.php
    exit;
}

/* Validar parámetro id */
$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
if ($id <= 0) {
    die("ID inválido.");
}

/* Verificar existencia */
$sql_sel = "SELECT id FROM usuarios WHERE id = ?";
$sentencia_sel = $conexion->prepare($sql_sel);
if (!$sentencia_sel) { die("Error al preparar la consulta: " . $conexion->error); }
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
if (!$sentencia_del) { die("Error al preparar la eliminación: " . $conexion->error); }
$sentencia_del->bind_param("i", $id);

if ($sentencia_del->execute()) {
    $sentencia_del->close();
    header("Location: privado.php");
    exit;
} else {
    $sentencia_del->close();
    die("Error al eliminar: " . $conexion->error);
}
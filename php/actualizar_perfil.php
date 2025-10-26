<?php
session_start();
include "../php/conexion.php";

$id_usuario = $_SESSION['user_id'] ?? 1; // ID del usuario logueado

// Validar datos recibidos
$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$telefono = trim($_POST['telefono']);
$direccion = trim($_POST['direccion']);

if (empty($nombre) || empty($email)) {
  die("Nombre y correo son obligatorios.");
}

// Actualizar en la base de datos
$stmt = $conn->prepare("
  UPDATE usuarios 
  SET nombre = ?, email = ?, telefono = ?, direccion = ? 
  WHERE id = ?
");
$stmt->bind_param("ssssi", $nombre, $email, $telefono, $direccion, $id_usuario);

if ($stmt->execute()) {
  header("Location: perfil.php?actualizado=1");
  exit;
} else {
  echo "Error al actualizar los datos.";
}

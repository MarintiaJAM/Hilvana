<?php
session_start();
require_once "conexion_usuarios.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: iniciar_sesion.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Si se subió una foto
if (!empty($_FILES['foto']['name'])) {
    $nombreArchivo = uniqid() . "_" . basename($_FILES['foto']['name']);
    $rutaDestino = "uploads/" . $nombreArchivo;

    // Mover el archivo a la carpeta uploads/
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
        // Actualizar ruta en la base de datos
        $sql = "UPDATE usuarios SET foto = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("si", $rutaDestino, $usuario_id);
        $stmt->execute();
    }
}

// Redirigir al perfil
header("Location: perfil.php");
exit;
?>

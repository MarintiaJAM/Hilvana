<?php
require_once "conexion_usuarios.php";

if (!empty($_POST['id'])) {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM favoritos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: favoritos.php");
exit;
?>

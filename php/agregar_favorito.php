<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// inicializar la lista de favoritos si no existe
if (!isset($_SESSION['favoritos'])) {
    $_SESSION['favoritos'] = [];
}

// validar que llegó el id del producto
if (!isset($_POST['id_producto'])) {
    header("Location: inicio.php");
    exit;
}

$id_producto = (int)$_POST['id_producto'];

// conexión a tienda_ropa (donde están los productos)
$conexion_tienda = new mysqli("localhost", "root", "", "tienda_ropa");
if ($conexion_tienda->connect_error) {
    die("Error de conexión: " . $conexion_tienda->connect_error);
}

// obtener datos del producto
$sql = $conexion_tienda->prepare("SELECT id_producto, nombre_producto, precio, imagen_principal FROM productos WHERE id_producto = ?");
$sql->bind_param("i", $id_producto);
$sql->execute();
$result = $sql->get_result();
$producto = $result->fetch_assoc();

// si no existe el producto, regresar
if (!$producto) {
    header("Location: inicio.php");
    exit;
}

// evitar duplicados
$ya_esta = false;
foreach ($_SESSION['favoritos'] as $fav) {
    if ($fav['id_producto'] == $producto['id_producto']) {
        $ya_esta = true;
        break;
    }
}

if (!$ya_esta) {
    $_SESSION['favoritos'][] = [
        'id_producto' => $producto['id_producto'],
        'nombre'      => $producto['nombre_producto'],
        'precio'      => $producto['precio'],
        'imagen'      => $producto['imagen_principal']
    ];
}

// ✅ REGRESAR A LA MISMA PÁGINA DONDE ESTABA EL USUARIO
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;


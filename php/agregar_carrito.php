<?php
// Iniciamos la sesión para poder usar variables de sesión
session_start();

// Si el carrito aún no existe en la sesión, lo creamos como un arreglo vacío
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Verificamos que se hayan enviado los datos del producto mediante el formulario (nombre, precio e imagen)
if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['imagen'])) {

    // Creamos un arreglo con los datos del producto que se va a agregar al carrito
    $producto = [
        'nombre' => $_POST['nombre'],   // Nombre del producto
        'precio' => $_POST['precio'],   // Precio del producto
        'imagen' => $_POST['imagen'],   // Imagen del producto
        'cantidad' => 1                 // Cantidad inicial (por defecto 1)
    ];

    // Variable para saber si el producto ya está en el carrito
    $existe = false;

    // Recorremos todos los productos del carrito para comprobar si ya existe
    foreach ($_SESSION['carrito'] as &$item) {
        // Si el nombre del producto coincide con uno que ya está en el carrito...
        if ($item['nombre'] === $producto['nombre']) {
            // ...aumentamos la cantidad en 1
            $item['cantidad'] += 1;
            // Indicamos que el producto ya existía
            $existe = true;
            // Salimos del ciclo porque ya encontramos el producto
            break;
        }
    }

    // Si el producto no existía en el carrito, lo agregamos como nuevo
    if (!$existe) {
        $_SESSION['carrito'][] = $producto;
    }
}

// Redirigimos al usuario a la página desde la que vino (por ejemplo, la tienda o catálogo)
header("Location: " . $_SERVER["HTTP_REFERER"]);

// Finalizamos el script para evitar que se ejecute cualquier otra cosa
exit();
?>

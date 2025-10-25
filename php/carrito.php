<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - JMA Hilvana</title>

    <!-- Iconos de Font Awesome para los íconos de carrito -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- 🎨 Estilos CSS internos -->
    <style>
        /* Estilos generales */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fdfdfd; /* Fondo blanco elegante */
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Encabezado de la página */
        header {
            background-color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #e4c357ff; /* Línea inferior dorada */
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); /* Sombra sutil */
        }

        header h1 {
            color: #333;
            font-weight: 500;
            font-size: 26px;
        }

        /* Contenedor principal del carrito */
        .carrito-container {
            max-width: 900px;
            margin: 50px auto; /* Centrado */
            background: #fffdf7; /* Blanco con tono cálido */
            border: 2px solid #000000ff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(212,175,55,0.15); /* Sombra dorada */
        }

        /* Tabla de productos */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            color: #000000ff;
            font-weight: 600;
            text-transform: uppercase;
            padding-bottom: 12px;
            border-bottom: 2px solid #ffffffff;
        }

        td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #e8e8e8;
        }

        tr:hover {
            background-color: #fff6e5; /* Resalta la fila al pasar el mouse */
        }

        /* Imágenes de los productos */
        img {
            border-radius: 10px;
            width: 80px;
            height: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        /* Botones genéricos */
        .btn {
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
        }

        /* Botón de eliminar producto */
        .btn-eliminar {
            background-color: #b30000;
            color: white;
        }
        .btn-eliminar:hover {
            background-color: #ff0000;
        }

        /* Botón para vaciar todo el carrito */
        .btn-vaciar {
            background-color: transparent;
            color: #d4af37;
            border: 1px solid #d4af37;
            margin-top: 25px;
        }
        .btn-vaciar:hover {
            background-color: #d4af37;
            color: #fff;
        }

        /* Contenedor de acciones al final del carrito */
        .acciones-carrito {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }

        /* Botón para seguir comprando */
        .btn-seguir {
            background-color: #d4af37;
            color: #fff;
            border: none;
        }
        .btn-seguir:hover {
            background-color: #e3c25d;
        }

        /* Mensaje cuando el carrito está vacío */
        .vacio {
            text-align: center;
            color: #d4af37;
            font-size: 20px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<?php
// Iniciamos la sesión para poder acceder al carrito almacenado
session_start();

// 🛒 Si el carrito aún no está creado en la sesión, lo inicializamos como un arreglo vacío
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// ✅ Opción para vaciar todo el carrito
if (isset($_POST['accion']) && $_POST['accion'] === 'vaciar') {
    // Eliminamos la variable de sesión 'carrito'
    unset($_SESSION['carrito']);
    // Redirigimos nuevamente a la página del carrito
    header("Location: carrito.php");
    exit; // Detenemos la ejecución del script
}

// ✅ Opción para eliminar un solo producto del carrito
if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar' && isset($_POST['index'])) {
    $index = $_POST['index']; // Obtenemos el índice del producto a eliminar
    // Verificamos que el índice exista en el carrito
    if (isset($_SESSION['carrito'][$index])) {
        unset($_SESSION['carrito'][$index]); // Eliminamos el producto
        // Reindexamos el arreglo para que los índices vuelvan a ser consecutivos (0,1,2...)
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
    // Redirigimos nuevamente al carrito para actualizar la vista
    header("Location: carrito.php");
    exit;
}

// Guardamos el contenido del carrito actual en una variable para usarla en el HTML
$carrito = $_SESSION['carrito'];
?>
<header>
    <!-- Encabezado con icono e título -->
    <h1><i class="fa-solid fa-bag-shopping" style="color:#d4af37;"></i> Tu Carrito de Compras</h1>
</header>

<div class="carrito-container">
    <!-- Si el carrito está vacío, muestra mensaje -->
    <?php if (empty($carrito)): ?>
        <p class="vacio">Tu carrito está vacío 🛍️</p>
    <?php else: ?>
        <!-- Tabla con productos del carrito -->
        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Acción</th>
            </tr>

            <!-- Recorremos cada producto del carrito -->
            <?php foreach ($carrito as $index => $producto): ?>
                <tr>
                    <!-- Imagen del producto -->
                    <td><img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Producto"></td>
                    <!-- Nombre -->
                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                    <!-- Precio -->
                    <td>$<?php echo htmlspecialchars($producto['precio']); ?></td>
                    <!-- Botón eliminar -->
                    <td>
                        <form method="POST">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="hidden" name="accion" value="eliminar">
                            <button type="submit" class="btn btn-eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Zona inferior: vaciar carrito o seguir comprando -->
        <div class="acciones-carrito">
            <!-- Vaciar carrito -->
            <form method="POST">
                <input type="hidden" name="accion" value="vaciar">
                <button type="submit" class="btn btn-vaciar">Vaciar Carrito</button>
            </form>

            <!-- Seguir comprando (redirige al inicio) -->
            <a href="inicio.php">
                <button type="button" class="btn btn-seguir">Seguir Comprando</button>
            </a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
<header>
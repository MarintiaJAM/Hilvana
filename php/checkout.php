<?php
session_start();

// Verificar sesión de usuario
if (!isset($_SESSION['usuario_id'])) {
  include '../php/modal_acceso.php'; // o pega el HTML directamente
  exit;
}

// Recuperar carrito de la sesión
$carrito = $_SESSION['carrito'] ?? [];

// Calcular subtotal
$total = 0;
foreach ($carrito as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

// Calcular envío
$envio = ($total < 500 && $total > 0) ? 70 : 0;
$total_final = $total + $envio;

// Paso actual
$paso = isset($_GET['paso']) ? intval($_GET['paso']) : 1;

// Guardar datos de cada paso
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($paso === 1) {
        $_SESSION['datos'] = $_POST;
        header("Location: checkout.php?paso=2");
        exit;
    } elseif ($paso === 2) {
        $_SESSION['envio'] = $_POST;
        header("Location: checkout.php?paso=3");
        exit;
    } elseif ($paso === 3) {
        $_SESSION['pago'] = $_POST;
        echo "<h2>¡Compra realizada con éxito!</h2>";
        echo "<a href='inicio.php' class='btn'>Volver al inicio</a>";
        session_destroy();
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Checkout</title>
<link rel="stylesheet" href="../css/checkout.css">
</head>
<body>

<h1>Proceso de compra</h1>

<!-- Mostrar productos -->
<div class="productos">
    <?php if (count($carrito) > 0): ?>
        <?php foreach ($carrito as $item): ?>
            <div class="producto">
                <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>">
                <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
                <p>Cantidad: <?php echo $item['cantidad']; ?></p>
                <p class="precio">$<?php echo number_format($item['precio'], 2); ?> MXN</p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay productos en tu carrito.</p>
    <?php endif; ?>
</div>

<!-- Totales -->
<div class="totales">
    <p>Subtotal: $<?php echo number_format($total, 2); ?> MXN</p>
    <p>Envío: <?php echo $envio > 0 ? "$70 MXN" : "Gratis"; ?></p>
    <p><strong>Total: $<?php echo number_format($total_final, 2); ?> MXN</strong></p>
</div>

<?php if ($paso === 1): ?>
    <h2>1. Datos personales</h2>
    <form method="post">
        <label>Nombre: <input type="text" name="nombre" required></label>
        <label>Apellido: <input type="text" name="apellido" required></label>
        <label>Calle o privada: <input type="text" name="calle" required></label>
        <label>Número de casa: <input type="text" name="numero" required></label>
        <label>Código postal: <input type="text" name="cp" required></label>
        <label>Colonia: <input type="text" name="colonia" required></label>
        <label>Ciudad: <input type="text" name="ciudad" required></label>
        <label>País: <input type="text" name="pais" required></label>
        <label>Región: <input type="text" name="region" required></label>
        <label>Correo electrónico: <input type="email" name="correo" required></label>
        <label>Teléfono (+52...): <input type="text" name="telefono" required></label>
        <label>Observaciones: <textarea name="observaciones"></textarea></label>
        <div class="botones">
            <a href="inicio.php" class="btn">← Inicio</a>
            <button type="submit" class="btn">Continuar a Envío</button>
        </div>
    </form>

<?php elseif ($paso === 2): ?>
    <h2>2. Envío</h2>
    <form method="post">
        <label><input type="radio" name="tipo_envio" value="estandar" required> Envío estándar</label>
        <label><input type="radio" name="tipo_envio" value="recoleccion"> Punto de recolección</label>
        <label><input type="radio" name="tipo_envio" value="express"> Envío express</label>
        <div class="botones">
            <a href="inicio.php" class="btn">← Inicio</a>
            <a href="checkout.php?paso=1" class="btn">← Volver a Datos</a>
            <button type="submit" class="btn">Continuar a Pago</button>
        </div>
    </form>

<?php elseif ($paso === 3): ?>
    <h2>3. Pago</h2>
    <form method="post">
        <label><input type="radio" name="metodo_pago" value="tarjeta" required onclick="mostrarTarjeta(true)"> Tarjeta de crédito/débito</label>
        <label><input type="radio" name="metodo_pago" value="oxxo" onclick="mostrarTarjeta(false)"> Efectivo en Oxxo</label>
        <div id="datos-tarjeta" style="display:none; margin-top:10px;">
            <label>Número de tarjeta: <input type="text" name="numero_tarjeta"></label>
        </div>
        <div class="botones">
            <a href="inicio.php" class="btn">← Inicio</a>
            <a href="checkout.php?paso=2" class="btn">← Volver a Envío</a>
            <button type="submit" class="btn">Finalizar compra</button>
        </div>
    </form>
    <script>
        function mostrarTarjeta(mostrar) {
            document.getElementById('datos-tarjeta').style.display = mostrar ? 'block' : 'none';
        }
    </script>
<?php endif; ?>

</body>
</html>

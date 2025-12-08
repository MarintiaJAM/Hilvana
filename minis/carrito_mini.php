<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Si no existe el carrito, lo creamos vacío
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$carrito = $_SESSION['carrito'];
?>

<div class="mini-carrito">

    <?php if (empty($carrito)): ?>
        <p>Tu carrito está vacío.</p>

    <?php else: ?>
        <?php foreach ($carrito as $index => $producto): ?>
            <div class="mini-producto-card">
                
                <img class="mini-img" src="<?= htmlspecialchars($producto['imagen']); ?>" alt="Producto">

                <div class="mini-info">
                    <strong><?= htmlspecialchars($producto['nombre']); ?></strong><br>
                    <span>$<?= htmlspecialchars($producto['precio']); ?></span>
                </div>

                <form method="POST" action="carrito.php" class="mini-eliminar-form">
                    <input type="hidden" name="index" value="<?= $index; ?>">
                    <input type="hidden" name="accion" value="eliminar">
                    <button type="submit" class="mini-btn-eliminar">✖</button>
                </form>

            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

<style>
.mini-carrito {
    padding: 10px;
}

.mini-producto-card {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #f6f6f6;
    padding: 8px;
    margin: 6px 0;
    border-radius: 6px;
}

.mini-img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 5px;
}

.mini-info {
    flex: 1;
    font-size: 14px;
}

.mini-btn-eliminar {
    background: #ff4b4b;
    border: none;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    cursor: pointer;
}

.mini-btn-eliminar:hover {
    background: #cc0000;
}
</style>

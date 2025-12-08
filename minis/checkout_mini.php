<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$compras = $_SESSION['compras'] ?? [];
?>

<div class="mini-checkout">

    <h3>Mis compras realizadas</h3>

    <?php if (empty($compras)): ?>
        <p>Aún no has comprado nada.</p>

    <?php else: ?>

        <?php foreach ($compras as $compra): ?>
            <div class="mini-compra-card">

                <div class="mini-compra-header">
                    <strong>Compra del:</strong> <br>
                    <small><?= $compra['fecha'] ?></small>
                </div>

                <div class="mini-productos-compra">
                <?php foreach ($compra['items'] as $p): ?>
                    <div class="mini-compra-item">
                        <img src="<?= htmlspecialchars($p['imagen']) ?>" class="mini-img">
                        <div class="mini-info">
                            <strong><?= htmlspecialchars($p['nombre']) ?></strong><br>
                            <small>Cantidad: <?= $p['cantidad'] ?></small><br>
                            <span>$<?= number_format($p['precio'], 2) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>

                <p class="mini-total">
                    <strong>Total: $<?= number_format($compra['total'], 2) ?> MXN</strong>
                </p>

            </div>
        <?php endforeach; ?>

    <?php endif; ?>

</div>

<style>
.mini-checkout { padding: 10px; }
.mini-compra-card {
    background: #f8f8f8;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 12px;
}
.mini-compra-item {
    display: flex;
    gap: 10px;
    padding: 6px;
    background: #fff;
    border-radius: 6px;
    margin-bottom: 6px;
}
.mini-img {
    width: 45px;
    height: 45px;
    border-radius: 5px;
    object-fit: cover;
}
.mini-info {
    font-size: 13px;
    flex: 1;
}
</style>

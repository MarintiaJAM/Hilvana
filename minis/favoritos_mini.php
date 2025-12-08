<?php
// Evita el aviso de sesión iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si no existe el array de favoritos, lo creamos vacío
if (!isset($_SESSION['favoritos'])) {
    $_SESSION['favoritos'] = [];
}

$favoritos = $_SESSION['favoritos'];
?>

<div class="section-title">❤️ Favoritos</div>

<?php if (count($favoritos) === 0): ?>
    <p class="empty-msg">No tienes productos en favoritos.</p>
<?php else: ?>
    <div class="mini-list">
        <?php foreach ($favoritos as $item): ?>
            <div class="mini-item">
                <img src="<?php echo $item['imagen']; ?>" alt="">
                <div class="mini-info">
                    <p class="mini-name"><?php echo $item['nombre']; ?></p>
                    <p class="mini-price">$<?php echo number_format($item['precio'], 2); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


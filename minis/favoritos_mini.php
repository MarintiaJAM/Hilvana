<?php
/******************************************************
 * FAVORITOS MINI
 * Muestra una lista pequeña de los productos favoritos.
 * Usa la misma estructura que favoritos.php:
 *  - id_producto
 *  - nombre
 *  - precio
 *  - imagen
 ******************************************************/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Crear arreglo si no existe
if (!isset($_SESSION['favoritos'])) {
    $_SESSION['favoritos'] = [];
}

$favoritos = $_SESSION['favoritos'];
?>



<?php if (empty($favoritos)): ?>
    <p class="empty-msg">No tienes productos en favoritos.</p>

<?php else: ?>
    <div class="mini-list">

        <?php foreach ($favoritos as $item): ?>
            <div class="mini-item">

                <!-- Imagen del producto -->
                <img src="<?= htmlspecialchars($item['imagen']) ?>" alt="<?= htmlspecialchars($item['nombre']) ?>">

                <!-- Información del producto -->
                <div class="mini-info">
                    <p class="mini-name"><?= htmlspecialchars($item['nombre']) ?></p>
                    <p class="mini-price">$<?= number_format($item['precio'], 2) ?></p>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
<?php endif; ?>

<style>
/* ---------- CONTENEDOR GENERAL ---------- */

.section-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.section-title::before {
    content: "";
    width: 4px;
    height: 18px;
    background: #e6007e; /* rosa acento */
    border-radius: 2px;
}

.empty-msg {
    font-size: 0.9rem;
    color: #666;
    margin: 0;
}

/* ---------- LISTA MINI DE FAVORITOS ---------- */

.mini-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-height: 260px;        /* si es un panel mini */
    overflow-y: auto;
    padding-right: 4px;       /* espacio para scroll */
}

/* ---------- ITEM INDIVIDUAL ---------- */

.mini-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px;
    border-radius: 8px;
    background: #fff;
    border: 1px solid #eee;
    transition: background 0.2s ease, box-shadow 0.2s ease, transform 0.1s ease;
}

.mini-item:hover {
    background: #fafafa;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    transform: translateY(-1px);
}

/* ---------- IMAGEN ---------- */

.mini-item img {
    width: 45px;
    height: 55px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #ddd;
}

/* ---------- TEXTO ---------- */

.mini-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
    overflow: hidden;
}

.mini-name {
    font-size: 0.85rem;
    font-weight: 600;
    color: #333;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.mini-price {
    font-size: 0.8rem;
    color: #e6007e;
    font-weight: 700;
    margin: 0;
}

/* ---------- OPCIONAL: SCROLL ESTÉTICO ---------- */

.mini-list::-webkit-scrollbar {
    width: 6px;
}

.mini-list::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 3px;
}

.mini-list::-webkit-scrollbar-track {
    background: transparent;
}

</style>


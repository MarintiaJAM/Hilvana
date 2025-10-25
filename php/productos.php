<form action="agregar_carrito.php" method="POST">
        <input type="hidden" name="nombre" value="Conjunto de Ropa Estilo Vkei Azul y Negro">
        <input type="hidden" name="precio" value="4000">
        <input type="hidden" name="imagen" value="../img/Black and Dark Blue Ouji Shorts with Overlay.jpg">
        <button class="carrito">
  <i class="fa-solid fa-cart-shopping"></i>
<div class="container">
        <section class="producto-container">
            <!-- PRODUCTO EJEMPLO -->
            <?php
            // Puedes cargar productos desde una base de datos, pero aquí están fijos como ejemplo
            $productos = [
                [
                    "nombre" => "Conjunto de Ropa Estilo Vkei Azul y Negro",
                    "precio" => 4000,
                    "imagen" => "../img/Black and Dark Blue Ouji Shorts with Overlay.jpg",
                    "imagen2" => "../img/c78ffdd6-c961-4909-a889-85566237c00e.jpg"
                ],
                [
                    "nombre" => "Camisa Cross Ribbon Sailor Lace Collar",
                    "precio" => 350,
                    "imagen" => "../img/Cross Ribbon Sailor Lace Collar Blouse_ Dear My Love.jpg",
                    "imagen2" => "../img/dd667753-bc0c-48e5-858b-a4674f988da4.jpg"
                ],
                [
                    "nombre" => "Capa Azul Estilo Vkei",
                    "precio" => 700,
                    "imagen" => "../img/8d6d4e4e-fef1-45b6-9a9f-4b89672b9bea.jpg",
                    "imagen2" => "../img/a8fdb29f-06f2-45e3-ac2a-4c281dd735de.jpg"
                ]
            ];
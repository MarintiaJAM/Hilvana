<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "conexion_usuarios.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Información</title>
  <link rel="icon" type="image/png" href="../img/logo.jpg">

  <!-- 💅 Fuentes y estilos -->
    <!-- Fuente principal desde Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap">

    <!-- Librería de íconos Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../menu lateral css/menu.css">
  <link rel="stylesheet" href="../Sitios extra/css_extra.css">
</head>
<body>
<!-- 🧭 ENCABEZADO PRINCIPAL -->
    <header>
        <!-- 🔸 Barra superior con anuncio -->
        <nav class="top-bar-anuncio">
            <p>Envío y devoluciones gratis a partir de $800 pesos mexicanos</p>
        </nav>

        <!-- 🔸 Menú de navegación principal -->
        <nav class="menu" id="Menu">

            <!-- Botón hamburguesa (☰) para abrir menú lateral en dispositivos pequeños -->
            <button class="hamburger-btn" id="hamburgerBtn">
                <i class="fas fa-bars"></i>
            </button>

            <!-- 🔹 Logo de la tienda -->
            <div class="logo">
                <a href="../php/inicio.php">
                    <img src="../img/logo.jpg" alt="Logo">
                </a>
            </div>

            <!-- 🔹 Título centrado en la barra -->
            <div class="navbar-center">
                <h1>JMA HILVANA</h1>
            </div>

            <!-- 🔹 Sección superior con búsqueda, carrito y login -->
            <div class="top-bar">

                <!-- 🔍 Barra de búsqueda -->
                <div class="search-bar">
                    <div class="search-container">
                        <button type="button" id="searchButton" onclick="window.location.href='../php/buscador.php'">
                            <i class="fas fa-search"></i>
                        </button>
                        <div class="search-suggestions" id="searchSuggestions"></div>
                    </div>
                </div>

                <!-- 🛒 Icono de carrito, enlaza con carrito.php -->
                <div class="car-shopping">
                    <a href="carrito.php" id="car-shopping-btn">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>


                <!-- Botón de Inicio de Sesión -->
                <div class="Login">
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <!-- Si el usuario YA inició sesión -->
                        <a href="perfil.php" class="login-button"> <i class="fas fa-user"></i></a>
                        <?php else: ?>
                        <!-- Si el usuario NO ha iniciado sesión -->
                        <a href="registrar.php" class="login-buton"> <i class="fas fa-user"></i></a>
                        <?php endif; ?>

                </div>

                <!-- ❤️ Botón de favoritos -->
                <div class="favorites">
                    <button type="button" id="favorites-btn">
                        <i class="fa-solid fa-heart"></i>
                    </button>
                </div>
            </div>
        </nav>

        <!-- 🔸 MENÚ LATERAL (que se despliega al dar clic al botón hamburguesa) -->
        <div id="sideMenu" class="side-menu">
            <button class="close-btn" onclick="toggleSideMenu()">
                <i class="fas fa-times"></i>
            </button>
            <ul>
              <li><a href="../php/bitacora.php?seccion=cambios"><i class="fas fa-info-circle"></i> Cambios y actualizaciones</a></li>
              <li><a href="../php/bitacora.php?seccion=proposito"><i class="as fa-info-circle"></i> Nuestro proposito</a></li>
              <li><a href="../php/bitacora.php?seccion=tecnologias"><i class="fas fa-info-circle"></i> Tecnologias empleadas</a></li>
              <li><a href="../php/bitacora.php?seccion=bases"><i class="as fa-info-circle"></i> Bases de datos</a></li>
              <li><a href="../php/bitacora.php?seccion=sistema"><i class="fas fa-info-circle"></i> Sistema y funcionamientos</a></li>
              <li><a href="../php/bitacora.php?seccion=instruciones"><i class="fas fa-info-circle"></i> Instrucciones basicas</a></li>
            </ul>
        </div>

        <!-- Fondo oscuro que aparece detrás del menú lateral -->
        <div id="overlay" class="overlay" onclick="toggleSideMenu()"></div>

    </header>

  <div class="contenido">
    <?php
      $seccion = $_GET['seccion'] ?? 'inicio';

      switch ($seccion) {
        case 'cambios':
         echo '
        <table class="tabla-cambios">
            <thead>
                <tr>
                    <th>Cambios en la pagina</th>
                    <th>Dia, Mes y Año</th>
                    <th>Versión</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>+Se creo "Hilvana JMA"</td>
                    <td>6 de octubre, 2025</td>
                    <td>V1.0.0</td>
                </tr>
                <tr>
                    <td>
                    +Se Agrego el header.</br>
                    +Se Agregaron botones de "Buscador", "Carrito", "Cuenta" y "Favoritos".</br>
                    +Se agrego una imagen de fondo.</br>
                    +Se agregaron 4 prendas aleatorias.</td>
                    <td>8 de octubre, 2025</td>
                    <td>V2.0.0</td>
                </tr>
                <tr>
                    <td>
                    +Se agrego precio y descripción a las prendas disponibles.</br>
                    +Se empezo a crear el logo de la pagina.</br>
                    +Se agrego el footer.</td>
                    <td>9 de octubre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +Se cambio la imagen de fondo de la pagina.</br>
                    +Se creo el logo de la pagina.</br>
                    +Se agrego una nueva paleta de colores a la pagina.</br>
                    +Se agrego el boton que muestra los extra de la pagina.</br>
                    +La pagina cambio de html a php.</br>
                    +Se añadio el menu desplegable de los extras.</br>
                    -El menu desplegable tiene un fallo con la forma en la que aparce.</br>
                    +Se añadieron todos los archivos .php para el inicio de sesion y creacion de cuenta.</br>
                    +Se añadio la primera base de datos (db.sql) para el funcionamiento de el perfil.</br>
                    +Se arreglo el menu desplegable en el php (ahora es funcional).</br>
                    +Se enlazo el css al php del inicio.</br>
                    +Se corrigieron errores con las configuraciones del inicio de sesion.</br>
                    +Los archivos .php cambiaron a una carpeta llamada "php".</td>
                    <td>20 de octubre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +Se añadieron boton "ir hacia arriba" y el boton de "carrito" cambio.</td>
                    <td>21 de octubre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +Se arreglaron los errores del menu desplegable en todas las paginas que esta.</br>
                    +Se agregaron todos los archivos .php para el funcionamiento del carrito.</td>
                    <td>22 de octubre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +Se aregaron todas las funciones del carrito.</br>
                    -Se elimino la flecha para ir arriba.</br>
                    +El carrito empezo a funcionar correctamente.</td>
                    <td>23 de octubre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +Se agrego la pagina de "buscador".</br>
                    +Se agregaron todos los archivos para el funcionamiento del buscador.</br>
                    +Se agrego la base de datos "tienda_ropa.sql" para almacenar la ropa
                    -El buscador presento fallos para mostrar la ropa.</br>
                    +Se arreglaron unos fallos del buscador.</br>
                    +Se añadieron elementos para el inicio de sesion.</br>
                    +Se actualizo la base de datos (db.sql).
                    +Se añadieron cambios a la pagina de "registrar.php".</br>
                    +Se han añadido todas las página de php con respecto al inicio de sesión, se cambio el nombre de conexion a conexion_usuarios.php.</br>
                    -Para evitar confuciones, se elimino "privado.php".</br>
                    +En el codigo de "inicio.php" se añadio un fracmento de codigo para detectar si el usuario ya inicio sesion, para de esta forma mostrarle su perfil.</br>
                    +Se añadio una opcion para poder cambiar de foto de perfil.</br>
                    +Se añadio una carperta para mostar almacenar las fotos de perfil de el usuario.</td>
                    <td>25 de octubre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +Se añadio un menu a la pagina de "carrito.php".</br>
                    -Se eliminó la opción de privado en el registro y el inicio de sesión porque estos no son necesarios, así como también unos arreglos al inicio.</td>
                    <td>27 de octubre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +Se empezo a trabajar en la pagina de favoritos
                    +Se agrego nuevo css en la pagina de "carrito.php" y "favoritos.php"</td>
                    <td>4 de Diciembre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    -La pagina de "buscador.php" presento errores con su css.</br>
                    +La pagina de "buscador.php" tiene todas sus funciones terminadas (buscar productos, filtros y mostrar los productos en la base de datos).</br>
                    +Se agregaron los cambios a los archivos php con respecto al manejo de usuarios.</br>
                    +Se añadió el css conectado a los estilos del navbar de la página de perfil.</br>
                    +Se arreglaron los errores de la pagina de buscador.</br>
                    +En el menu desplegable, se agregaron paginas de informacion.</br>
                    +Se añadio la pagina de "producto.php" que muestra la informacion de los productos empleando la base de datos "tienda_ropa".</br>
                    +Se agrego un bot a la pagina de "buscador.php".</td>
                    <td>17 de noviembre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +Se añadió el css conectado a los estilos del navbar de la página de perfil.</td>
                    <td>18 de noviembre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +Se añadio "color" y "talla" a la ropa.</br>
                    +Se añadio ropa adicional a la pagina.</td>
                    <td>1 de Diciembre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +Se añadio un boton de "comprar" en la pagina de "producto.php"</br>
                    +El boton "comprar" te llevara a la pagina de checkout.php, donde se encuentra el formulario de compra.</br>
                    +Se añadieron estilos al checkout.php</br>
                    +Se añadio una pagina modal, que no permite acceder al usuario al formulario de compra si no se ah iniciado sesion o creado una cuenta.</br>
                    +Los productos que se compraran deben de ser guardados en el carrito.</td>
                    <td>3 de Diciembre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +Se cambiaron los estilos de checkout.css.</br>
                    +El header del buscador se arreglo y se muestra correctamente.</br>
                    +Se agregaron los cambios de los estilos de las páginas de inicio de sesión, perfil, buscador.</br>
                    +El fooder se arreglo y ahora se muestra en español.</br>
                    +Se añadio un efecto carrusel en el formulario de compra.</br>
                    +Se cambiaron los estilos en la barra de busqueda de buscador.php</br>
                    +Nuevos estilos de botones en el header de todas las paginas.
                    +Se agrego la base de datos de Favoritos (favoritos.sql) para el funcionamiento de la pagina de favoritos.</br>
                    +La pagina de "favoritos.php" es funcional yn puede guardar productos en tus favoritos.</br>
                    +Se cambio la foto de portada de inicio.php</td>
                    <td>4 de Diciembre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +Se actualizaron los estilos de producto.css y navbar.css para una presentación más atractiva y llamativa.</br>
                    +Se añadieron todas las imagenes de la nueva ropa, así como la ropa nueva dentro de la base de datos.</br>
                    +se cambio la estructura de productos.php para que fuese más llamativo para el usuario.</br>
                    +El perfil ahora muestra completamente lo que hay en carritos y tu historial de compras realizadas.</br>
                    +Se corrigió un pequeño error que impidía el avance de la base de datos de favoritos.</br>
                    +Se agregaron modificaciones para el detector de inicio de sesión en carrito y favoritos.</br>
                    +Se agrego el botón de favoritos con los styles correctos.</br></td>
                    <td>8 de Diciembre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +El boton de "ir a pagar" en carrito.php ya te lleva al formulario de compra.</br>
                    +Ahora la base de datos "tienda_ropa" hace que aparezca la ropa en la pagina de inicio y se guarda correctamente en le carrito.</br>
                    +Se cambiaron los estilos de modal_acceso.php para mas placer.</br>
                    +Ahora, cuando el bot es habilitado este sera de colores relacionados a la pagina.</br>
                    +Se cambiaron los estilos del buscador.</br>
                    +Se cambiaron unos detalles en los estilos de perfil.php y navbar.css</br>
                    +Se documento el codigo de carrito.php</td>
                    <td>10 de Diciembre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    +Se agrego la pagina de bitacora.php para todo publico.</td>
                    <td>14 de Diciembre, 2025</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        ';
          break;

        case 'proposito':
          echo "<h2>Sobre Nuestros Productos</h2><p>Trabajamos con materiales de alta calidad y diseños exclusivos...</p>";
          break;

        case 'tecnologias':
          echo "<h2>Problemas</h2><p>Si tuviste algún inconveniente con tu pedido, contáctanos para resolverlo...</p>";
          break;

        case 'bases':
          echo "<h2>Contacto</h2><p>Correo: atencionacliente@cuidadoconelperro.com.mx<br>Teléfono: 800-123-4567</p>";
          break;

        case 'sistema':
          echo "<h2>Términos y Condiciones</h2><p>Te damos la bienvenida a JMA Hilvana y a nuestra pagina web (en conjunto con cualquier apartado de la pagina); al usarla, estas aceptando plenamente y sin reservas los presentes T&C, que aplican para todas las compras, envíos y Productos que ofrecemos a través de la misma. Si no estás de acuerdo con lo establecido con estas condiciones no hagas uso de la Pagina.</br>
          La Plataforma es operada de forma independiente y si necesitas ayuda o tienes dudas, puedes escribirnos a: atencionalclienteHilvana@gmail.com.</p>";
          echo "<h2>REGISTRO DEL USUARIO</h2></br>
          <p>La Plataforma está dirigida a personas mayores de 18 años; por lo que en caso de que algún menor de edad la utilice, entendemos que lo hace bajo la supervisión y responsabilidad de sus padres o tutores, quienes asumirán cualquier obligación derivada de las acciones realizadas por el menor en la Plataforma. </br>
          Puedes navegar libremente por la Plataforma y consultar Productos sin necesidad de crear una cuenta. Pero si quieres una mejor experiencia —como hacer compras más rápido, consultar tu historial, acceder a promociones exclusivas o recibir atención personalizada— te recomendamos crear tu cuenta de Usuario; si lo prefieres, también puedes realizar compras como “invitado”, sin registrarte.</br>
          Para crear tu cuenta solo necesitas registrar tus datos básicos (nombre, apellido, domicilio, número de teléfono, correo electrónico y género) y establecer una contraseña segura; te recomendamos no compartirla con nadie, ya que cualquier uso que un tercero haga con tus datos de acceso será tu responsabilidad. Al registrarte y/o realizar una compra, confirmas que has leído y aceptado los presentes Términos y Condiciones, así como nuestro Aviso de Privacidad, en este útimo te explicamos claramente el uso que daremos a tus datos personales. 
          Recuerda que la información que proporciones debe ser real, actual y completa. </br>Si detectamos datos falsos, inexactos o incompletos, podríamos cancelar tu cuenta o tus pedidos, y no seremos responsables de los inconvenientes que eso ocasione.</p>";
          break;

        case 'Instruciones':
          echo "<h2>Aviso de Privacidad</h2><p>Protegemos tus datos conforme a la Ley Federal de Protección de Datos Personales...</p>";
          break;

        default:
          echo "<h2>Bienvenido</h2><p>Selecciona una sección desde el menú para ver más información.</p>";
      }
    ?>
  </div>


  <script src="../menujs/jsmenu.js"></script>
</body>
</html>
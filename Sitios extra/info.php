

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Información</title>

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
              <li><a href="../Sitios extra/info.php?seccion=guia"><i class="fas fa-info-circle"></i> Guía de tallas</a></li>
              <li><a href="../Sitios extra/info.php?seccion=productos"><i class="fas fa-tshirt"></i> Sobre nuestros productos</a></li>
              <li><a href="../Sitios extra/info.php?seccion=problemas"><i class="fas fa-info-circle"></i> Problemas</a></li>
              <li><a href="../Sitios extra/info.php?seccion=contacto"><i class="fas fa-phone"></i> Contacto</a></li>
              <li><a href="../Sitios extra/info.php?seccion=terminos"><i class="fas fa-info-circle"></i> Términos y condiciones</a></li>
              <li><a href="../Sitios extra/info.php?seccion=privacidad"><i class="fas fa-info-circle"></i> Privacidad</a></li>
            </ul>
        </div>

        <!-- Fondo oscuro que aparece detrás del menú lateral -->
        <div id="overlay" class="overlay" onclick="toggleSideMenu()"></div>

    </header>

  <div class="contenido">
    <?php
      $seccion = $_GET['seccion'] ?? 'inicio';

      switch ($seccion) {
        case 'guia':
         echo "<h2>Guía de Tallas</h2>
         <p>En Hilvana ofrecemos una amplia gama de tallas que pueden variar según el estilo, corte y tejido de cada prenda. Para que puedas seleccionar la talla que mejor se adapta a ti, te dejamos a continuación una guía con información detallada sobre cómo medirte:</br></p>
         <h4>Pecho</h4></br>
         <p>Mide el contorno de la parte más alta del pecho.</p></br>
         <h4>Cintura</h4></br>
         <p>Mide el contorno de la parte más estrecha de tu cintura, colocando la cinta métrica de manera holgada.</p></br>
         <h4>Cadera</h4></br>
         <p>Estando de pie con las piernas juntas, mide el contorno de caderas en la parte más ancha.</p></br>
         <h4>Largo de pierna</h4></br>
         <p>Estantdo descalzo, mide la largura de tus piernas desde el punto más alto de la parte interna y hasta el suelo.</p></br>";
          echo "<h2>Damas</h2>";
         echo '<img src="../img/M1.png" alt="Guía de tallas" style="max-width:100%;">';
         echo '<img src="../img/M2.png" alt="Guía de tallas" style="max-width:100%;">';
          echo "<h2>Hombres</h2>";
         echo '<img src="../img/H1.png" alt="Guía de tallas" style="max-width:100%;">';
         echo '<img src="../img/H2.png" alt="Guía de tallas" style="max-width:100%;">';
          break;

        case 'productos':
          echo "<h2>Sobre Nuestros Productos</h2><p>Trabajamos con materiales de alta calidad y diseños exclusivos...</p>";
          break;

        case 'problemas':
          echo "<h2>Problemas</h2><p>Si tuviste algún inconveniente con tu pedido, contáctanos para resolverlo...</p>";
          break;

        case 'contacto':
          echo "<h2>Contacto</h2><p>Correo: atencionacliente@cuidadoconelperro.com.mx<br>Teléfono: 800-123-4567</p>";
          break;

        case 'terminos':
          echo "<h2>Términos y Condiciones</h2><p>Te damos la bienvenida a JMA Hilvana y a nuestra pagina web (en conjunto con cualquier apartado de la pagina); al usarla, estas aceptando plenamente y sin reservas los presentes T&C, que aplican para todas las compras, envíos y Productos que ofrecemos a través de la misma. Si no estás de acuerdo con lo establecido con estas condiciones no hagas uso de la Pagina.</br>
          La Plataforma es operada de forma independiente y si necesitas ayuda o tienes dudas, puedes escribirnos a: atencionalclienteHilvana@gmail.com.</p>";
          echo "<h2>REGISTRO DEL USUARIO</h2></br>
          <p>La Plataforma está dirigida a personas mayores de 18 años; por lo que en caso de que algún menor de edad la utilice, entendemos que lo hace bajo la supervisión y responsabilidad de sus padres o tutores, quienes asumirán cualquier obligación derivada de las acciones realizadas por el menor en la Plataforma. </br>
          Puedes navegar libremente por la Plataforma y consultar Productos sin necesidad de crear una cuenta. Pero si quieres una mejor experiencia —como hacer compras más rápido, consultar tu historial, acceder a promociones exclusivas o recibir atención personalizada— te recomendamos crear tu cuenta de Usuario; si lo prefieres, también puedes realizar compras como “invitado”, sin registrarte.</br>
          Para crear tu cuenta solo necesitas registrar tus datos básicos (nombre, apellido, domicilio, número de teléfono, correo electrónico y género) y establecer una contraseña segura; te recomendamos no compartirla con nadie, ya que cualquier uso que un tercero haga con tus datos de acceso será tu responsabilidad. Al registrarte y/o realizar una compra, confirmas que has leído y aceptado los presentes Términos y Condiciones, así como nuestro Aviso de Privacidad, en este útimo te explicamos claramente el uso que daremos a tus datos personales. 
          Recuerda que la información que proporciones debe ser real, actual y completa. </br>Si detectamos datos falsos, inexactos o incompletos, podríamos cancelar tu cuenta o tus pedidos, y no seremos responsables de los inconvenientes que eso ocasione.</p>";
          break;

        case 'privacidad':
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

<?php
// Incluye el archivo de conexión/configuración (asegura sesión iniciada o disponible)
require_once "conexion.php";

/* Destruir la sesión */
// Limpia manualmente el arreglo de sesión
$_SESSION = [];
// Elimina todas las variables de la sesión
session_unset();
// Destruye por completo la sesión actual en el servidor
session_destroy();
?>
<!DOCTYPE html>
<html lang="es"> <!-- Documento en HTML5, idioma español -->
<head>
  <meta charset="UTF-8"> <!-- Soporte para caracteres especiales -->
  <title>Sesión cerrada</title> <!-- Título de la pestaña del navegador -->
  <link rel="stylesheet" href="../css/estilo.css"> <!-- Enlace a hoja de estilos externa -->
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Adaptación a móviles -->
  <meta http-equiv="refresh" content="3;url=iniciar_sesion.php"> <!-- Redirección automática en 3s -->
</head>
<body>
  <div class="contenedor"> <!-- Contenedor principal de la página -->
    <div class="tarjeta"> <!-- Tarjeta estilizada para mostrar el mensaje -->
      <div class="encabezado"> <!-- Encabezado dentro de la tarjeta -->
        <h1>Sesión cerrada</h1> <!-- Título visible en pantalla -->
      </div>
      <p class="sub">Has salido del sistema correctamente.</p> <!-- Subtítulo de confirmación -->

      <p class="mensaje mensaje--ok">
        Serás redirigido en unos segundos a la página de inicio de sesión.
      </p> <!-- Mensaje de estado (estilo OK, probablemente verde) -->

      <div class="barra-acciones"> <!-- Barra de acciones -->
        <a class="boton" href="iniciar_sesion.php">Ir ahora</a> <!-- Botón para ir al login manualmente -->
      </div>
    </div>
  </div>
</body>
</html>

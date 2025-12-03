<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Acceso requerido</title>
  <style>
.modal-fondo {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(22, 22, 22, 0.52);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.modal-acceso {
  background-color: #cfceceff;
  color: #000000ff;
  border: 2px solid #b8860b;
  border-radius: 12px;
  padding: 30px 20px;
  width: 90%;
  max-width: 400px;
  text-align: center;
  box-shadow: 0 0 25px #b8860b;
}

.logo-modal {
  width: 120px;
  height: 120px;
  object-fit: cover;
  border-radius: 50%;       /* redondea la imagen */
  border: 2px solid #b8860b;
  margin-bottom: 15px;
}

.modal-acceso p {
  font-size: 18px;
  margin-bottom: 25px;
}

.btn-arriba {
  display: block;
  background-color: #b8860b;
  color: #000;
  font-weight: bold;
  padding: 12px 20px;
  border-radius: 6px;
  text-decoration: none;
  margin-bottom: 20px;
  transition: background-color 0.3s ease;
}

.btn-arriba:hover {
  background-color: #fff;
  color: #000;
}

.btn-abajo {
  display: block;
  background-color: #fff;
  color: #000;
  font-weight: bold;
  padding: 12px 20px;
  border-radius: 6px;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.btn-abajo:hover {
  background-color: #b8860b;
  color: #000;
}

  </style>
</head>
<body>

<div class="modal-fondo">
  <div class="modal-acceso">
    <img src="../img/logo.jpg" alt="Logo Hilvana" class="logo-modal">
    <p>Necesitas iniciar sesión o crear una cuenta para acceder a las funciones especiales de la pagina.</p>
    <a href="../php/iniciar_sesion.php" class="btn-arriba">Iniciar sesión</a>
    <a href="../php/registrar.php" class="btn-abajo">Crear cuenta</a>
  </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Acceso requerido</title>
  
    <link rel="icon" type="image/png" href="../img/logo.jpg">
  <style>

.modal-fondo {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at center, rgba(255, 255, 255, 1), rgba(206, 206, 206, 1));
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  animation: fadeIn 0.6s ease-out forwards;
}

.modal-acceso {
  background: rgba(255, 255, 255, 1);
  backdrop-filter: blur(10px);
  color: #fff;
  border: 2px solid #d8ad27;
  border-radius: 18px;
  padding: 35px 25px;
  width: 90%;
  max-width: 420px;
  text-align: center;
  box-shadow: 0 0 35px rgba(216,173,39,0.7);
  animation: pop 0.5s ease-out;
  transition: transform 0.4s ease;
}

.modal-acceso:hover {
  transform: scale(1.02);
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes pop {
  0% { transform: scale(0.8); opacity: 0; }
  100% { transform: scale(1); opacity: 1; }
}

.logo-modal {
  width: 180px;
  height: 180px;
  object-fit: cover;
  border-radius: 50%;
  border: 4px solid #d4a017;                 
  box-shadow: 0 0 30px rgba(212,160,23,0.7);
  margin-bottom: 20px;
  animation: logoFloat 3.5s ease-in-out infinite; /* efecto flotante */
}


@keyframes logoFloat {
  0% { transform: translateY(0); }
  50% { transform: translateY(-8px); }
  100% { transform: translateY(0); }
}


.modal-acceso p {
  font-size: 1.15em;
  color: #000;
  font-weight: 600;
  margin-bottom: 30px;
  line-height: 1.5;
  letter-spacing: 0.3px;
  text-shadow: 0 0 5px rgba(212,160,23,0.25); 
}


.btn-arriba {
  display: block;
  background: linear-gradient(135deg, #f4d03f, #f4d03f);
  color: #000;
  font-weight: bold;
  font-size: 1em;     
  padding: 14px 20px;
  border-radius: 8px;
  text-decoration: none;
  margin-bottom: 20px;
  transition: 0.3s ease;
  box-shadow: 0 0 15px rgba(212,160,23,0.8);
}


.btn-arriba:hover {
  background: #fff;
  transform: translateY(-3px);
}


.btn-abajo {
  display: block;
  background: linear-gradient(135deg, #f4d03f, #f4d03f );
  color: #000;
  font-weight: bold;
   font-size: 1em; 
  padding: 14px 20px;
  border-radius: 8px;
  text-decoration: none;
  transition: 0.3s ease;
  box-shadow: 0 0 10px rgba(212,160,23,0.8);
}

.btn-abajo:hover {
background: #fff;
  transform: translateY(-3px);
}


.modal-acceso a {
  display: inline-block;
  width: 45%;
  margin: 10px 5px;
}

.btn-arriba,
.btn-abajo {
  border-radius: 14px;   
  padding: 16px 25px;
  font-size: 1.1em;
  letter-spacing: 1px;
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

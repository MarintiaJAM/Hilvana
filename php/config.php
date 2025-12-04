<?php
$host = "localhost";
$dbname = "jma hilvana"; // cambia si tu base tiene otro nombre
$user = "root"; 
$pass = ""; // XAMPP usa contraseña vacía

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>

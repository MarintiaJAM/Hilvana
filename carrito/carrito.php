<?php
session_start();
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tu carrito 🛒</title>
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background-color: #f7f7f7;
      color: #222;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 40px;
      color: #111;
    }

    .carrito-container {
      max-width: 900px;
      margin: auto;
      background: white;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }

    img {
      width: 80px;
      border-radius: 10px;
    }

    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s ease;
      font-weight: 500;
    }

    .btn-eliminar {
      background-color: #ff4d4d;
      color: white;
    }

    .btn-eliminar:hover {
      background-color: #e60000;
    }

    .total {
      text-align: right;
      font-weight: bold;
      margin-top: 20px;
      font-size: 18px;
    }

    .volver {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #222;
      border: 1px solid #222;
      padding: 8px 14px;
      border-radius: 8px;
      transition: 0.3s;
    }

    .volver:hover {
      background-color: #222;
      color: white;
    }
  </style>
</head>
<body>

  <h1>🛍️ Tu carrito</h1>
  <div class="carrito-container">
    <table>
      <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Eliminar</th>
      </tr>

      <?php
      $sql = "SELECT * FROM carrito";
      $resultado = $conn->query($sql);
      $total = 0;

      if ($resultado->num_rows > 0) {
          while ($fila = $resultado->fetch_assoc()) {
              echo "<tr>";
              echo "<td><img src='" . $fila['imagen'] . "'></td>";
              echo "<td>" . $fila['nombre'] . "</td>";
              echo "<td>$" . number_format($fila['precio'], 2) . "</td>";
              echo "<td>" . $fila['cantidad'] . "</td>";
              echo "<td>
                      <form action='eliminar_carrito.php' method='POST'>
                        <input type='hidden' name='id' value='" . $fila['id'] . "'>
                        <button class='btn btn-eliminar'>✖</button>
                      </form>
                    </td>";
              echo "</tr>";

              $total += $fila['precio'] * $fila['cantidad'];
          }
      } else {
          echo "<tr><td colspan='5'>Tu carrito está vacío 😢</td></tr>";
      }

      $conn->close();
      ?>
    </table>

    <div class="total">
      Total: $<?php echo number_format($total, 2); ?>
    </div>

    <a class="volver" href="inicio.html">← Seguir comprando</a>
  </div>

</body>
</html>

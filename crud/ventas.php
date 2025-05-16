<?php 
// Conexión a la base de datos
require('connection.php'); 
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}


?> 

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/productos_style_crud.css">
        <title>Ventas Realizadas</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <div class="login">
                <?php if (isset($_SESSION['id'])): ?>
                    <nav>
                    <ul><a href="productos.php"><img class="icon"  src="img/logo_magiang.png"></a>
                        <li><a href="productos.php">Productos</a></li>
                        <li><a href="ventas.php">Ventas</a></li>
                        <li><a href="logout.php"><img src="logout.png"></a></li>
                    </ul>
                </nav>
                <?php else: ?>
                    <a href="login.php"><img src="login_logo.png" alt="Login"></a>
                <?php endif; ?>
            </div>
        </header>
        <main>
            <h1> Ventas Realizadas </h1>
            <table>
                <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio producto</th>
                <th>Total</th>
                </tr>
                <?php
                    // query para obtener datos necesssarios para saber cuantos productos han comprado
                    $query = "SELECT p.nombre AS producto, 
                            v.numeros AS cantidad,
                            p.precio AS precio,
                            (v.numeros * p.precio) AS precio_total
                        FROM ventas v
                        JOIN productos p ON v.id_producto = p.id;";
                    $resultat= mysqli_query($conn, $query);
                    // mostrar los resultados
                    if ($resultat && $resultat->num_rows > 0) {
                        while ($row = $resultat->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['producto']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['precio']) . " €</td>";
                            echo "<td>" . htmlspecialchars($row['precio_total']) . " €</td>";
                            echo "</tr>";
                        }
                    }else {
                        echo "<p>No hay ventas en registro.</p>";
                    }
                ?>
            </table>
        </main>
    </body>
</html">
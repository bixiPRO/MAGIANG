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
        <title>Ventas Realizadas</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <div class="login">
                <?php if (isset($_SESSION['id'])): ?>
                    <a href="logout.php"><img src="logout.png"></a>
                <?php else: ?>
                    <a href="login.php"><img src="login_logo.png" alt="Login"></a>
                <?php endif; ?>
            </div>
        </header>
        <main>
            <h1> Ventas Realizadas </h1>
                <?php
                    $query = "SELECT p.nombre AS producto, 
                            v.numeros AS cantidad,
                            p.precio AS precio,
                            (v.numeros * p.precio) AS precio_total
                        FROM ventas v
                        JOIN productos p ON v.id_producto = p.id;";
                    $resultat= mysqli_query($conn, $query);

                    if ($resultat && $resultat->num_rows > 0) {
                        while ($row = $resultat->fetch_assoc()) {
                            echo '<div class="S_content-item">';
                            echo '<p><strong>Producto:</strong> ' . htmlspecialchars($row['producto']) . '</p>';
                            echo '<p><strong>Cantidad:</strong> ' . htmlspecialchars($row['cantidad']) . '</p>';
                            echo '<p><strong>Precio Unitario:</strong> ' . htmlspecialchars($row['precio']) . ' €</p>';
                            echo '<p><strong>Total:</strong> ' . htmlspecialchars($row['precio_total']) . ' €</p>';
                            echo '</div>';
                        }
                    }else {
                        echo "<p>No hay ventas en registro.</p>";
                    }
                ?>
        </main>
    </body>
</html">
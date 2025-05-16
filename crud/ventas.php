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
                            p.precio AS precio_unitario,
                            (v.numeros * p.precio) AS total
                        FROM ventas v
                        JOIN productos p ON v.id_producto = p.id;";
                    $resultat= mysqli_query($conn, $query);

                    if ($resultat && $resultat->num_rows > 0) {
                        while ($row = $resultat->fetch_assoc()) {
                            echo '<div class="S_content-item">';
                            echo '<p><strong>Producto:</strong> ' . htmlspecialchars($row['producto']) . '</p>';
                        }
                    }
                ?>
        </main>
    </body>
</html">
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
        <title>CRUD de productos</title>
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
            <h1> Productos</h1>
                <?php
                    echo "<form action='form_add_producto.php' method='POST' style='display:inline-block;'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='submit' name='submit' value='Añadir'>
                    </form>"
                ?>
        </main>
    </body>
</html">
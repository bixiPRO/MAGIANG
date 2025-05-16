<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Añadir Producto</title>
    <link rel="stylesheet" type="text/css" href="css/add_style_crud.css">
    
</head>
<body>
    <header>
        <div class="login">
            <?php if (isset($_SESSION['id'])): ?>
                <nav>
                    <ul>
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
    <h1>Modificar Producto</h1>
    <!-- formulario para anadir-->
    <form method="POST" action="add_producto.php">

        <label>Nombre:</label>
        <input type="text" name="nombre" required><br/>

        <label>Descripción:</label>
        <input type="text" name="descripcion" required><br/>
        <!-- step para poner decimales poner en php como monedas reales-->
        <label>Precio:</label>
        <input type="number" name="precio" step="0.01" min="0" required><br/>

        <label>Stock:</label>
        <input type="number" name="stock" min="0" required><br/>

        <label>Directorio Imagen:</label>
        <input type="text" name="imagen" ><br/>

        <select name="tipo" required>
            <option value="FISICO">Físico</option>
            <option value="DIGITAL">Digital</option>
        </select><br/>

        <input class="boton-ac" type="submit" value="Anadir Producto">

    </form>
</body>
</html>





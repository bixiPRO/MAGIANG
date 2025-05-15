<?php
session_start();

require('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $tipo = $_POST['tipo'];
    $imagen = '';

    //Insertamos los productos en la base de datos
    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, stock, tipo, imagen) VALUES (?, ?, ?, ?, ?, ?d)");
    $stmt->bind_param("ssdis",$nombre, $descripcion, $precio, $stock, $tipo, $imagen);
    $stmt->execute();
    $stmt->close();

    header("Location: productos.php");

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Producto</title>
    
</head>
<body>
    <h1>Modificar Producto</h1>
    <!-- formulario de la modificacion del producto el selected para opciones en php-->
    <form method="POST" action="modificar_productos.php">
        <input type="hidden" name="id" value="<?= $id ?>"/>

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required><br/>

        <label>Descripción:</label>
        <input type="text" name="descripcion" value="<?= htmlspecialchars($producto['descripcion']) ?>" required><br/>
        <!-- step para poner decimales poner en php como monedas reales-->
        <label>Precio:</label>
        <input type="number" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" step="0.01" min="0" required><br/>

        <label>Stock:</label>
        <input type="number" name="stock" value="<?= htmlspecialchars($producto['stock']) ?>" min="0" required><br/>

        <label>Directorio Imagen:</label>
        <input type="text" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>"><br/>

        <select name="tipo" required>
            <option value="FISICO" <?= $producto['tipo'] == 'FISICO' ? 'selected' : '' ?>>Físico</option>
            <option value="DIGITAL" <?= $producto['tipo'] == 'DIGITAL' ? 'selected' : '' ?>>Digital</option>
        </select><br/>

        <input type="submit" value="Modificar Producto">

    </form>
</body>
</html>




<!DOCTYPE html>
<html>
<head>
    <title>Modificar Producto</title>
    
</head>
<body>
    <h1>Modificar Producto</h1>
    <!-- formulario para anadir-->
    <form method="POST" action="add_productos.php">

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
            <option value="FISICO" <?= $producto['tipo'] == 'FISICO' ? 'selected' : '' ?>>Físico</option>
            <option value="DIGITAL" <?= $producto['tipo'] == 'DIGITAL' ? 'selected' : '' ?>>Digital</option>
        </select><br/>

        <input type="submit" value="Anadir Producto">

    </form>
</body>
</html>

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
    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, stock, tipo, imagen) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis",$nombre, $descripcion, $precio, $stock, $tipo, $imagen);
    $stmt->execute();
    $stmt->close();

    header("Location: productos.php");
    exit();
    

}
?>



<?php
session_start();

require('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $tipo = $_POST['tipo'];
    

    //Insertamos los productos en la base de datos
    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, stock, tipo, imagen) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis",$nombre, $descripcion, $precio, $stock, $tipo);
    $stmt->execute();
    $stmt->close();

    header("Location: productos.php");

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Añadir Producto</title>
</head>
<body>
    <h1>Añadir Producto</h1>
    <form action="add_producto.php" method="POST">
        Nombre: <input type="text" name="nombre" required><br/>
        Categoria: 
        <select name="descripcion" required>
            <option value="Ratones">Ratones</option>
            <option value="Teclados">Teclados</option>
            <option value="Ordenadores">Ordenadores</option>
            <option value="Microfonos">Microfonos</option>
            <option value="Portatiles">Portatiles</option>
            <option value="Monitores">Monitores</option>
        </select><br/>
        Precio:<input type="number" name="precio" placeholder="1.0" step="0.01" min="0" max="100000" required><br/>
        Stock: <input type="number" name="stock" required><br/>
        Formato: 
        <select name="tipo" required>
            <option value="Fisico">Físico</option>
            <option value="Digital">Digital</option>
        </select><br/>
        <input type="submit" value="Añadir Producto">
    </form>
</body>
</html>



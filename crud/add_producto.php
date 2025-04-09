<?php
session_start();

require('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $formato = $_POST['formato'];
    $accion = $_POST['accion'];

    //Insertamos los productos en la base de datos
    $stmt = $conn->prepare("INSERT INTO productos (codigo, nombre, categoria, precio, stock, formato, accion) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdiss",$codigo, $nombre, $categoria, $precio, $stock, $formato, $accion);
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
        Codigo: <input type="text" name="codigo" required><br/>
        Nombre: <input type="text" name="nombre" required><br/>
        Categoria: 
        <select name="categoria" required>
            <option value="Ratones">Ratones</option>
            <option value="Teclados">Teclados</option>
            <option value="Ordenadores">Ordenadores</option>
            <option value="Microfonos">Microfonos</option>
            <option value="Portatiles">Portatiles</option>
            <option value="Monitores">Monitores</option>
        </select><br/>
        Precio:<input type="number" name="precio" placeholder="1.0" step="0.01" min="0" max="100000" />
        Stock: <input type="number" name="stock" required><br/>
        Formato: <input type="text" name="formato" required><br/>
        <input type="submit" value="Añadir Producto">
    </form>
</body>


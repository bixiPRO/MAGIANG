<?php
session_start();

require('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $formato = $_POST['formato'];
    $accion = $_POST['accion'];

    //Insertamos los productos en la base de datos
    $stmt = $conn->prepare("INSERT INTO productos (codigo, nombre, categoria, precio, stock, formato, accion) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdiss",$codigo, $descripcion, $categoria, $precio, $stock, $formato, $accion);
    $stmt->execute();
    $stmt->close();

    header("Location: productos.php");

}
?>




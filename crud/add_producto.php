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
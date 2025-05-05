<?php
session_start();


require('connection.php');

if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $tipo = $_POST['tipo'];
    

    // Actualizar el producto en la base de datos
    $stmt = $conn->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, tipo = ?");
    $stmt->bind_param("ssdis", $nombre, $descripcion, $precio, $stock, $tipo);
    $stmt->execute();
    $stmt->close();
}

header("Location: productos.php");
exit();
?>

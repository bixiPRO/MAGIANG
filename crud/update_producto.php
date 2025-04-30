<?php
session_start();


require('connection.php');

if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $formato = $_POST['formato'];
    

    // Actualizar el producto en la base de datos
    $stmt = $conn->prepare("UPDATE productos SET nombre = ?, categoria = ?, precio = ?, stock = ?, formato = ?);
    $stmt->bind_param("ssdis", $nombre, $categoria, $precio, $stock, $formato);
    $stmt->execute();
    $stmt->close();
}

header("Location: productos.php");
exit();
?>

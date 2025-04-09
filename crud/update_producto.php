<?php
session_start();


require('connection.php');

if (isset($_POST['id'])) {
    $codigo = (int) $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $formato = $_POST['formato'];
    $accion = $_POST['accion'];

    // Actualizar el campeón en la base de datos
    $stmt = $conn->prepare("UPDATE productos SET codigo = ?, nombre = ?, categoria = ?, precio = ?, stock = ?, formato = ?, accion = ? WHERE id = ?");
    $stmt->bind_param("sssdiss", $codigo, $nombre, $categoria, $precio, $stock, $formato, $accion );
    $stmt->execute();
    $stmt->close();
}

header("Location: productos.php");


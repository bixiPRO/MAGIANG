
<?php
session_start();
require('connection.php');

// coger datos del post
$id = (int) $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$imagen = $_POST['imagen'];
$tipo = $_POST['tipo'];

// Actualizar tabla productes
$stmt = $conn->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, imagen = ?, tipo = ? WHERE id = ?");
$stmt->bind_param("ssdissi", $nombre, $descripcion, $precio, $stock, $imagen, $tipo, $id);
$stmt->execute();
$stmt->close();

header('Location: productos.php');
exit();
?>
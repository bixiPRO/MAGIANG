<?php
session_start();

require('connection.php');

if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    // Eliminar el producto de la base de datos
    $stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: productos.php");
exit();
?>



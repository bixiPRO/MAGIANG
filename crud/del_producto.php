<?php
session_start();

require('connection.php');


if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    //para eliminar un producto tendremos que eliminar estos id_productos primeros ya que son referencias
    $tablas = [
        ['tabla' => 'carrito', 'columna' => 'id_producto'],
        ['tabla' => 'cupones', 'columna' => 'id_producto'],
        ['tabla' => 'reseñas', 'columna' => 'id_producto'],
        ['tabla' => 'pro_cat', 'columna' => 'id'],
        ['tabla' => 'pro_pla', 'columna' => 'id'],
        ['tabla' => 'digital', 'columna' => 'id_producto'],
        ['tabla' => 'ventas', 'columna' => 'id_producto'],
    ];
    //un foreach para eliminar cada relacion de las tablas con la lista
    foreach ($tablas as $tabla) {
        $sql = "DELETE FROM {$tabla['tabla']} WHERE {$tabla['columna']} = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    // Eliminar el producto de la base de datos
    $stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
$conn->close();
header("Location: productos.php");
exit();
?>



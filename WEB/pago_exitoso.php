<?php
require 'connection.php';
session_start();




if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $producto_id => $item) {
        $cantidad = $item['cantidad'];

        // Obtener precio actual
        $stmt2 = $conn->prepare("DELETE FROM carrito WHERE id_cliente = ?");
        $stmt2->bind_param("i", $id_cliente);
        $stmt2->execute();
        $stmt2->close();



        $stmt = $conn->prepare("DELETE FROM carrito WHERE id_cliente = ?");
        $stmt->bind_param("i", $id_cliente);
        $stmt->execute();
        $stmt->close();
    }
}
$id_cliente = $_SESSION['id_cliente'];
?>
<html>
<head>
<title>PAGO CON EXITO</title>
</head>
<body>
    <h1> EL PAGO SE HA REALIZADO CON ÉXITO</h1>
    <h2> 

</body>

</html>

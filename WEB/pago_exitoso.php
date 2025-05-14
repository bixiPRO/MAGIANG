<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['id_cliente'])) {
    die("Error: Cliente no identificado.");
}

$id_cliente = $_SESSION['id_cliente'];

if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $producto_id => $item) {
        $cantidad = $item['cantidad'];

        //Obtener el nombre y stock actual del producto
        $stmtProd = $conn->prepare("SELECT nombre, stock FROM productos WHERE id = ?");
        $stmtProd->bind_param("i", $producto_id);
        $stmtProd->execute();
        $result = $stmtProd->get_result();

        if ($row = $result->fetch_assoc()) {
            $nombre = $row['nombre'];
            $stock_actual = $row['stock'];

            // Verificar si hay suficiente stock
            if ($stock_actual < $cantidad) {
                die("Error: Stock insuficiente para el producto: $nombre");
            }

            //Insertar en tabla ventas
            $stmtVenta = $conn->prepare("
                INSERT INTO ventas (id_producto, nombre, numeros) 
                VALUES (?, ?, ?) 
                ON DUPLICATE KEY UPDATE numeros = numeros + VALUES(numeros)
            ");
            $stmtVenta->bind_param("isi", $producto_id, $nombre, $cantidad);
            $stmtVenta->execute();
            $stmtVenta->close();

            //Restar del stock del producto
            $nuevo_stock = $stock_actual - $cantidad;
            $stmtUpdate = $conn->prepare("UPDATE productos SET stock = ? WHERE id = ?");
            $stmtUpdate->bind_param("ii", $nuevo_stock, $producto_id);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }
        $stmtProd->close();
    }
    // vaciar en la base de datos de carrito
    $stmt = $conn->prepare("DELETE FROM carrito WHERE id_cliente = ?");
    $stmt->bind_param("i", $id_cliente);
    $stmt->execute();
    $stmt->close();
        
    //vaciar la cession de carrito
    unset($_SESSION['carrito']);unset($_SESSION['carrito']);
}





?>
<html>
<head>
<title>PAGO CON EXITO</title>
</head>
<body>
    <h1> EL PAGO SE HA REALIZADO CON ÉXITO</h1>
    <p>Gracias por tu compra. Hemos registrado tu pedido correctamente.</p>
    <a href="productos.php">← Volver a comprar</a>

</body>

</html>

<?php
session_start();
require('connection.php');

//sino hay id del cliente se tiene que loguearse y le redireciona el login.php
if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit();
}

$id_cliente = $_SESSION['id_cliente'];


// Insertar cada producto del carrito
if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $producto_id => $item) {
        $cantidad = $item['cantidad'];

        // Obtener precio actual
        $stmt = $conn->prepare("SELECT precio FROM productos WHERE id = ?");
        $stmt->bind_param("i", $producto_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $precio_unitario = $row['precio'];
            $precio_total = $precio_unitario * $cantidad;

            // Insertar en la tabla carrito una fila por producto
            $insert = $conn->prepare("INSERT INTO carrito (id_cliente, id_producto, cantidad, precio_total)
                                      VALUES (?, ?, ?, ?)
                                      ON DUPLICATE KEY UPDATE 
                                        cantidad = VALUES(cantidad),
                                        precio_total = VALUES(precio_total)");
            $insert->bind_param("iiid", $id_cliente, $producto_id, $cantidad, $precio_total);
            $insert->execute();
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title> Pago - Magiang </title>
    <favicon href="img/favicon.">
    <link rel="stylesheet" type="text/css" href="css/pago-styles.css">
    <encode utf-8>
</head>
<body>
     <!-- ZONA NAV -->
     <header>
        <div class="header-content"><a href="home.php"><img class="icon"  src="img/logo_magiang.png"></a></div>
        <div>
            <nav>
                <ul>
                    <li><a href="productos.php">Productos</a></li>
                    <li><a href="contacto.html">Soporte</a></li>
                    <li><a href="sede.html">Sede</a></li>
                    <li><a href="nosotros.html">Sobre nosotros</a></li>
                </ul>
                </nav>
        
        </div>
        <div class="login">
                <a href="cesta.php"><img src="img/cesta.png"></a>
                <a href="login.php"><img src="img/login_logo.png"></a>
         </div>
        
    </header>

    <!--ZONA FORMULARIO PAGO-->


    <main>
        <h2> <a>Datos de pedido:</a></h2>
        <form action="seleccion_pago.php" method="POST">
            <h3>Datos de Facturación:</h3>
            
            <label>Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>
                
            <label>Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required><br><br>
            
            <label>Teléfono:</label>
            <input type="number" id="telefono" name="telefono" required><br><br>

            <label>País:</label>
            <input type="text" id="pais" name="pais" required><br><br>

            <label>Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" required><br><br>

            <label>Codigo postal:</label>
            <input type="number" id="codigo_postal" name="codigo_postal" required><br><br>
                
            <label>Dirección:</label>
            <input type="text" id="direccion" name="direccion" required><br><br>
                
            <label>Piso, puerta u otro:</label>
            <input type="text" id="puerta" name="puerta" required><br><br>
            
            <button class="boton-pay" type="submit">Continuar con el pago</button>
        </form>
    
    </main>

<!-- ZONA FOOTER-->
    <footer>
        <div>
            <img class="icon2" src="img/logo_magiang.png" alt="Imagen"> 
            <a class="footertitlelogo">Magiang</a>
        </div>
    
        <p>©2025</p>
        <p>Todos los derechos reservados. </p>
        <p>Descubre las mejores ofertas i compra al mejor precio con nuestra plataforma.</p>
        <p>Da el salto a nuevos mundos con Magiang</p>
        <p>¡Contáctanos en desde el apartado de <a href="contacto.html">Contacto</a> en nuestra web!</p>
    </footer>
</body>
</html>
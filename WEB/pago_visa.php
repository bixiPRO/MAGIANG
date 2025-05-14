<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PAGO VISA</title>
    <link rel="stylesheet" type="text/css" href="css/pago-styles.css">
</head>
<body>
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
    <main>
        <h2> <a>Pago Visa</a></h2> <br>
        <br>
        <form method="POST">
            <label>Numero de tarjeta:</label><br>
            <input type="text" name="num_tarjeta" required><br><br>

            <label>Fecha de caducidad (MM/AA):</label><br>
            <input type="text" name="fecha_cad" required><br><br>

            <label>Codigo de seguridad:</label><br>
            <input type="number" name="cod_seg" required><br><br>

            <label>Nombre del titular:</label><br>
            <input type="text" name="nombre_titular" required><br><br>

            <button class="boton-pay" type="submit">Pagar</button>
        </form>
    
    </main>
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

<?php
session_start();
require('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id_pedido'])) {
        die("Error: No hay un pedido activo.");
    }
    $id_pedido = $_SESSION['id_pedido'];
    $metodo = "VISA/MASTERCARD";
    /**Datos del formulario para las tarjetas */
    $num_tarjeta = $_POST['num_tarjeta'] ?? null;
    $fecha_cad = $_POST['fecha_cad'] ?? null;
    $cod_seg = $_POST['cod_seg'] ?? null;
    $nombre_titular = $_POST['nombre_titular'] ?? null;

    if (!$num_tarjeta || !$fecha_cad || !$cod_seg || !$nombre_titular) {
        die("Error: Todos los campos son obligatorios.");
    }

    $stmtPago = $conn->prepare("INSERT INTO pago (id_pedido, metodo_pago) VALUES (?, ?)");
    $stmtPago->bind_param("is", $id_pedido, $metodo);
    $stmtPago->execute();
    $id_pago = $stmtPago->insert_id;
    $stmtPago->close();

    $stmtVisa = $conn->prepare("INSERT INTO visa_mastercard (id_pago, num_tarjeta, fecha_cad, cod_seg, nombre_titular) VALUES (?, ?, ?, ?, ?)");
    $stmtVisa->bind_param("issis", $id_pago, $num_tarjeta, $fecha_cad, $cod_seg, $nombre_titular);
    $stmtVisa->execute();
    $stmtVisa->close();

    $conn->close();

    // Redirigir a página mail.php
    hheader("Location: mail.php?id_pedido=$id_pedido");
    exit();
}

?>
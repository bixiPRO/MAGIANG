<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PAGO BIZUM</title>
    <link rel="stylesheet" type="text/css" href="css/pago-styles.css">
</head>
<body>
<header>
        <div class="header-content"><a href="home.php"><img class="icon"  src="img/logo_magiang.png"></a></div>
        <div>
            <nav>
                <ul>
                    <li><a href="productos.php">Productos</a></li>
                    <li><a href="contacto.php">Soporte</a></li>
                    <li><a href="sede.php">Sede</a></li>
                    <li><a href="nosotros.php">Sobre nosotros</a></li>
                </ul>
            </nav>
        
        </div>
        <div class="login">
            <a href="cesta.php"><img src="img/cesta.png"></a>

            <?php if (isset($_SESSION['nombre_usuario'])): ?>
                <span class="bienvenida"><?= htmlspecialchars($_SESSION['nombre_usuario']) ?></span>
                <a href="logout.php"><img src="img/logout.png"></a>
            <?php else: ?>
                <a href="login.php"><img src="img/login_logo.png" alt="Login"></a>
            <?php endif; ?>
        </div>
        
    </header>

    <main>
        <h2> <a>PAGO BIZUM</a></h2>
        <form method="POST">
            
            <label>Pon tu numero de telefono:</label>
            <input type="number" id="telefono" name="telefono" required><br><br>
            <button class="boton-pay" type="submit">Pagar</button>
        </form>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
        <p>¡Contáctanos en desde el apartado de <a href="contacto.php">Contacto</a> en nuestra web!</p>
    </footer>

</body>
</html>

<?php
session_start();
require('connection.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificamos que haya un pedido en curso
    if (!isset($_SESSION['id_pedido'])) {
        die("Error: No hay un pedido registrado.");
    }

    if (php_sapi_name() === 'cli' && isset($argv[1])) {
        parse_str($argv[1], $_GET);
    }

    $id_pedido = $_SESSION['id_pedido'];
    $telefono = $_POST['telefono'] ?? null;

    if (!$telefono) {
        die("Error: Teléfono no válido.");
    }

    // Insertar en tabla pago
    $metodo = "VIZUM";
    $stmtPago = $conn->prepare("INSERT INTO pago (id_pedido, metodo_pago) VALUES (?, ?)");
    $stmtPago->bind_param("is", $id_pedido, $metodo);
    $stmtPago->execute();

    // Obtener el id del pago
    $id_pago = $stmtPago->insert_id;
    $stmtPago->close();

    // Insertar en tabla bizum
    $stmtBizum = $conn->prepare("INSERT INTO bizum (id_pago, telefono) VALUES (?, ?)");
    $stmtBizum->bind_param("ii", $id_pago, $telefono);
    $stmtBizum->execute();
    $stmtBizum->close();

    // Cerrar 
    $conn->close();

    //ejecutar en segundo plano
    //shell_exec("php /var/www/MAGIANG/WEB/mail.php \"id_pedido=$id_pedido\" > /dev/null 2>&1 &");

    // Redirigir a mail.php
    header("Location: mail.php?id_pedido=$id_pedido");

    //header("Location: ./pago_exito.php");
    exit();
}
?>
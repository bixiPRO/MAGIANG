<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PAGO PAYPAL</title>
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
        <h2> <a>PAGO PAYPAL</a></h2>
        <form method="POST">
            
            <label>Pon tu correo electronico:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label>Contrasenya:</label>
            <input type="password" id="contrasenya" name="contrasenya" required><br><br>

            <button class="boton-pay" type="submit">Pagar</button>
        </form>
    
    </main>

</body>
</html>

<?php
session_start();
require('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificamos que haya un pedido en curso
    if (!isset($_SESSION['id_pedido'])) {
        die("Error: No hay un pedido activo.");
    }

    $id_pedido = $_SESSION['id_pedido'];
    $email = $_POST['email'] ?? null;
    $password1 = $_POST['contrasenya'] ?? null;


    if (strlen($password1) < 6) {
        die("Error: Datos inválidos.");
    }

    $hash = password_hash($password1,PASSWORD_DEFAULT);
    // Insertar en tabla pago
    $metodo = "PAYPAL";
    $stmtPago = $conn->prepare("INSERT INTO pago (id_pedido, metodo_pago) VALUES (?, ?)");
    $stmtPago->bind_param("is", $id_pedido, $metodo);
    $stmtPago->execute();

    $id_pago = $stmtPago->insert_id;
    $stmtPago->close();
    // Insertar en tabla paypal
    $stmtPaypal = $conn->prepare("INSERT INTO paypal (id_pago, email, contrasenya) VALUES (?, ?, ?)");
    $stmtPaypal->bind_param("iss", $id_pago, $email, $hash);
    $stmtPaypal->execute();
    $stmtPaypal->close();


    
    $conn->close();

    echo "Pago finalizado";

    header("Location: mail.php?id_pedido=$id_pedido");
    exit();
}
?>

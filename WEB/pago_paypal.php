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
        <h2> <a>PAGO PAYPAL</a></h2>
        <form action=pago_paypal.php method="POST">
            
            <label>Pon tu correo electronico:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label>Contrasenya:</label>
            <input type="password" id="contrasenya" name="contrasenya" required><br><br>

            <<button class="boton-pay" type="submit">Pagar</button>
        </form>
    
    </main>

</body>
</html>

<?php
session_start();
require('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id_pedido'])) {
        die("Error: No hay un pedido activo.");
    }



    if (strlen($password1) < 6) {
        header("Location: pago_paypal.php");
        exit();
    }

    $hash = password_hash($password1,PASSWORD_DEFAULT);

    $stmt = $conn->prepare("");
    $stmt->bind_param("sss", $email, $username, $hash);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo "Pago finalizado";
}
?>

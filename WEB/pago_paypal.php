<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>PAGO PAYPAL</title>
=======
    <title>PAGO BIZUM</title>
    <link rel="stylesheet" type="text/css" href="css/pago-styles.css">
>>>>>>> 17aa3e487621684fb18698d955aa7c6b91dffd06
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
<<<<<<< HEAD
        <h2> <a>PAGO PAYPAL</a></h2>
        <form action=pago_paypal.php method="POST">
=======
        <h2> <a>PAGO Paypal</a></h2>
        <form method="POST">
>>>>>>> 17aa3e487621684fb18698d955aa7c6b91dffd06
            
            <label>Pon tu correo electronico:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label>Contrasenya:</label>
            <input type="password" id="contrasenya" name="contrasenya" required><br><br>

            <a class="boton-pay" href="mail.php">Pagar</a>
        </form>
    
    </main>

</body>
</html>

<?php
session_start();
require('connection.php');

$id_cliente = $_SESSION['id_cliente'];
$password1 = $_POST['contrasenya'];

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
?>

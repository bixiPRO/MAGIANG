<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PAGO PAYPAL</title>
</head>
<body>

    <main>
        <h2> <a>PAGO PAYPAL</a></h2>
        <form action=pago_paypal.php method="POST">
            
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


<?php 
    session_start();
    require('connection.php');

    if (!isset($_SESSION['id_cliente'])) {
        // Mostrar mensaje error si hay algun error con el login
        $_SESSION['error_pago'] = "Debes iniciar sesión para continuar con el pago";
        header("Location: login.php");
        exit();
    }

    $id_cliente = $_SESSION['id_cliente'];

    // La seccio per coger la información del formulario de la pagina pago.php
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $codigo_postal = $_POST['codigo_postal'];
    $direccion = $_POST['direccion'];
    $puerta = $_POST['puerta'];


    $stmt = $conn->prepare("INSERT INTO pedidos (id_cliente, nombre, apellidos, telefono, pais, direccion, piso_puerta_otro, codigo_postal, ciudad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
    $stmt->bind_param("issssssss", $id_cliente, $nombre, $apellidos, $telefono, $pais, $direccion, $puerta, $codigo_postal, $ciudad);
    $stmt->execute();

    /*$_SESSION['id_pedido'] = $stmt->insert_id; */

  
    $stmt->close();
    $conn->close();

    echo "Formulario registrado"
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Selecciona Método de Pago</title>
</head>
<body>

<h1>Selecciona tu método de pago</h1>

<ul>
    <li><a href="pago_visa.php">Visa / Mastercard</a></li>
    <li><a href="pago_paypal.php">PayPal</a></li>
    <li><a href="pago_bizum.php">Bizum</a></li>
</ul>

</body>
</html>

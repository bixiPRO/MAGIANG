
<?php 
    session_start();
    require('connection.php');
    // La seccio per coger la información del formulario de la pagina pago.php
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $codigo_postal = $_POST['codigo_postal'];
    $direccion = $_POST['direccion'];
    $puerta = $_POST['puerta'];
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
    <form action="seleccion_pago.php" method="post">
        <h3>CAPCHA: </h3>
        <h5>Introduce el mail que has registrado de tu cuenta para la comprovación</h5> </br></br>
        <label>Correo electronico:</label>
        <input type="email" id="email" name="email" required><br><br>
    </form>

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
    $email = $_POST['email']




    $stmt = $conn->prepare("INSERT INTO pedidos ( id_cliente ,nombre, apellidos, telefono, pais, ciudad, codigo_postal, direccion, piso_puerta_otro) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $email, $username, $hash);
    $stmt->execute();

  
    $stmt->close();
    $conn->close();

    echo "Formulario registrado"
?>

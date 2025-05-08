
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

    $id_cliente = $_POST[]



    $stmt = $conn->prepare("INSERT INTO pedidos ( id_cliente ,nombre, apellidos, telefono, pais, ciudad, codigo_postal, direccion, piso_puerta_otro) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $email, $username, $hash);
    $stmt->execute();

  
    $stmt->close();
    $conn->close();

    echo "Formulario registrado"
?>

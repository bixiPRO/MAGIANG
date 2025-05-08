<?php 
    session_start();
    require('connection.php');
    // La seccio per coger la información del formulario de la pagina pago.php
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO clientes (email, nombre_usuario, contrasenya) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $username, $hash);
    $stmt->execute();

  
    $stmt->close();
    $conn->close();

    echo "Registro creado"
?>
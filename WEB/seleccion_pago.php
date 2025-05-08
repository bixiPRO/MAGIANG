
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

    $email = $_POST['email']

    $stmt = $conn->prepare("SELECT id FROM clientes WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    

  
    $stmt->close();
    $conn->close();

    echo "Formulario registrado"
?>

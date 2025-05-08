<?php 
    session_start();
    // La seccio per coger la información del formulario de la pagina pago.php
    $_SESSION['pedido'] = [
        'nombre' => $_POST['nombre'],
        'apellidos' => $_POST['apellidos'],
        'direccion' => $_POST['direccion'],
        'telefono' => $_POST['telefono'],
        'email' => $_POST['email']
    ];
?>
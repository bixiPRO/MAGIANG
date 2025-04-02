<?php
session_start();
require('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['gmail'];
    $password1 = $_POST['pwd1'];
    $password2 = $_POST['pwd2'];

    if (empty($email) || empty($password1) || empty($password2)) {
        $_SESSION['error'] = "Todos los campos son obligatorios";
        header("Location: login.php");
        exit();
    }

    if ($password1 !== $password2) {
        $_SESSION['error'] = "Las contraseñas no coinciden";
        header("Location: login.php");
        exit();
    }

    $query = "INSERT INTO clientes (email, contrasenya) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password1);
}
?>
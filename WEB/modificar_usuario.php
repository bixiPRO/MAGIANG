<?php
session_start();
require('connection.php');

// Asegurarse de que el usuario esté iniciado 
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <header>
        <h2>Modificar cuenta</h2>
    </header>
    <main>
        <form method="POST">
            <label for="nuevo_nombre">Nuevo nombre de usuario:</label>
            <input type="text" name="nuevo_nombre" id="nuevo_nombre" value="<?= htmlspecialchars($nombre_actual) ?>" required>
            <button type="submit">Actualizar</button>
        </form>
        <hr>
        <form method="POST">
            <p>Estas seguro de eliminar esta cuenta?</p>
            <input type="hidden" name="eliminar" value="1">
            <button type="submit" style="background-color: red; color: white;">Eliminar cuenta</button>
        </form>
    </main>
</body>
</html>
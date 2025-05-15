<?php
session_start();
require('connection.php');

// Asegurarse de que el usuario esté iniciado 
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // elimina la cuenta, cierra seccion y redirige a la pagina home.php
    if (isset($_POST['eliminar']) && $_POST['eliminar'] == '1') {
        $stmt = $conn->prepare("DELETE FROM clientes WHERE id = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $stmt->close();

        session_destroy(); 
        header("Location: home.php"); 
        exit();
    }

    //modifica el nombre de l'usuario y accede a la seccion con el nombre del usuario modificado
    if (!empty($_POST['nuevo_nombre'])) {
        $nuevo_nombre = trim($_POST['nuevo_nombre']);
        $stmt = $conn->prepare("UPDATE clientes SET nombre_usuario = ? WHERE id = ?");
        $stmt->bind_param("si", $nuevo_nombre, $id_usuario);
        $stmt->execute();
        $stmt->close();
        $_SESSION['nombre_usuario'] = $nuevo_nombre;
    }
}   
// Obtener nombre actual
$stmt = $conn->prepare("SELECT nombre_usuario FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$stmt->bind_result($nombre_actual);
$stmt->fetch();
$stmt->close();

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
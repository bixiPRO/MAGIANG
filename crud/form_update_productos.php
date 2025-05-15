<?php
session_start();


require('connection.php');

if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    // Obtener los datos del producto
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();
    $stmt->close();
} else {
    header("Location: productos.php");
    exit();
}

$id = (int) $_POST['id'];

// Obtener datos del producto
$stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();
$stmt->close();

// Obtener todas las plataformas de la base de datos 
$plataformas = [];
$res = $conn->query("SELECT * FROM plataformas");
while ($row = $res->fetch_assoc()) {
    $plataformas[] = $row;
}

// Obtener todas las categorias de la base de datos 
$plataformas = [];
$categorias = [];
$res = $conn->query("SELECT * FROM categorias");
while ($row = $res->fetch_assoc()) {
    $categorias[] = $row;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Modificar Producto</title>
    
</head>
<body>
    <h1>Modificar Producto</h1>
    <form action="update_producto.php" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>"/>

        <select name="tipo" required>
            <option value="Fisico" <?= $producto['tipo'] == 'Fisico' ? 'selected' : '' ?>>Físico</option>
            <option value="Digital" <?= $producto['tipo'] == 'Digital' ? 'selected' : '' ?>>Digital</option>
        </select><br/>
        <input type="submit" value="Modificar Producto">
    </form>
</body>
</html>

    

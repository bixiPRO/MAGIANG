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
        Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required><br/>
        Categoria: 
        <select name="descripcion" required>
            <option value="Ratones" <?= $producto['descripcion'] == 'Ratones' ? 'selected' : '' ?>>Ratones</option>
            <option value="Teclados" <?= $producto['descripcion'] == 'Teclados' ? 'selected' : '' ?>>Teclados</option>
            <option value="Ordenadores" <?= $producto['descripcion'] == 'Ordenadores' ? 'selected' : '' ?>>Ordenadores</option>
            <option value="Microfonos" <?= $producto['descripcion'] == 'Microfonos' ? 'selected' : '' ?>>Microfonos</option>
            <option value="Portatiles" <?= $producto['descripcion'] == 'Portatiles' ? 'selected' : '' ?>>Portatiles</option>
            <option value="Monitores" <?= $producto['descripcion'] == 'Monitores' ? 'selected' : '' ?>>Monitores</option>
        </select><br/>
        Precio: <input type="number" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" step="0.01" min="0" max="100000" required><br/>
        Stock: <input type="number" name="stock" value="<?= htmlspecialchars($producto['stock']) ?>" required><br/>
        Formato: 
        <select name="tipo" required>
            <option value="Fisico" <?= $producto['tipo'] == 'Fisico' ? 'selected' : '' ?>>Físico</option>
            <option value="Digital" <?= $producto['tipo'] == 'Digital' ? 'selected' : '' ?>>Digital</option>
        </select><br/>
        <input type="submit" value="Modificar Producto">
    </form>
</body>
</html>

    

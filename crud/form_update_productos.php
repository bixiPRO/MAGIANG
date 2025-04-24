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
    $campio = $result->fetch_assoc();
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
        <select name="categoria" required>
            <option value="Ratones" <?= $producto['categoria'] == 'Ratones' ? 'selected' : '' ?>>Ratones</option>
            <option value="Teclados" <?= $producto['categoria'] == 'Teclados' ? 'selected' : '' ?>>Teclados</option>
            <option value="Ordenadores" <?= $producto['categoria'] == 'Ordenadores' ? 'selected' : '' ?>>Ordenadores</option>
            <option value="Microfonos" <?= $producto['categoria'] == 'Microfonos' ? 'selected' : '' ?>>Microfonos</option>
            <option value="Portatiles" <?= $producto['categoria'] == 'Portatiles' ? 'selected' : '' ?>>Portatiles</option>
            <option value="Monitores" <?= $producto['categoria'] == 'Monitores' ? 'selected' : '' ?>>Monitores</option>
        </select><br/>
        Precio: <input type="number" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" required><br/>
        Stock: <input type="number" name="stock" value="<?= htmlspecialchars($producto['stock']) ?>" required><br/>
        Formato:
        <fieldset>
            <div>
                <input type="checkbox" id="fisico" name="formato" value="<?= htmlspecialchars($producto['formato']) ?>" required><br/>
                <label for="coding">Fisico</label>
            </div>
            <div>
                <input type="checkbox" id="digital" name="formato" value="<?= htmlspecialchars($producto['formato']) ?>" required><br/>
                <label for="music">Digital</label>
            </div>
        </fieldset>
 
        <input type="submit" value="Modificar Producto">
    </form>
</body>
</html>

    

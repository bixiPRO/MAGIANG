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


?>
<!DOCTYPE html>
<html>
<head>
    <title>Modificar Producto</title>
    <link rel="stylesheet" type="text/css" href="css/add_style_crud.css">
</head>
<body>
    <header>
        <div class="login">
            <?php if (isset($_SESSION['id'])): ?>
                <nav>
                    <ul>
                        <li><a href="productos.php">Productos</a></li>
                        <li><a href="ventas.php">Ventas</a></li>
                        <li><a href="logout.php"><img src="logout.png"></a></li>
                    </ul>
                </nav>
            <?php else: ?>
                <a href="login.php"><img src="login_logo.png" alt="Login"></a>
            <?php endif; ?>
        </div>
    </header>
    <h1>Modificar Producto</h1>
    <!-- formulario de la modificacion del producto el selected para opciones en php-->
    <form method="POST" action="modificar_productos.php">
        <input type="hidden" name="id" value="<?= $id ?>"/>

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required><br/>

        <label>Descripción:</label>
        <input type="text" name="descripcion" value="<?= htmlspecialchars($producto['descripcion']) ?>" required><br/>
        <!-- step para poner decimales poner en php como monedas reales-->
        <label>Precio:</label>
        <input type="number" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" step="0.01" min="0" required><br/>

        <label>Stock:</label>
        <input type="number" name="stock" value="<?= htmlspecialchars($producto['stock']) ?>" min="0" required><br/>

        <label>Directorio Imagen:</label>
        <input type="text" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>"><br/>

        <select name="tipo" required>
            <option value="FISICO" <?= $producto['tipo'] == 'FISICO' ? 'selected' : '' ?>>Físico</option>
            <option value="DIGITAL" <?= $producto['tipo'] == 'DIGITAL' ? 'selected' : '' ?>>Digital</option>
        </select><br/>

        <input type="submit" value="Modificar Producto">

    </form>
</body>
</html>

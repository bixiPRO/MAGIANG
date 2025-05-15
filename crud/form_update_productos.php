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
$categorias = [];
$res = $conn->query("SELECT * FROM categorias");
while ($row = $res->fetch_assoc()) {
    $categorias[] = $row;
}

// Obtener plataforma amb el id producto de la tabla pro_pla
$plataforma_id = null;
$res = $conn->prepare("SELECT id_plataforma FROM pro_pla WHERE id = ?");
$res->bind_param("i", $id);
$res->execute();
$res->bind_result($plataforma_id);
$res->fetch();
$res->close();

// Obtener categoria amb el id producto de la tabla pro_cat
$categoria_id = null;
$res = $conn->prepare("SELECT id_categoria FROM pro_cat WHERE id = ?");
$res->bind_param("i", $id);
$res->execute();
$res->bind_result($categoria_id);
$res->fetch();
$res->close();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Modificar Producto</title>
    
</head>
<body>
    <h1>Modificar Producto</h1>
    <!-- formulario de la modificacion del producto el selected para opciones en php-->
    <form  method="POST">
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
        <!-- forech para buscar en la lista de plataforma el que tiene la misma id que lo ponga y selected para los opciones -->
        <label>Plataforma:</label>
        <select name="plataforma">
            <option value=""> </option>
            <?php foreach ($plataformas as $plataforma): ?>
                <option value="<?= $plataforma['id'] ?>" <?= $plataforma['id'] == $plataforma_id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($plataforma['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select><br/>
        <!-- forech para buscar en la lista de categoria el que tiene la misma id que lo ponga y selected para los opciones -->
        <label>Categoría:</label>
        <select name="categoria">
            <option value=""> </option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>" <?= $categoria['id'] == $categoria_id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($categoria['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select><br/>

        <input type="submit" value="Modificar Producto">

    </form>
</body>
</html>

<?php

// coger datos del post
$id = (int) $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$imagen = $_POST['imagen'];
$tipo = $_POST['tipo'];

// Actualizar tabla productes
$stmt = $conn->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, imagen = ?, tipo = ? WHERE id = ?");
$stmt->bind_param("ssdisss", $nombre, $descripcion, $precio, $stock, $imagen, $tipo, $id);
$stmt->execute();
$stmt->close();


?>
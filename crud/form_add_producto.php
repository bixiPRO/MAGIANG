
<!DOCTYPE html>
<html>
<head>
    <title>Modificar Producto</title>
    
</head>
<body>
    <h1>Modificar Producto</h1>
    <!-- formulario para anadir-->
    <form method="POST" action="add_producto.php">

        <label>Nombre:</label>
        <input type="text" name="nombre" required><br/>

        <label>Descripción:</label>
        <input type="text" name="descripcion" required><br/>
        <!-- step para poner decimales poner en php como monedas reales-->
        <label>Precio:</label>
        <input type="number" name="precio" step="0.01" min="0" required><br/>

        <label>Stock:</label>
        <input type="number" name="stock" min="0" required><br/>

        <label>Directorio Imagen:</label>
        <input type="text" name="imagen" ><br/>

        <select name="tipo" required>
            <option value="FISICO">Físico</option>
            <option value="DIGITAL">Digital</option>
        </select><br/>

        <input type="submit" value="Anadir Producto">

    </form>
</body>
</html>





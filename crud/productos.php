<?php
session_start();   
// Conexión a la base de datos
require('connection.php'); 

// Obtener los productos desde la base de datos
$query = "SELECT * FROM productos";
if (isset($_GET['filtrar_categoria']) && !empty($_GET['filtrar_categoria'])) {
    $filtrar_categoria = $_GET['filtrar_categoria'];
    $query .= " WHERE categorias = '$filtrar_categoria'";
}
$result = $conn->query($query);
?>                  









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de productos</title>
    <meta charset="UTF-8">
</head>
<body>
<div>    
<!-- Tabla de productos -->
<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Formato</th>
            <th>Acción</th>        
        
        </tr>
    </thead>
    
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row =$result-> fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['codigo']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
                echo "<td>" . htmlspecialchars($row['precio']) . "</td>";
                echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
                echo "<td>" . htmlspecialchars($row['formato']) . "</td>";
                echo "<td>" . htmlspecialchars($row['accion']) . "</td>";
                echo "</tr>";



            }    
        }               
        ?>                
                     
    </tbody>                
</table>                

<!-- Formulario de filtrado por Categorias -->

    <form method="GET" action="productos.php">
        <label for="filtrar_categoria">Filtrar por Clase:</label>
        <select name="filtrar_categoria">
            <option value="">Todas</option>
            <option value="Ratones" <?= (isset($_GET['filtrar_categoria']) && $_GET['filtrar_categoria'] == 'Ratones') ? 'selected' : '' ?>>Ratones</option>
            <option value="Teclados" <?= (isset($_GET['filtrar_categoria']) && $_GET['filtrar_categoria'] == 'Teclados') ? 'selected' : '' ?>>Teclados</option>
            <option value="Ordenadores" <?= (isset($_GET['filtrar_categoria']) && $_GET['filtrar_categoria'] == 'Ordenadores') ? 'selected' : '' ?>>Ordenadores</option>
            <option value="Microfonos" <?= (isset($_GET['filtrar_categoria']) && $_GET['filtrar_categoria'] == 'Microfonos') ? 'selected' : '' ?>>Micrófonos</option>
            <option value="Portatiles" <?= (isset($_GET['filtrar_categoria']) && $_GET['filtrar_categoria'] == 'Portatiles') ? 'selected' : '' ?>>Portátiles</option>
            <option value="Monitores" <?= (isset($_GET['filtrar_categoria']) && $_GET['filtrar_categoria'] == 'Monitores') ? 'selected' : '' ?>>Monitores</option>
        </select><br/>
        <input type="submit" value="Filtrar" />
               
    </form>
</div>    
</body>
</html>


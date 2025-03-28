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
    
<!-- Tabla de productos -->
<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Descripción</th>
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
                echo "<td>" . htmlspecialchars($row['Código']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Descripción']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Categoría']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Precio']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Stock']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Formato']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Acción']) . "</td>";
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
                <option value="Micrófonos" <?= (isset($_GET['filtrar_categoria']) && $_GET['filtrar_categoria'] == 'Micrófonos') ? 'selected' : '' ?>>Micrófonos</option>
                <option value="Portátiles" <?= (isset($_GET['filtrar_categoria']) && $_GET['filtrar_categoria'] == 'Portátiles') ? 'selected' : '' ?>>Portátiles</option>
                <option value="Monitores" <?= (isset($_GET['filtrar_categoria']) && $_GET['filtrar_categoria'] == 'Monitores') ? 'selected' : '' ?>>Monitores</option>
            </select><br/>
            <input type="submit" value="Filtrar" />
</form>
</body>
</html>


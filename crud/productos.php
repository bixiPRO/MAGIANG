<?php


      $filasmax = 20;

    if (isset($_GET['pag']))
        {
        $pagina = $_GET['pag'];
    } else
        {
        $pagina = 1;        
    }   
    
// Conexión a la base de datos
require('connection.php'); 






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


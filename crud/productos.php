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
    
</body>
</html>


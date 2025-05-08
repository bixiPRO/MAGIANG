<?php 
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

    
    <main>
        <h1> Productos</h1>
        <!-- FILTRE -->
        <form method="POST">
            <label for="tipo">Tipo:</label>
            <select name="tipo" >
                <option value="">Selecciona...</option>  
                <option value="DIGITAL">Digital</option>
                <option value="FISICO">Fisico</option>
            </select>

            <label for="plataforma">Plataforma:</label>
            <select name="plataforma" >
                <option value="">Selecciona...</option> 
                <option value="PC">PC</option>
                <option value="Apple">Apple</option>
                <option value="Google Play">Google Play</option>
                <option value="Xbox">Xbox</option>
                <option value="Switch">Switch</option>
                <option value="Playstation">Playstation</option>
            </select>
            <label for="categoria">Categoria:</label>
            <select name="categoria" >
                <option value="">Selecciona...</option> 
                <option value="Alfombrilla">Alfombrilla</option>
                <option value="Android">Android</option>
                <option value="Apple">Apple</option>
                <option value="Auriculares">Auriculares</option>
                <option value="Gaming">Gaming</option>
                <option value="Micrófonos">Micrófonos</option>
                <option value="Mobil">Mobil</option>
                <option value="Monitores">Monitores</option>
                <option value="Oficina">Oficina</option>
                <option value="Ordenadores">Ordenadores</option>
                <option value="Portátiles">Portátiles</option>
                <option value="Raton">Raton</option>
                <option value="Tablet">Tablet</option>
                <option value="Teclado">Teclado</option>
            </select>
            <label for="precio">Precio:</label>
            <select name="precio" >
                <option value="">Selecciona...</option> 
                <option value="0-100">0-100</option>
                <option value="100-250">100-250</option>
                <option value="250-500">250-500</option>
                <option value="500-1000">500-1000</option>
                <option value="1000-2000">1000-2000</option>
                <option value="2000-10000">2000-10000</option>
            </select>
            <label for="ordenar">Ordenar por</label>
            <select name="ordenar" >
                <option value="">Selecciona...</option> 
                <option value="Nombre">Nombre</option>
                <option value="Precio">Precio</option>
                <option value="Valoracion">Valoracion</option>
            </select>
            <input type="submit" value="Filtrar" />
            <input type="reset" value="Reset" />
      </form>

      <div class="S_content_group">
        <!-- PHP FUNCIÓN FILTRE -->
        <?php
            $query = "SELECT * FROM productos WHERE 1=1";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!empty($_POST['tipo'])) {
                    $tipo = $conn->real_escape_string($_POST['tipo']);
                    $query .= " AND tipo='$tipo'";
                }
                if (!empty($_POST['ordenar'])) {
                    $ordenar = $conn->real_escape_string($_POST['ordenar']);
                    $query .= " ORDER BY $ordenar";
                }
                if (!empty($_POST['precio'])) {
                    $precio = explode('-', $_POST['precio']);
                    $min_price = (int)$precio[0];
                    $max_price = (int)$precio[1];
                    $query .= " AND precio BETWEEN $min_price AND $max_price";
                }
                if (!empty($_POST['plataforma'])) {
                    $plataforma = $conn->real_escape_string($_POST['plataforma']);
                    $query .= " AND EXISTS (SELECT 1 FROM pro_pla 
                              JOIN plataformas ON pro_pla.id_plataforma = plataformas.id 
                              WHERE pro_pla.id = productos.id 
                              AND plataformas.nombre = '$plataforma')";
                }
                if (!empty($_POST['categoria'])) {
                    $categoria = $conn->real_escape_string($_POST['categoria']);
                    $query .= " AND EXISTS (SELECT 1 FROM pro_cat 
                                  JOIN categorias ON pro_cat.id_categoria = categorias.id 
                                  WHERE pro_cat.id = productos.id 
                                  AND categorias.nombre = '$categoria')";
                }
            }

            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                echo '<div class="S_content-item">';
                echo '<a href="producto.php?id=' . $row['id'] . '">';
                echo '<p>' . htmlspecialchars($row['nombre']) . '</p>';
                echo '<p>$' . htmlspecialchars($row['precio']) . '</p>';
                echo '</a>';
                echo '</div>';
            }

            $result->close();
            $conn->close();
        ?>
      </div>

    </main>
</table>
</html>


<?php 
// Conexión a la base de datos
require('connection.php'); 
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

?>                  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/productos_style_crud.css">
    <title>CRUD de productos</title>
    <meta charset="UTF-8">
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
    <main>
        <h1> Productos</h1>
            <?php
                echo "<form action='form_add_producto.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <input type='submit' name='submit' value='Añadir'>
                </form>"
            ?>
        <!-- FILTRE -->
        <form class="filter" method="POST">
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
            </select>
            <input name="buscar" type="text" placeholder="Buscar">
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
                if (!empty($_POST['precio'])) {
                    $precio = explode('-', $_POST['precio']);
                    $min_price = (int)$precio[0];
                    $max_price = (int)$precio[1];
                    $query .= " AND precio BETWEEN $min_price AND $max_price";
                }

                if (!empty($_POST['buscar'])) {
                    $buscar = $conn->real_escape_string($_POST['buscar']);
                    $query .= " AND (nombre LIKE '%$buscar%' OR descripcion LIKE '%$buscar%')";
                }

                if (!empty($_POST['ordenar'])) {
                    $ordenar = $conn->real_escape_string($_POST['ordenar']);
                    $query .= " ORDER BY $ordenar";
                }
                
            }

            $result = $conn->query($query);


            while ($row = $result->fetch_assoc()) {
                echo '<div class="S_content-item">';
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['nombre']) . '</td>';
                echo '<td>' . htmlspecialchars($row['descripcion']) . '</td>';
                echo '<td>' . htmlspecialchars($row['stock']) . '</td>';
                echo '<td>' . htmlspecialchars($row['precio']) . '</td>';
                echo '<td>' . htmlspecialchars($row['tipo']) . '</td>';
                echo '<td>' . htmlspecialchars($row['imagen']) . '</td>';
                echo '<td>' . htmlspecialchars($row['data_introduccio']) . '</td>';
                echo '<td>' . htmlspecialchars($row['ultima_data']) . '</td>';
                echo "<td>
                        <form action='del_producto.php' method='POST' style='display:inline-block;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' name='submit' value='Eliminar'>
                        </form>
                        <form action='form_update_productos.php' method='POST' style='display:inline-block;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' name='submit' value='Modificar'>
                        </form>
                      </td>";
                echo "</tr>";
                echo '</div>';
            }

            $result->close();
            $conn->close();
        ?>
      </div>

    </main>
</table>
</html>


<?php
    require('connection.php');
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title> Productos - Magiang </title>
    <favicon href="img/favicon.">
    <link rel="stylesheet" type="text/css" href="css/productos_style.css">
    <encode utf-8>
</head>
<body>
     <!-- ZONA NAV -->
    <header>
        <div class="header-content"><a href="index.php"><img class="icon"  src="img/logo_magiang.png"></a></div>
        <div>
            <nav>
                <ul>
                    <li><a href="productos.php">Productos</a></li>
                    <li><a href="contacto.html">Soporte</a></li>
                    <li><a href="#">Ayuda</a></li>
                    <li><a href="nosotros.html">Sobre nosotros</a></li>
                    <div class="search-bar">
                    <li ><input type="text" placeholder="Buscar">
                    <button>Buscar</button></li>
                    </div>
                </ul>
            </nav>
        
        </div>
        <div class="login">
                <a href="cesta.html"><img src="img/cesta.png"></a>
                <a href="login.html"><img src="img/login_logo.png"></a>
         </div>
        
    </header>

    

    <main>
        <h1> Productos</h1>
        <form method="post">
            <label for="tipo">Tipo:</label>
            <select name="tipo" >
                <option value="">Selecciona...</option>  
                <option value="Digital">Digital</option>
                <option value="Fisico">Fisico</option>
            </select>

            <label for="plataforma">Plataforma:</label>
            <select name="plataforma" >
                <option value="">...</option> 
                <option value="PC">PC</option>
                <option value="Nintendo">Nintendo</option>
                <option value="PS4">PS4</option>
            </select>
            <label for="precio">Precio:</label>
            <select name="precio" >
                <option value="...">...</option> 
                <option value="0-10">0-10</option>
                <option value="10-20">10-20</option>html
            </select>
            <label for="ordenar">Ordenar por</label>
            <select name="ordenar" >
                <option value="">...</option> 
                <option value="Nombre">Nombre</option>
                <option value="Precio">Precio</option>
                <option value="Valoracion">Valoracion</option>
            </select>
            <input type="button" value="Filtrar" />
            <input type="reset" value="Reset" />
      </form>

      <div class="S_content_group">
        <?php
            $query = "SELECT * FROM productos WHERE 1=1";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!empty($_POST['tipo'])) {
                    $tipo = $conn->real_escape_string($_POST['tipo']);
                    $query .= " AND tipo='$tipo'";
                }
            }

            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                echo '<div class="S_content-item">';
                echo '<a href="producto.php?id=' . $row['id'] . '">';
                echo '<img src="'. htmlspecialchars($row['imagen']) . '"alt="Producto">';
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

<!-- ZONA FOOTER-->
    <footer>
        <div>
            <img class="icon2" src="img/logo_magiang.png" alt="Imagen"> 
            <a class="footertitlelogo">Magiang</a>
        </div>
    
        <p>©2025</p>
        <p>Todos los derechos reservados. </p>
        <p>Descubre las mejores ofertas i compra al mejor precio con nuestra plataforma.</p>
        <p>Da el salto a nuevos mundos con Magiang</p>
        <p>¡Contáctanos en desde el apartado de <a href="contacto.html">Contacto</a> en nuestra web!</p>
    </footer>
</body>
</html>

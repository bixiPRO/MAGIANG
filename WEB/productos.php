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
            <input type="search" name="buscar">
            <input type="submit">
        </form>
        <?php
        if($_POST){
        $query ="SELECT * FROM productos WHERE nombre LIKE '%$buscar%' OR precio LIKE '%$buscar%' OR descripcion LIKE '%$buscar%' OR tipo LIKE '%$buscar%';";
        $result = $conn->query($query);
        while($campo = mysqi_fetch_array($result)){
            echo $campo['nombre'].'<br>';
            echo $campo['precio'].'<br>';
            echo $campo['descripcion'].'<br>';
            echo $campo['tipo'].'<br>';
        }
        }
        ?>


      <div class="S_content_group">
        <?php
            $query = "SELECT * FROM productos;";
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

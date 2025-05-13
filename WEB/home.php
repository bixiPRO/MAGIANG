<?php
    session_start();
    require('connection.php');
    if (isset($_SESSION['array_productos'])){
	    $array_prod = $_SESSION['array_productos'];
    } else {
	    $array_prod = [];
    }
?> 
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title> Inicio - Magiang </title>
    <favicon href="img/favicon.">
    <link rel="stylesheet" type="text/css" href="css/style_home.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <encode utf-8>
</head>
<body>
     
    <!-- ZONA NAV -->
    <header>
    <div class="header-content"><a href="home.php"><img class="icon"  src="img/logo_magiang.png"></a></div>
        <div>
            <nav>
                <ul>
                    <li><a href="productos.php">Productos</a></li>
                    <li><a href="contacto.html">Soporte</a></li>
                    <li><a href="sede.html">Sede</a></li>
                    <li><a href="nosotros.html">Sobre nosotros</a></li>
                </ul>
                </nav>
        
        </div>
        <div class="login">
                <a href="cesta.php"><img src="img/cesta.png"></a>
                <a href="login.php"><img src="img/login_logo.png"></a>
         </div>
        
    </header>
    <main>

        <!-- Zona  de contenido pagina home -->
        <div class="oferta-home">
            <!-- Apartado Ofertas-->
            <div><h3> Ofertas </h3></div>
            <div><img  src="/img/banner_home.png"></div>
            <div> <a class="boton-sm" href="ofertas.html">Saber mas</a></div>
        </div>
        <div>
            <!--Zona dels productes que se han modificado-->
            <div><h3> Ultima Modificacion</h3></div>
            <div class="L_content_group">
                <!--PHP funcion mostrar productos de ultima Modificación-->
                <?php
                    $query = "SELECT * FROM productos ORDER BY ultima_data DESC LIMIT 9;";
                    $registros = $conn->query($query);
                    while ($fila = $registros->fetch_assoc()){
                        echo '<div class="L_content-item">';
                        echo '<a href="producto.php?id=' . $fila['id'] . '">';
                        echo '<p><img src="'. htmlspecialchars($fila['imagen']) . '">';
                        echo "Producto: ".$fila['nombre'];
                        echo '</a></p>';
                        echo '</div>';
                    }                    
                    $registros->close();
                ?>
            </div>
        </div>
        
        <div>
            <!--Zona Lanzamientos-->
            <div><h3> Lanzamientos</h3></div>
            <div>
            <div class="L_content_group">
                <!--PHP funcion mostrar productos introducidos recientemente-->
                <?php
                    $query = "SELECT * FROM productos ORDER BY data_introduccio DESC LIMIT 9;";
                    $registros = $conn->query($query);
                    while ($fila = $registros->fetch_assoc()){
                        echo '<div class="L_content-item">';
                        echo '<a href="producto.php?id=' . $fila['id'] . '">';
                        echo '<p><img src="'. htmlspecialchars($fila['imagen']) . '">';
                        echo "Producto: ".$fila['nombre'];
                        echo '</a></p>';
                        echo '</div>';
                    }                    
                    $registros->close();
                    $conn->close();
                ?>
            </div>
            </div> 
        </div>
    </main>
        <!-- Zona FOOTER-->
    <footer>
        <div class="footer-content">
            <img class="icon2" src="img/logo_magiang.png" alt="Logo Magiang">
            <p><strong>Magiang</strong></p>
        </div>
        <p>©2025 - Todos los derechos reservados.</p>
        <p>Descubre las mejores ofertas y compra al mejor precio con nuestra plataforma.</p>
        <p>Da el salto a nuevos mundos con Magiang.</p>
        <p>¡Contáctanos en el apartado de <a href="contacto.html">Contacto</a>!</p>
    </footer>

    
</body>
</html>
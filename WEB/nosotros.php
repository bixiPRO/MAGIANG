<?php
    session_start();
    require('connection.php');
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title> Sobre Nosotros - Magiang </title>
    <link rel="icon" type="image/jpg" href="img/favicon_magiang.png"/>
    <link rel="stylesheet" type="text/css" href="css/style_nosotros.css">
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
                    <li><a href="contacto.php">Soporte</a></li>
                    <li><a href="sede.php">Sede</a></li>
                    <li><a href="nosotros.php">Sobre nosotros</a></li>
                </ul>
            </nav>
        
        </div>
        <div class="login">
            <a href="cesta.php"><img src="img/cesta.png"></a>

            <?php if (isset($_SESSION['nombre_usuario'])): ?>
                <a class="bienvenida" href="modificar_usuario.php"><?= htmlspecialchars($_SESSION['nombre_usuario']) ?></a>
                <a href="logout.php"><img src="img/logout.png"></a>
            <?php else: ?>
                <a href="login.php"><img src="img/login_logo.png" alt="Login"></a>
            <?php endif; ?>
        </div>
        
    </header>
    <main>
        <h1>Sobre nosotros</h1>
        <div class="texto-nosotros">
            <h3>¿Que es Magiang?</h3>
            <ul>
                <p>Magiang es una plataforma de venta de productos de tecnología y videojuegos. Nuestro objetivo es ofrecer a nuestros clientes
                la mejor experiencia de compra posible, con una amplia gama de productos. </p>
            </ul>
            <br>
            
            <h3>¿Cual es el origen del nombre de Magiang?</h3>
            <ul><p>El nombre de Magiang viene del los nombres de los fundadores:</p>
                <ul>
                    <li><p>Ma: [Ma]rc</p></li>
                    <li><p>gi: Ser[gi]</p></li>
                    <li><p>iang: Bix[iang]</p></li>
                </ul>
            </ul>
        </div>

        
        <div class="texto-nosotros">
            <h3>¿Por qué elegir Magiang?</h3>
            <ul><p>En Magiang, creemos que la tecnología y los videojuegos pueden mejorar la vida de las personas y queremos que este al alcance de todos, por eso queremos ayudar a nuestros clientes a encontrar los productos que mejor se adapten a sus necesidades.</p></ul>
        
        </div>

        <div>
            <h3>¿Qué nos diferencia?</h3>
            <ul>
                <p>Nuestro equipo está formado por expertos en tecnología y videojuegos que están siempre dispuestos a ayudar a nuestros clientes a encontrar los productos que buscan. </p> 
                <p>Nuestro equipo esta formado por:</p>
            </ul>  
        </div>
            <div class="T_content_group">
            <div class="T_content-item">          
                <p><a href="https://github.com/bixiPRO"><img src="img/BixiPro_github.jpg">Bixiang Zhu</a></p>                            
            </div>
            <div class="T_content-item">          
                <p><a href="https://github.com/marcbailo"><img src="img/Marc_github.png">Marc Bailo</a></p>                            
            </div>
            <div class="T_content-item">          
                <p><a href="https://github.com/sergigallardo"><img src="img/sgallardo_github.jpg">Sergi Gallardo</a></p>                            
            </div>
        </div>
        
        <h4>En Magiang, nos esforzamos por ofrecer a nuestros clientes la mejor experiencia de compra posible, con un
            servicio de atención al cliente excepcional y una amplia gama de productos de las mejores marcas. ¡Descubre las mejores ofertas y compra al mejor precio! </h4> 

        <!-- Zona  de contenido pagina contacto -->
       
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
        <p>¡Contáctanos en el apartado de <a href="contacto.php">Contacto</a>!</p>
    </footer>

    
</body>
</html>
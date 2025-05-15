<?php
    session_start();
    require('connection.php');
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title> Soporte - Magiang </title>
    <link rel="icon" type="image/jpg" href="img/favicon_magiang.png"/>
    <link rel="stylesheet" type="text/css" href="css/style_contacto.css">
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

    <!--ZONA FORMULARIO CONTACTO-->
    

    <main>
        <h1> Soporte Magiang</h1>
        <div class="contacta-txt">
            <h3>¿Necessitas ayuda?</h3>
            <p>Cuentanos que problema te ha surgido, esperamos poder ayudar-te</p>
        </div>
            <div class="S_content_group">
                <div class="S_content-item">          
                    <p><a href="contacto_pyp.php"><img src="img/icon P_P.png">Pedidos/Productos</a></p>                            
                </div>
                <div class="S_content-item">          
                    <p><a href="contacto_pago.php"><img src="img/icon_pay.png">Pagos</a></p>                            
                </div>
                <div class="S_content-item">          
                    <p><a href="contacto_cys.php"><img src="img/icon_security.png">Cuenta/Seguridad</a></p>                            
                </div>
            </div>
        </div>
        <h4>¿No has encontrado la solucion? Contactanos - soporte.magiang@gmail.com</h4>
    
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
        <p>¡Contáctanos en desde el apartado de <a href="contacto.php">Contacto</a> en nuestra web!</p>
    </footer>
</body>
</html>

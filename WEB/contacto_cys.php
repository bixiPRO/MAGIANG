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
                    <li><a href="contacto.html">Soporte</a></li>
                    <li><a href="sede.html">Sede</a></li>
                    <li><a href="nosotros.html">Sobre nosotros</a></li>
                </ul>
                </nav>
        
        </div>
        <div class="login">
            <a href="cesta.php"><img src="img/cesta.png"></a>

            <?php if (isset($_SESSION['nombre_usuario'])): ?>
                <span class="bienvenida"><?= htmlspecialchars($_SESSION['nombre_usuario']) ?></span>
                <a href="logout.php"><img src="img/logout.png"></a>
            <?php else: ?>
                <a href="login.php"><img src="img/login_logo.png" alt="Login"></a>
            <?php endif; ?>
        </div>
        
    </header>

    <!--ZONA FORMULARIO CONTACTO-->
    

    <main>
        <h1> <a href="contacto.html">Soporte Magiang</a>>Cuenta/Seguridad</h1>
        <div class="contacta-txt">
            <h3>Cuenta y seguridad</h3>
            <p>¿Problemas con tu cuenta?</p>
            <p>¿Necesitas ayuda con la seguridad de tu cuenta?</p>
            <p>Hecha un vistazo a nuestros posts:</p>
            <ul>
                <ul>
                <div class="faq-content">
                    <section class="faq-item">
                        <h3>¿Cómo puedo cambiar mi contraseña?</h3>
                        <p>Ve a la configuración de tu cuenta y selecciona “Cambiar contraseña”.</p>
                    </section>

                    <section class="faq-item">
                        <h3>¿Me he olvidado mi contraseña?</h3>
                        <p>Haz clic en “¿Olvidaste tu contraseña?” en la página de inicio de sesión y sigue los pasos.</p>
                    </section>

                    <section class="faq-item">
                        <h3>¿Me han robado la cuenta?</h3>
                        <p>Contacta de inmediato con soporte: soporte.magiang@gmail.com para recuperar el acceso.</p>
                    </section>

                    <section class="faq-item">
                        <h3>¿Cómo puedo aumentar la seguridad de mi cuenta?</h3>
                        <p>Usa una contraseña fuerte, no la compartas, y activa la verificación en dos pasos si está disponible.</p>
                    </section>
                </div>      
            </ul>
            </ul>
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
        <p>¡Contáctanos en desde el apartado de <a href="contacto.html">Contacto</a> en nuestra web!</p>
    </footer>
</body>
</html>

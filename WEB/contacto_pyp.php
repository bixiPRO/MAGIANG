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
        <h1> <a href="contacto.html">Soporte Magiang</a>>Pedidos/Productos</h1>
        <div class="contacta-txt">
            <h3>Pedidos y Productos</h3>
            <p>¿No has recibido tu pedido?</p>
            <p>Hecha un vistazo a nuestra FAQ:</p>
            <ul>
                <div class="faq-content">
                    <section class="faq-item">
                        <h3>¿Cómo puedo hacer un seguimiento de mi pedido?</h3>
                        <p>Puedes hacer seguimiento desde tu cuenta en la sección <strong>"Mis pedidos"</strong>. También recibirás un correo electrónico con el número de seguimiento una vez que tu pedido haya sido enviado.</p>
                    </section>

                    <section class="faq-item">
                        <h3>¿Cuánto tardará en llegar mi pedido?</h3>
                        <p>El tiempo de entrega depende de tu ubicación. Generalmente, los pedidos se entregan en un plazo de <strong>3 a 7 días hábiles</strong>. Si hay demoras, te notificaremos por correo.</p>
                    </section>

                    <section class="faq-item">
                        <h3>¿Cómo puedo devolver un producto?</h3>
                        <p>Para devolver un producto, contáctanos en <strong>soporte.magiang@gmail.com</strong> dentro de los <strong>14 días</strong> posteriores a la recepción del pedido. Te enviaremos las instrucciones necesarias para completar el proceso.</p>
                    </section>

                    <section class="faq-item">
                        <h3>¿Cómo puedo cancelar un pedido?</h3>
                        <p>Puedes cancelar tu pedido siempre que aún no haya sido procesado o enviado. Escríbenos cuanto antes indicando tu número de pedido para gestionar la cancelación.</p>
                    </section>
                </div>      
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

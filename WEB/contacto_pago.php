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
                <span class="bienvenida"><?= htmlspecialchars($_SESSION['nombre_usuario']) ?></span>
                <a href="logout.php"><img src="img/logout.png"></a>
            <?php else: ?>
                <a href="login.php"><img src="img/login_logo.png" alt="Login"></a>
            <?php endif; ?>
        </div>
        
    </header>

    <!--ZONA FORMULARIO CONTACTO-->
    

    <main>
        <h1><a href="contacto.php">Soporte Magiang</a>>Pagos</h1>
        <div class="contacta-txt">
            <h3>Pagos</h3>
            <p>¿No sabes que opciones de pago tenemos?¿Tienes problemas con tu pago?</p>
            <p>En esta seccion te ayudaremos a resolver tus dudas sobre los pagos en Magiang.</p>
            <p>Hecha un vistazo a estos posts:</p>
           <ul>
                <div class="faq-content">
                    <section class="faq-item">
                        <h3>¿Qué tipos de pagos están permitidos?</h3>
                        <p>Aceptamos <strong>tarjetas de crédito/débito (Visa, Mastercard, Amex), PayPal y Bizum</strong>. Elige tu método preferido al finalizar la compra.</p>
                    </section>

                    <section class="faq-item">
                        <h3>¿Cómo puedo aplicar un cupón de descuento?</h3>
                        <p>En el carrito de compra, introduce el código en el campo <strong>“Cupón de descuento”</strong> y haz clic en aplicar.</p>
                    </section>

                    <section class="faq-item">
                        <h3>¿Cuánto tarda un reembolso?</h3>
                        <p>Los reembolsos se procesan entre <strong>5 y 10 días</strong> hábiles desde su aprobación. Esto depende de tu banco o método de pago usado.</p>
                    </section>

                    <section class="faq-item">
                        <h3>¿Se puede pagar al recibir el producto?</h3>
                        <p>No, por el momento solo aceptamos <strong>pagos online</strong>. No está habilitado el pago contra reembolso.</p>
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
        <p>¡Contáctanos en desde el apartado de <a href="contacto.php">Contacto</a> en nuestra web!</p>
    </footer>
</body>
</html>

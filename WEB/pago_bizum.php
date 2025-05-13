<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PAGO BIZUM</title>
    <link rel="stylesheet" type="text/css" href="css/pago-styles.css">
</head>
<body>
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
        <h2> <a>PAGO BIZUM</a></h2>
        <form method="POST">
            
            <label>Pon tu numero de telefono:</label>
            <input type="number" id="telefono" name="telefono" required><br><br>
            <a class="boton-pay" href="mail.php">Pagar</a>
        </form>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </main>
    
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
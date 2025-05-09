<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title> Pago - Magiang </title>
    <favicon href="img/favicon.">
    <link rel="stylesheet" type="text/css" href="css/pago-styles.css">
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

    <!--ZONA FORMULARIO PAGO-->


    <main>
        <h2> <a>Datos de pedido:</a></h2>
        <form action="seleccion_pago.php" method="post">
            <h3>Datos de Facturación:</h3>
            
            <label>Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>
                
            <label>Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required><br><br>
            
            <label>Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required><br><br>

            <label>País:</label>
            <input type="text" id="pais" name="pais" required><br><br>

            <label>Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" required><br><br>

            <label>Codigo postal:</label>
            <input type="number" id="codigo_postal" name="codigo_postal" required><br><br>
                
            <label>Dirección:</label>
            <input type="text" id="direccion" name="direccion" required><br><br>
                
            <label>Piso, puerta u otro:</label>
            <input type="text" id="puerta" name="puerta" required><br><br>
            
            <a class="boton-pay" href="capcha.php">Continuar con el pago</a>
        </form>
    
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

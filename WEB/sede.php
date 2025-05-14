<?php
    session_start();
    require('connection.php');
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title> Sede - Magiang </title>
    <link rel="icon" type="image/jpg" href="img/favicon_magiang.png"/>
    <link rel="stylesheet" type="text/css" href="css/sede.css">
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


    <main>
        <div>
            <h1>¿Donde se ubica Magiang?</h1>
            <h2>Origen</h2>
            <ul><p>Magiang se origina en un instituto de Cataluña cerca del rio Besós llamado "Instituto Manuel Vazquez Montalban". Magiang fue creada por unos estudiantes de FP de dicho instituto, asi mismo estableciendo el instituto como su sede principal.</p></ul>
        </div>
        <div>
            <h2>Ubicacion</h2>
            <ul>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2991.7218185522024!2d2.226076212206068!3d41.42355697117541!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4a355e0fe9851%3A0x28d72ff627b25f0d!2sIES%20Manuel%20V%C3%A1zquez%20Montalb%C3%A1n!5e0!3m2!1sca!2ses!4v1746718464241!5m2!1sca!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p><a>Dirección:</a> Av. d'Eduard Maristany, 59, 08930 Sant Adrià de Besòs, Barcelona</p>
                <p><a>Teléfono:</a> 933 81 90 05</p>
            </ul>
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

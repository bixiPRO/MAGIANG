<?php
session_start();
require('connection.php');

// Funcion para anadir prodictos a la cesta
function agregar($producto_id) {
    if(isset($_SESSION['carrito'][$producto_id])) {
        // Si el producto ya esta en la cesta pos aumentar la cantidad
        $_SESSION['carrito'][$producto_id]['cantidad']++;
    } else {
        // Si el producto no está en el carrito entonces agregar con cantidad 1
        $_SESSION['carrito'][$producto_id] = [
            'cantidad' => 1  // Cantidad inicial es 1
        ];
    }
}

// Función para eliminar los productos
function eliminar($producto_id) {
    if(isset($_SESSION['carrito'][$producto_id])) {
        unset($_SESSION['carrito'][$producto_id]);
    }
}

// Función para obtener los productos en la cesta
function getCarrito() {
    global $conn;
    $carrito_productos = [];

    if(isset($_SESSION['carrito'])) {
        $id_productos = array_keys($_SESSION['carrito']);
        $ids = implode(",", $id_productos);
        
        $query = "SELECT * FROM productos WHERE id IN ($ids)";
        $result = $conn->query($query);
        
        while($row = $result->fetch_assoc()) {
            $carrito_productos[] = $row;
        }
    }

    return $carrito_productos;
}


?>
<!DOCTYPE html>
<head>
    <title> Mi Cesta - Magiang </title>
    <favicon href="img/favicon.">
    <link rel="stylesheet" type="text/css" href="css/cesta-styles.css">
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
                    <li><a href="#">Sede</a></li>
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
                <a href="login.php"><img src="img/login_logo.png"></a>
         </div>
        
    </header>
    

    <main>
        <h1> <a>Mi Cesta</a></h1>
        <div class="contacta-txt">
            <ul>
                <?php 
                
                ?>
            </ul>
        </div>
        <div> 
            <?php ?>
            <a class="boton-pay" href="datos_pago.html">Pagar</a>
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

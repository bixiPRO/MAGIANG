<?php
session_start();
require('connection.php');

// Para extrer datos de POST del formulario (cantidad)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['anadir'])) {
    $id = intval($_POST['id']);
    $cantidad = intval($_POST['cantidad']);
    agregar($id, $cantidad);
}

// Funcion para anadir prodictos a la cesta
function agregar($producto_id, $cantidad = 1) {
    if(isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]['cantidad']+= $cantidad;
    } else {
        $_SESSION['carrito'][$producto_id] = [
            'cantidad' => $cantidad
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

// Agregar producto a la cesta si clica el boton anadir
if(isset($_GET['accion']) && $_GET['accion'] == 'anadir' && isset($_GET['id'])) {
    $id_productos = intval($_GET['id']);
    agregar($id_productos);
}

// Eliminar producto de la cesta si clica boton eliminar
if(isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id'])) {
    $id_productos = intval($_GET['id']);
    eliminar($id_productos);
}

// Obtener los productos en la cesta
$carrito_productos = getCarrito();
$precio_total = 0;
foreach($carrito_productos as $productos) {
    $id_productos = $productos['id'];
    $precio = $productos['precio'];
    $cantidad = $_SESSION['carrito'][$id_productos]['cantidad'];
    $precio_total += $precio * $cantidad;
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
                <a href="cesta.php"><img src="img/cesta.png"></a>
                <a href="login.php"><img src="img/login_logo.png"></a>
         </div>
        
    </header>
    

    <main>
        <h1> <a>Mi Cesta</a></h1>
        <!-- Mostrar productos en la cesta -->
        <div class="contacta-txt">
            <?php if(count($carrito_productos) > 0): ?>
                <ul>
                    <?php foreach($carrito_productos as $productos): ?>
                        <li>
                            <a href="contacto_pyp.html"><?= htmlspecialchars($productos['nombre']) ?></a>
                            - <?= number_format($productos['precio'], 2) ?>€ 
                            - Cantidad: <?= $_SESSION['carrito'][$productos['id']]['cantidad'] ?>
                            <a href="cesta.php?accion=eliminar&id=<?= $productos['id'] ?>">Eliminar</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No hay productos en tu cesta.</p>
            <?php endif; ?>
        </div>
        <div> 
            <?php echo "<strong><h2>Total a pagar: " . number_format($precio_total, 2) . "€</h2></strong>"; ?>
            <a class="boton-pay" href="pago.php">Pagar</a>
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

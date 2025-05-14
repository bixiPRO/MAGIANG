<?php
require('connection.php');

// Obtener id del producto desde la pagina de productos
$producto_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Variables per posar consultes posteriorment 
$producto = [];
$plataformas = [];
$codigo_digital = '';
$stock = 0;

if($producto_id > 0) {
    // Consulta del producte assegurant que tingui la mateixa id
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
        
        // Obtenir la plataforma en que esta
        $stmt_plat = $conn->prepare("
            SELECT p.nombre 
            FROM pro_pla pp
            JOIN plataformas p ON pp.id_plataforma = p.id
            WHERE pp.id = ?
        ");
        $stmt_plat->bind_param("i", $producto_id);
        $stmt_plat->execute();
        $result_plat = $stmt_plat->get_result();
        
        while($row = $result_plat->fetch_assoc()) {
            $plataformas[] = $row['nombre'];
        }
        
        // Si es digital, obtenir el codi 
        if($producto['tipo'] === 'DIGITAL') {
            $stmt_dig = $conn->prepare("SELECT codigo FROM digital WHERE id_producto = ?");
            $stmt_dig->bind_param("i", $producto_id);
            $stmt_dig->execute();
            $result_dig = $stmt_dig->get_result();
            
            if($result_dig->num_rows > 0) {
                $codigo_digital = $result_dig->fetch_assoc()['codigo'];
            }
        }
        // Obtenir el stock del producte per mostrar el usuari
        $stmt_stock = $conn->prepare("SELECT stock FROM productos WHERE id = ?");
        $stmt_stock->bind_param("i", $producto_id);
        $stmt_stock->execute();
        $result_stock = $stmt_stock->get_result();
        
        if ($result_stock->num_rows > 0) {
            $stock = $result_stock->fetch_assoc()['stock'];
        }

    }
    $conn->close();
}

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($producto['nombre'] ?? 'Producto') ?> - Magiang </title>
    <link rel="icon" type="image/jpg" href="img/favicon_magiang.png"/>
    <link rel="stylesheet" type="text/css" href="css/productostyle.css">
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
    <main>
<!-- PHP per el maneig del producte, posar el nom del producte-->
    <?php if(!empty($producto)): ?>
            <h2><a href="productos.php">Productos</a> &gt; <?= htmlspecialchars($producto['nombre']) ?></h2>
            <div>
    <!--posar el nom i el preu per mostrar a l'usuari-->
                    <div class="prod_info">
                    <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                        <h2><?= htmlspecialchars($producto['nombre']) ?></h2>
                        <hr>
                        <h3>Precio: <?= number_format($producto['precio'], 2) ?>€</h3>
    <!--Posar la plataforma en que esta-->
                        <?php if(!empty($plataformas)): ?>
                            <p>Plataformas: <?= implode(', ', $plataformas) ?></p>
                        <?php endif; ?>
                        <!--Mostrar el usuari en cas de producte es fisic que el enviament sigui disponible i si el producte es digital que el codi estigui incluit en el gmail-->
                        <?php if($producto['tipo'] === 'DIGITAL'): ?>
                            <p class="digital-tag">Producto Digital - Código disponible (correo electronico) </p>
                        <?php else: ?>
                            <p class="fisico-tag">Producto Físico - Envío disponible</p>
                        <?php endif; ?>
                        <!--Poner la descripción del producto-->
                        <h2>Descripción:</h2>
                        <hr>
                        <p><?= htmlspecialchars($producto['descripcion']) ?></p>
                        <hr>
                        <p><strong>Stock: </strong><?= htmlspecialchars($producto['stock']) ?></p>
                        
                        <!-- Mostrar el codi en cas que sigui digital (prova) -->
                        <?php if(!empty($codigo_digital)): ?>
                            <div class="codigo-digital">
                                <strong>Código:</strong> <?= htmlspecialchars($codigo_digital) ?>
                            </div>
                        <?php endif; ?>

                        <!-- Formulario para seleccionar la cantidad -->
                        <form action="cesta.php" method="post">
                            <input type="hidden" name="id" value="<?= $producto_id ?>">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" id="cantidad" name="cantidad" min="1" max="<?= $stock ?>" value="1">
                            <br>
                            <br>
                            <br>
                            <input type="submit" name="anadir" value="Añadir a la cesta">
                        </form>
                    </div>
                
            </div>
            <!-- Sino cumpleix la primera condició posar un else perque no s'ha trobat el producte-->
        <?php else: ?>
            <div class="error">
                <h2>Producto no encontrado</h2>
                <p>El producto solicitado no existe o ha sido eliminado.</p>
            </div>
        <?php endif; ?>
        
        
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
        <p>¡Contáctanos en el apartado de <a href="contacto.html">Contacto</a>!</p>
    </footer>

    
</body>
</html>
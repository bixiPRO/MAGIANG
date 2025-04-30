<?php
require('connection.php');

// Obtener id del producto desde la pagina de productos
$producto_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Variables per posar consultes posteriorment 
$producto = [];
$plataformas = [];
$codigo_digital = '';

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
    }
    $conn->close();
}

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($producto['nombre'] ?? 'Producto') ?> - Magiang </title>
    <favicon href="img/favicon.">
    <link rel="stylesheet" type="text/css" href="css/productostyle.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <encode utf-8>
</head>
<body>
    
    <!-- ZONA NAV -->
    <header>
        <div class="header-content"><a href="index.php"><img class="icon"  src="img/logo_magiang.png"></a></div>
        <div>
            <nav>
                <ul>
                    <li><a href="productos.html">Productos</a></li>
                    <li><a href="contacto.html">Soporte</a></li>
                    <li><a href="#">Ayuda</a></li>
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
                <a href="login.html"><img src="img/login_logo.png"></a>
        </div>
        
    </header>
    <main>
<!-- PHP per el maneig del producte, posar el nom del producte-->
    <?php if(!empty($producto)): ?>
            <h2><a href="productos.php">Productos</a> &gt; <?= htmlspecialchars($producto['nombre']) ?></h2>
            <div>
                <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                <div class="sub_img">
                    <!-- Imatges per el producte per mostrar el client -->
                    <img src="<?= htmlspecialchars($producto['imagen']) ?>">
                    
                </div>
            </div>
            <!-- Sino cumpleix la primera condició posar un else perque no s'ha trobat el producte (un error)-->
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
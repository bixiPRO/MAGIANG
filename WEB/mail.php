<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

require 'connection.php';
session_start();

$id_pedido = isset($_GET['id_pedido']) ? intval($_GET['id_pedido']) : 0;

$id_cliente = $_SESSION['id_cliente'];

// Datos del cliente y pedido
$sql = "SELECT p.*, c.nombre_usuario, c.email 
        FROM pedidos p
        JOIN clientes c ON p.id_cliente = c.id
        WHERE p.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_pedido);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Pedido no encontrado.");
}
$pedido = $result->fetch_assoc();

// Variables del pedido
$nombre = htmlspecialchars($pedido['nombre']);
$apellidos = htmlspecialchars($pedido['apellidos']);
$telefono = $pedido['telefono'];
$email = $pedido['email'];
$direccion = htmlspecialchars($pedido['direccion'] . ', ' . $pedido['piso_puerta_otro'] . ', ' . $pedido['codigo_postal'] . ', ' . $pedido['ciudad'] . ', ' . $pedido['pais']);
$usuario = htmlspecialchars($pedido['nombre_usuario']);

// Productos del carrito de ese cliente
$sqlProd = "SELECT pr.nombre, pr.descripcion, pr.precio, c.cantidad
            FROM carrito c
            JOIN productos pr ON pr.id = c.id_producto
            WHERE c.id_cliente = ?";
$stmtProd = $conn->prepare($sqlProd);
$stmtProd->bind_param("i", $pedido['id_cliente']);
$stmtProd->execute();
$resProd = $stmtProd->get_result();

$lista_productos = "";
$total = 0;

while ($row = $resProd->fetch_assoc()) {
    $nombreProd = htmlspecialchars($row['nombre']);
    $descripcion = htmlspecialchars($row['descripcion']);
    $precio = floatval($row['precio']);
    $cantidad = intval($row['cantidad']);
    $subtotal = $precio * $cantidad;
    $total += $subtotal;

    $lista_productos .= "
        <table style='width: 100%; border-collapse: collapse;'>
            <thead>
                <tr>
                    <th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>Producto</th>
                    <th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>Descipcion</th>
                    <th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>Precio</th>
                    <th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>Cantidad</th>
                    <th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style='border: 1px solid #ddd; padding: 8px;'>$nombreProd</td>
                    <td style='border: 1px solid #ddd; padding: 8px;'>$descripcion</td>
                    <td style='border: 1px solid #ddd; padding: 8px;'>$precio €</td>
                    <td style='border: 1px solid #ddd; padding: 8px;'>$cantidad</td>
                    <td style='border: 1px solid #ddd; padding: 8px;'>" . number_format($subtotal, 2) . "€</td>
                </tr>
            </tbody>
        </table>
    ";
}


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'soporte.magiang@gmail.com';                     //SMTP username
    $mail->Password   = 'kkyy ojhu xlaj alup';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('soporte.magiang@gmail.com', 'MAGIANG');
    $mail->addAddress($email, $usuario);     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'PEDIDO - MAGIANG';
    $mail->Body    = "
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Mail Message | Magiang</title>
            <style>
                body {
                    background-color: #f4f4f4;
                    font-family: Arial, sans-serif;
                }
                h1 {
                    color: #333;
                    text-align: center;
                }
                p {
                    color: #555;
                    font-size: 16px;
                }
            </style>
        </head>
        <body>
            <main>
                <h1 class='title'>Magiang Shopping</h1>
                <h1>¡Gracias!</h1>
                <h2>Su compra se ha realizado correctamente</h2>
                <h3>Su pedido es el siguiente:</h3>
                <hr>
                <div class='order-details'>
                    <p><strong>Nombre completo:</strong> $nombre $apellidos</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Teléfono:</strong> $telefono</p>
                    <p><strong>Dirección:</strong> $direccion</p>

                    <h2>Productos comprados:</h2>
                    <ul>$lista_productos</ul>
                    <p><strong>Total:</strong> " . number_format($total, 2) . " €</p>
                    <hr>
                    <p>Gracias por confiar en nosotros, esperamos que vuelva a solicitar nuestros servicios.</p>
                    <p>¿Hay algo mal? No dude en contactarnos: <a class='mail' href='mailto:soporte.magiang@gmail.com'>soporte.magiang@gmail.com</a></p>
                </div>
            </main>
        </body>
    </html>";

    $mail->send();


    if (!empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $producto_id => $item) {
            $cantidad = $item['cantidad'];
    
            // Obtener precio actual
            $stmt = $conn->prepare("DELETE FROM carrito WHERE id_cliente = ?");
            $stmt->bind_param("i", $id_cliente);
            $stmt->execute();
            $stmt->close();
        }
    }
    
    header("Location: home.php");
    exit();

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

<html>
<head>
<title>INICIAR SECCION</title>
</head>
<body>
<?php
session_start();
require('connection.php');

$email = $_POST['gmail'];
$password1 = $_POST['pwd'];

$stmt = $conn->prepare('SELECT contrasenya FROM clientes WHERE email = ?;');
$stmt->bind_param("s",$email);
$stmt->execute();
$resultado = $stmt->get_result();
$fila = $resultado->fetch_assoc();


$stmt->close();
$conn->close();

echo "Registro creado"
?>
</body>
</html>
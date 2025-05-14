<html>
<head>
<title>INICIAR SECCION</title>
</head>
<body>
<?php
session_start();
require('connection.php');

// Validar que los datos vengan por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['gmail'] ?? '';
    $password1 = $_POST['pwd'] ?? '';

    // Verificar que no estén vacíos
    if (empty($email) || empty($password1)) {
        $_SESSION['error_login'] = "Campos obligatorios.";
        header("Location: login.php");
        exit();
    }

$stmt = $conn->prepare('SELECT id, contrasenya FROM clientes WHERE email = ?;');
$stmt->bind_param("s",$email);
$stmt->execute();
$resultado = $stmt->get_result();
$fila = $resultado->fetch_assoc();

if ($fila && password_verify($password1,$fila['contrasenya'])){
	echo "login correcto";
	$_SESSION['gmail']=$email;
	$_SESSION['id_cliente'] = $fila['id'];
	header("Location: home.php");
	exit();

}else {
	echo "login incorrecto";
	header("Location: login.php");
	exit();
}

echo $_SESSION['nombre_usuario'];


$stmt->close();
$conn->close();
}else {
    header("Location: login.php");
    exit();
}
?>
</body>
</html>
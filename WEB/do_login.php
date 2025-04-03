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

if (password_verify($password1,$fila['contrasenya'])){
	echo "login correcto";
	$_SESSION['gmail']=$email;

}else {
	echo "login incorrecto";
}

echo $_SESSION['nombre_usuario'];


$stmt->close();
$conn->close();
header("Location: index.php");
?>
</body>
</html>
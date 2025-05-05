<html>
<head>
<title>REGISTRO</title>
</head>
<body>
<?php
session_start();
require('connection.php');

$email = $_POST['gmail'];
$password1 = $_POST['pwd1'];
$password2 = $_POST['pwd2'];

if ($password1 !== $password2) {
    header("Location: home.php");
    exit();
}

if (strlen($password1) < 6) {
    header("Location: home.php");
    exit();
}

$stmt = $conn->prepare("SELECT id FROM clientes WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: home.php");
    exit();
}

$username = explode('@', $email)[0];
$username = preg_replace('/[^a-zA-Z0-9]/', '', $username);

$hash = password_hash($password1,PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO clientes (email, nombre_usuario, contrasenya) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $username, $hash);
$stmt->execute();

  
$stmt->close();
$conn->close();

echo "Registro creado"
?>

<a href='login.php'>inicia seccion ahora</a>
</body>
</html>
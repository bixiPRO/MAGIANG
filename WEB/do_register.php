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
    header("Location: login.php");
    exit();
}

if (strlen($password1) < 6) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->prepare("SELECT id FROM clientes WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: login.php");
    exit();
}

$username = explode('@', $email)[0];
$username = preg_replace('/[^a-zA-Z0-9]/', '', $username);


$stmt = $conn->prepare("INSERT INTO clientes (email, nombre_usuario, contrasenya) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $username, $password2);
$stmt->execute();

  
$stmt->close();
$conn->close();


?>

<a href='index.php'>ir a home</a>
</body>
</html>
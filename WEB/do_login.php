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

  
$stmt->close();
$conn->close();

echo "Registro creado"
?>
</body>
</html>
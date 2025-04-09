<?php
$servername = "localhost";
$username = "root";
$dbname = "MAGIANG";
$password = "12";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>


<?php
session_start();

require('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $formato = $_POST['formato'];
    $accion = $_POST['accion'];
}

?>
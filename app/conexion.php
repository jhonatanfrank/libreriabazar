<?php
$host = "localhost";
$user = "root";
$pass = "123456";
$db = "libreriagigis";

$conexion = new mysqli($host, $user, $pass, $db);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} 
?>
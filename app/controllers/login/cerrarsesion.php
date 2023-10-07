<?php
include('../../conexion.php');
include('../../url.php');
session_start();
if (isset($_SESSION['sesion_email'])) {
    session_destroy();
    header("location: " . $URL . "/login");
}
?>
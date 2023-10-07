<?php
session_start();
if (isset($_SESSION['sesion_email'])) {
    //$codigo = "Si existe sesion de " . $_SESSION['sesion_email'];
    $email_sesion = $_SESSION['sesion_email'];
    $nombres_sesion = $_SESSION['sesion_nombres'];
    $apellidos_sesion = $_SESSION['sesion_apellidos'];
} else {
    header('location: ' . $URL . '/login');
}
?>
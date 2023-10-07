<?php
include('../../conexion.php');
include('../../url.php');
include('../../sesion.php');

if (isset($_POST['btnlogin'])) {
  $correoelectronico = $_POST['correoelectronico'];
  $contrasenia = $_POST['contrasenia'];

  $query = "SELECT * FROM usuarios WHERE correoelectronico = '$correoelectronico'";
  $users = mysqli_query($conexion, $query);

  $contador = 0;
  foreach ($users as $key => $user) {
    $contador = $contador + 1;
    $correoelectronico_bucle = $user['correoelectronico'];
    $contrasenia_bucle = $user['contrasenia'];
    $nombres_bucle = $user['nombres'];
    $apellidos_bucle = $user['apellidos'];
  }

  if (($contador > 0) && ($contrasenia_bucle == $contrasenia)) {
    //echo "datos correctos";
    session_start();
    $_SESSION['sesion_email'] = $correoelectronico_bucle;
    $_SESSION['sesion_nombres'] = $nombres_bucle;
    $_SESSION['sesion_apellidos'] = $apellidos_bucle;
    header("location: " . $URL . "/");
  } else {
    //echo "datos incorrectos";
    header("location: " . $URL . "/login/index.php");

  }

}
?>
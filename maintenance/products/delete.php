<?php include('../../app/conexion.php') ?>
<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM producto WHERE id = $id";
    $result = mysqli_query($conexion, $query);
    if (!$result) {
        die("Query failed");
    }
    header("Location: index.php");

}

?>
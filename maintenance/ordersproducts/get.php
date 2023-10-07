<?php include('../../app/conexion.php'); ?>
<?php include('../../app/url.php'); ?>
<?php include('../../app/sesion.php'); ?>
<?php include('../../app/layouts/cabeza.php') ?>
<!-- Content Wrapper. Contains page content -->
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT
    op.cantidad,
    p.nombre AS nombre_producto,
    p.precio AS precio,
    o.nombres,
    o.apellidos,
    o.dni,
    o.email,
    o.pais,
    o.departamento,
    o.distrito,
    o.telefono1,
    o.telefono2,
    o.metodoentrega,
    o.comentarios
FROM orden_producto AS op
INNER JOIN producto AS p ON op.producto_id = p.id
INNER JOIN orden AS o ON op.orden_id = o.id
WHERE o.id = $id;
";
    $queryorden = "select * from orden where id = $id;";

    $result_query = mysqli_query($conexion, $query);
    $result_queryorden = mysqli_query($conexion, $queryorden);

    $ordersproducts = mysqli_fetch_all($result_query, MYSQLI_ASSOC);

    if (mysqli_num_rows($result_queryorden) == 1) {
        $row = mysqli_fetch_assoc($result_queryorden); // Cambio a mysqli_fetch_assoc
        $comentarios = $row['comentarios'];
        $codigo = $row['codigo'];
        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $dni = $row['dni'];
        $email = $row['email'];
        $pais = $row['pais'];
        $departamento = $row['departamento'];
        $distrito = $row['distrito'];
        $direccion = $row['direccion'];
        $telefono1 = $row['telefono1'];
        $telefono2 = $row['telefono2'];
    }

}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container" style="padding-bottom: 50px;">
            <div class="row col-12">
                <div class="mb-3">
                    <div class="btn-group" aria-label="Basic outlined example">
                        <a href="index.php" class="btn btn-success col-12">Volver</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <div>
                        <h1>Orden de Compra</h1>
                    </div>
                </div>
                <div class="col-6">
                    <div>
                        Fecha: <span>22/09/23</span>
                    </div>
                    <div>
                        N° de orden: <span>
                            <?php echo $codigo; ?>
                        </span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <h5>Datos del Cliente</h5>
                </div>
                <div class="col-6">
                    <div>
                        <p>Nombres: <span>
                                <?php echo $nombres; ?>
                            </span></p>
                    </div>
                    <div>
                        <p>Apellidos: <span>
                                <?php echo $apellidos; ?>
                            </span></p>
                    </div>
                    <div>
                        <p>DNI: <span>
                                <?php echo $dni; ?>
                            </span></p>
                    </div>
                    <div>
                        <p>Email: <span>
                                <?php echo $email; ?>
                            </span></p>
                    </div>
                    <div>
                        <p>País: <span>
                                <?php echo $pais; ?>
                            </span></p>
                    </div>
                </div>
                <div class="col-6">
                    <div>
                        <p>Departamento: <span>
                                <?php echo $departamento; ?>
                            </span></p>
                    </div>
                    <div>
                        <p>Distrito: <span>
                                <?php echo $distrito; ?>
                            </span></p>
                    </div>
                    <div>
                        <p>Dirección: <span>
                                <?php echo $direccion; ?>
                            </span></p>
                    </div>
                    <div>
                        <p>Telefono 1: <span>
                                <?php echo $telefono1; ?>
                            </span></p>
                    </div>
                    <div>
                        <p>Telefono 2: <span>
                                <?php echo $telefono2; ?>
                            </span></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio unitario</th>
                            <th scope="col">Precio total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ordersproducts as $key => $orderproduct) { ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $key + 1; ?>
                                </th>
                                <td>
                                    <?php echo $orderproduct['nombre_producto']; ?>
                                </td>
                                <td>
                                    <?php echo $orderproduct['cantidad']; ?>
                                </td>
                                <td>
                                    S/.
                                    <?php echo $orderproduct['precio']; ?>
                                </td>
                                <td>
                                    S/.
                                    <?php echo ($orderproduct['precio'] * $orderproduct['cantidad']); ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="4"><strong>Total:</strong></td>
                            <td><strong>
                                    S/.
                                    <?php
                                    $totalPrecio = 0;
                                    foreach ($ordersproducts as $orderproduct) {
                                        $totalPrecio += $orderproduct['precio'] * $orderproduct['cantidad'];
                                    }
                                    echo $totalPrecio;
                                    ?>
                                </strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-12">
                    <div>Descripcion:</div>
                    <div>
                        <?php echo $comentarios; ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row" style="padding-top: 20px;">
                <div class="col-12 text-right">
                    <p>Fecha de entrega: ________________________________</p>
                </div>
                <div class=" col-12 text-right">
                    <p>Direccion de entrega: ________________________________</p>
                </div>
                <div class="col-12 text-right">
                    <p>Notas: ________________________________</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right" style="padding-top: 100px;">________________________________</div>
                <div class="col-12 text-right">Firma del receptor</div>
            </div>
            <hr>
            <div class="row col-12">
                <div class="mb-3">
                    <div class="btn-group" aria-label="Basic outlined example">
                        <a href="index.php" class="btn btn-success col-12">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('../../app/layouts/pie.php') ?>
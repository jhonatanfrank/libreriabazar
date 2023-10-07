<?php include('../../app/conexion.php'); ?>
<?php include('../../app/url.php'); ?>
<?php include('../../app/sesion.php'); ?>
<?php include('../../app/layouts/cabeza.php') ?>

<?php
$querycategorias = "SELECT * FROM categoria";
$resultcategorias = mysqli_query($conexion, $querycategorias);
$categorias = mysqli_fetch_all($resultcategorias, MYSQLI_ASSOC);

$querymarcas = "SELECT * FROM marca";
$resultmarcas = mysqli_query($conexion, $querymarcas);
$marcas = mysqli_fetch_all($resultmarcas, MYSQLI_ASSOC);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM producto WHERE id = $id";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $nombre = $row['nombre'];
        $categoria = $row['idcategoria'];
        $marca = $row['idmarca'];
        $precio = $row['precio'];
        $stock = $row['stock'];
        $foto = $row['foto'];
        $descripcion = $row['descripcion'];
    }
}



/**Actualizar los datos */
if (isset($_POST['update'])) {
    $id = isset($_GET['id']) ? $_GET['id'] : ''; // Define $id y asigna un valor predeterminado si no está definido
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $foto = $_POST['foto'];
    $descripcion = $_POST['descripcion'];

    $queryupdate = "UPDATE `producto` SET 
    `idcategoria` = '$categoria',  
    `idmarca` = '$marca',  
    `nombre` = '$nombre',
    `precio` = '$precio',
    `stock` = '$stock',
    `foto` = '$foto',
    `descripcion` = '$descripcion'
     WHERE `producto`.`id` = $id;";

    mysqli_query($conexion, $queryupdate);

}

?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <div>Actualizar
                            <?php echo "Producto"; ?>
                        </div>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <div class="btn-group" aria-label="Basic outlined example">
                                <a href="index.php" class="btn btn-outline-success col-12">Volver</a>
                            </div>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form action="update.php?id=<?php echo $_GET['id']; ?>" method="POST" class="row g-3">
                <div class="row col-12">
                    <div class="mb-3 col-4">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input name="nombre" type="text" class="form-control" id="nombre" value="<?php echo $nombre; ?>"
                            required>
                        <div class="invalid-feedback">
                            Por favor, proporciona una dirección válida.
                        </div>
                    </div>
                    <div class="form-group col-4">
                        <label for="categoria" class="form-label">Categorias:</label>
                        <select name="categoria" class="form-control" required>
                            <?php
                            foreach ($categorias as $categoriaOption) {
                                $selected = ($categoriaOption['id'] == $categoria) ? 'selected' : '';
                                echo "<option value='" . $categoriaOption['id'] . "' $selected>" . $categoriaOption['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecciona un puesto válido.
                        </div>
                    </div>
                    <div class="form-group col-4">
                        <label for="marca" class="form-label">Marcas:</label>
                        <select name="marca" class="form-control" required>
                            <option value="" selected disabled>Seleccione una marca</option>
                            <?php
                            foreach ($marcas as $marcaOption) {
                                $selected = ($marcaOption['id'] == $marca) ? 'selected' : '';
                                echo "<option value='" . $marcaOption['id'] . "' $selected>" . $marcaOption['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, seleccione un puesto.
                        </div>
                    </div>
                </div>
                <div class="row col-12">
                    <div class="mb-3 col-4">
                        <label for="precio" class="form-label">Precio:</label>
                        <input name="precio" type="text" class="form-control" id="precio" value="<?php echo $precio; ?>"
                            required>
                        <div class="invalid-feedback">
                            Por favor, proporciona una dirección válida.
                        </div>
                    </div>
                    <div class="mb-3 col-4">
                        <label for="stock" class="form-label">Stock:</label>
                        <input name="stock" type="text" class="form-control" id="stock" value="<?php echo $stock; ?>"
                            required>
                        <div class="invalid-feedback">
                            Por favor, proporciona una dirección válida.
                        </div>
                    </div>
                    <div class="mb-3 col-4">
                        <label for="foto" class="form-label">Foto:</label>
                        <input name="foto" type="text" class="form-control" id="foto" value="<?php echo $foto; ?>"
                            required>
                        <div class="invalid-feedback">
                            Por favor, proporciona una dirección válida.
                        </div>
                    </div>
                </div>
                <div class="row col-12">
                    <div class="mb-3 col-12">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control"
                            rows="5"><?php echo $descripcion; ?></textarea>
                        <div class="invalid-feedback">
                            Por favor, proporciona una dirección válida.
                        </div>
                    </div>
                </div>
                <div class="row col-12">
                    <div class="mb-3 col-4">
                        <input type="submit" name="update" class="btn btn-outline-primary" value="Guardar">
                    </div>
                </div>
            </form>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- /.control-sidebar -->

<?php include('../../app/layouts/pie.php') ?>
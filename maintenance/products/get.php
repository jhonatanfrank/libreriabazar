<?php include('../../app/conexion.php'); ?>
<?php include('../../app/url.php'); ?>
<?php include('../../app/sesion.php'); ?>
<?php include('../../app/layouts/cabeza.php') ?>
<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT producto.*, categoria.nombre AS nombrecategoria, marca.nombre AS nombremarca
      FROM producto
      LEFT JOIN categoria ON producto.idcategoria = categoria.id
      LEFT JOIN marca ON producto.idmarca = marca.id
      WHERE producto.id = $id;";
  $result = mysqli_query($conexion, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $nombre = $row['nombre'];
    $categoria = $row['nombrecategoria'];
    $marca = $row['nombremarca'];
    $precio = $row['precio'];
    $stock = $row['stock'];
    $descripcion = $row['descripcion'];
    $foto = $row['foto'];
  }
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
            <div>Ver
              <?php echo $nombre; ?>
            </div>
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="index.php" class="btn btn-outline-success col-12">Volver</a>
            </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <span>ID:</span>
          <?php echo $id; ?>
        </div>
        <div class="col-12">
          <span>Nombre:</span>
          <?php echo $nombre; ?>
        </div>
        <div class="col-12">
          <span>Marca:</span>
          <?php echo $marca; ?>
        </div>
        <div class="col-12">
          <span>Categoria:</span>
          <?php echo $categoria; ?>
        </div>
        <div class="col-12">
          <span>Precio:</span>
          <?php echo $precio; ?>
        </div>
        <div class="col-12">
          <span>Stock:</span>
          <?php echo $stock; ?>
        </div>
        <div class="col-12">
          <span>Descripcion:</span>
          <?php echo $descripcion; ?>
        </div>
        <div class="col-12">
          <span>Foto:</span>
          <div><img class="foto-get" src="<?php echo $foto; ?>" /></div>
        </div>
      </div>

      <div class="row col-12 mt-2">
        <div class="mb-3">
          <div class="btn-group" aria-label="Basic outlined example">
            <a href="index.php" class="btn btn-outline-success col-12">Volver</a>
            <a href="update.php?id=<?php echo $id; ?>" class="btn btn-outline-primary">Actualizar</a>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
</div>

<?php include('../../app/layouts/pie.php') ?>
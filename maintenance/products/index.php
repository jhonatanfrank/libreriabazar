<?php include('../../app/conexion.php'); ?>
<?php include('../../app/url.php'); ?>
<?php include('../../app/sesion.php'); ?>
<?php include('../../app/layouts/cabeza.php') ?>
<!-- Content Wrapper. Contains page content -->
<?php
$query = "SELECT producto.*, categoria.nombre AS nombrecategoria, marca.nombre AS nombremarca
FROM producto
LEFT JOIN categoria ON producto.idcategoria = categoria.id
LEFT JOIN marca ON producto.idmarca = marca.id;";
$result_query = mysqli_query($conexion, $query);
$products = mysqli_fetch_all($result_query, MYSQLI_ASSOC);
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Producto</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"> <a href="create.php" class="btn btn-outline-success col-12">Agregar Nuevo
                Producto</a>
            </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
  <table id="example1" class="table table-bordered table-hover table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Foto</th>
          <th scope="col">Nombre</th>
          <th scope="col">Categoria</th>
          <th scope="col">Marca</th>
          <th scope="col">Precio</th>
          <th scope="col">Stock</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($products as $key => $product) { ?>
          <tr>
            <th scope="row">
              <?php echo $key + 1; ?>
            </th>
            <td>
              <img class="img-products" src="<?php echo $product['foto']; ?>" alt="<?php echo $product['foto']; ?>">
            </td>
            <td>
              <?php echo $product['nombre']; ?>
            </td>
            <td>
              <?php echo $product['nombrecategoria']; ?>
            </td>
            <td>
              <?php echo $product['nombremarca']; ?>
            </td>
            <td>
              <?php echo "S/. " . $product['precio']; ?>
            </td>
            <td>
              <?php echo $product['stock']; ?>
            </td>
            <td>
              <?php echo $product['descripcion']; ?>
            </td>
            <td>
              <div class="btn-group d-flex justify-content-center" aria-label="Basic outlined example">
                <a href="get.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-success">Ver</a>
                <a href="update.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-primary">Actualizar</a>
                <a href="delete.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-danger">Eliminar</a>
              </div>
            </td>
          </tr>
        <?php } ?>

      </tbody>
    </table>
  </section>
</div>

<?php include('../../app/layouts/pie.php') ?>

<script>
  $(function () {
    $("#example1").DataTable({
      "pageLength": 10,
      "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Mostrar todos"]],
      "language": {
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
        "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
        "infoFiltered": "(Filtrado de _MAX_ total Productos)",
        "infoPostFix": "",
        "lengthMenu": "Mostrar _MENU_ Productos",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscador:",
        "zeroRecords": "No se han encontrado resultados",
        "paginate": {
          "first": "Primero",
          "last": "ultimo",
          "next": "Siguiente", "previous": "Anterior"
        }
      },
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "buttons": [{
        extend: 'collection',
        text: 'Reportes',
        orientation: 'landscape',
        buttons: [
          {
            text: 'Copiar',
            extend: 'copy',
          },
          {
            extend: 'pdf'
          },
          {
            extend: 'csv'
          },
          {
            extend: 'excel'
          },
          {
            text: 'Imprimir',
            extend: 'print'
          }]
      }, {
        extend: 'colvis',
        text: 'Visor de columnas',
        collectionLayaout: 'fixed three-column'
      }
      ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

</script>
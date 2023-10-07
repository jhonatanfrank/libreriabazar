<?php include('../../app/conexion.php'); ?>
<?php include('../../app/url.php'); ?>
<?php include('../../app/sesion.php'); ?>
<?php include('../../app/layouts/cabeza.php') ?>
<!-- Content Wrapper. Contains page content -->
<?php
$query = "select * from orden;";
$result_query = mysqli_query($conexion, $query);
$orders = mysqli_fetch_all($result_query, MYSQLI_ASSOC);
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Ordenes de productos</h1>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
  <table id="example1" class="table table-bordered table-hover table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Codigo</th>
          <th scope="col">Nombres</th>
          <th scope="col">Apellido</th>
          <th scope="col">DNI</th>
          <th scope="col">Producto</th>
          <th scope="col">Pais</th>
          <th scope="col">Departamento</th>
          <th scope="col">Distrito</th>
          <th scope="col">Dirección</th>
          <th scope="col">Telefono 1</th>
          <th scope="col">Telefono 2</th>
          <th scope="col">Recojo</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($orders as $key => $order) { ?>
          <tr>
            <th scope="row">
              <?php echo $key + 1; ?>
            </th>
            <td>
              <?php echo $order['codigo']; ?>
            </td>
            <td>
              <?php echo $order['nombres']; ?>
            </td>
            <td>
              <?php echo $order['apellidos']; ?>
            </td>
            <td>
              <?php echo $order['dni']; ?>
            </td>
            <td>
              <?php echo $order['email']; ?>
            </td>
            <td>
              <?php echo $order['pais']; ?>
            </td>
            <td>
              <?php echo $order['departamento']; ?>
            </td>
            <td>
              <?php echo $order['distrito']; ?>
            </td>
            <td>
              <?php echo $order['direccion']; ?>
            </td>
            <td>
              <?php echo $order['telefono1']; ?>
            </td>
            <td>
              <?php echo $order['telefono2']; ?>
            </td>
            <td>
              <?php echo $order['metodoentrega']; ?>
            </td>

            <td>
              <div class="btn-group d-flex justify-content-center" aria-label="Basic outlined example">
                <a href="get.php?id=<?php echo $order['id']; ?>" class="btn btn-outline-success">Ver</a>      
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
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Ordenes",
        "infoEmpty": "Mostrando 0 a 0 de 0 Ordenes",
        "infoFiltered": "(Filtrado de _MAX_ total Ordenes)",
        "infoPostFix": "",
        "lengthMenu": "Mostrar _MENU_ Ordenes",
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
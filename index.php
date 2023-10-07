<?php include('app/conexion.php'); ?>
<?php include('app/url.php'); ?>
<?php include('app/sesion.php'); ?>

<?php include('app/layouts/cabeza.php'); ?>

<?php
$query_count_products = "SELECT COUNT(id)
FROM producto;";
$result_count_products = mysqli_query($conexion, $query_count_products);
$total_products = mysqli_fetch_assoc($result_count_products)['COUNT(id)'];

$query_count_users = "SELECT COUNT(id)
FROM usuarios;";
$result_count_users = mysqli_query($conexion, $query_count_users);
$total_users = mysqli_fetch_assoc($result_count_users)['COUNT(id)'];

$query_count_orders = "SELECT COUNT(id)
FROM orden;";
$result_count_orders = mysqli_query($conexion, $query_count_orders);
$total_orders = mysqli_fetch_assoc($result_count_orders)['COUNT(id)'];

$query_count_contacts = "SELECT COUNT(id)
FROM contacto;";
$result_count_contacts = mysqli_query($conexion, $query_count_contacts);
$total_contacts = mysqli_fetch_assoc($result_count_contacts)['COUNT(id)'];

$query = "SELECT producto.*, categoria.nombre AS nombrecategoria, marca.nombre AS nombremarca
FROM producto
LEFT JOIN categoria ON producto.idcategoria = categoria.id
LEFT JOIN marca ON producto.idmarca = marca.id
ORDER BY producto.id DESC
LIMIT 5;";
$result_query = mysqli_query($conexion, $query);
$latest_products = mysqli_fetch_all($result_query, MYSQLI_ASSOC);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1>Resumen</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">

          <div class="small-box bg-info">
            <div class="inner">
              <h3>
                <?php echo $total_products; ?>
              </h3>
              <p>Productos</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo $URL; ?>/maintenance/products" class="small-box-footer">Mas información <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">

          <div class="small-box bg-success">
            <div class="inner">
              <h3>
                <?php echo $total_users; ?>
              </h3>
              <p>Usuarios</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">

          <div class="small-box bg-warning">
            <div class="inner">
              <h3>
                <?php echo $total_orders; ?>
              </h3>
              <p>Ordenes</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo $URL; ?>/maintenance/ordersproducts" class="small-box-footer">Mas información <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">

          <div class="small-box bg-danger">
            <div class="inner">
              <h3>
                <?php echo $total_contacts; ?>
              </h3>
              <p>
                Solicitud de contacto
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>


      <div class="row">

        <section class="col-lg-12 connectedSortable">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Ultimos 5 productos agregados recientemente
              </h3>
            </div>
            <div class="card-body">
              <div class="tab-content p-0">
                <table id="example1" class="table table-bordered table-hover table-sm">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Foto</th>
                      <th scope="col">Producto</th>
                      <th scope="col">Categoria</th>
                      <th scope="col">Marca</th>
                      <th scope="col">Precio</th>
                      <th scope="col">Stock</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($latest_products as $key => $product) { ?>
                      <tr>
                        <th scope="row">
                          <?php echo $key + 1; ?>
                        </th>
                        <td>
                          <img class="img-products" src="<?php echo $product['foto']; ?>"
                            alt="<?php echo $product['foto']; ?>">
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
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- /.content -->

    </div>
  </section>
</div>



</section>

<?php include('app/layouts/pie.php') ?>

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
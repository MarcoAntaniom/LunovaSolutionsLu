<?php require_once("../header.php"); ?>
<?php require_once("../sidebar.php"); ?>

<?php
$sql = $conexion->prepare("SELECT u.id, u.nombre, u.apellido_pat, u.apellido_mat, u.rut, u.dv, tt.descripcion AS tipo_trabajador 
                           FROM usuarios u 
                           LEFT JOIN tipo_trabajador tt ON u.tipo_trabajador = tt.id");
$sql->execute();
$registros = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Listado de Usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item active">Listado de Usuarios</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Usuarios Registrados</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Tipo de Trabajador</th>
                    <th>RUT</th>
                    <th>DV</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($registros as $registro): ?>
                    <tr>
                      <td><?php echo $registro['id']; ?></td>
                      <td><?php echo $registro['nombre']; ?></td>
                      <td><?php echo $registro['apellido_pat']; ?></td>
                      <td><?php echo $registro['apellido_mat']; ?></td>
                      <td><?php echo $registro['tipo_trabajador']; ?></td>
                      <td><?php echo $registro['rut']; ?></td>
                      <td><?php echo $registro['dv']; ?></td>
                      <td>
                        <a href="editar_usuario.php?id=<?php echo $registro['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm" onclick="confirmarEliminacion(<?php echo $registro['id']; ?>)">Eliminar</button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require_once("../footer.php"); ?>

<script>
function confirmarEliminacion(id) {
  Swal.fire({
    title: '¿Estás seguro?',
    text: "¡No podrás revertir esto!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminarlo'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'eliminar_usuario.php?id=' + id;
    }
  });
}
</script>
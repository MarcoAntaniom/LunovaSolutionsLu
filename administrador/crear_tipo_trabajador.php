<?php 
require_once("../header.php"); 
require_once("../sidebar.php"); 
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = $_POST['descripcion'];

    try {
        // Realizar la inserción en la base de datos
        $consulta = $conexion->prepare("INSERT INTO tipo_trabajador (descripcion) VALUES (:descripcion)");
        $consulta->bindParam(":descripcion", $descripcion);
        $consulta->execute();

        // Mensaje de éxito con SweetAlert2
        echo "<script>
                Swal.fire({
                    title: 'Tipo de trabajador creado exitosamente',
                    icon: 'success',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'
                });
              </script>";
    } catch (PDOException $e) {
        // Manejo de errores si ocurre una excepción
        echo "<script>
                Swal.fire({
                    title: 'Error al crear el tipo de trabajador',
                    icon: 'error',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'
                });
              </script>";
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Crear Tipo de Trabajador</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item active">Crear Tipo de Trabajador</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Formulario de Nuevo Tipo de Trabajador</h3>
      </div>
      <div class="card-body">
        <!-- Formulario para crear un tipo de trabajador -->
        <form action="" method="POST">
          <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" class="form-control" id="descripcion" required>
          </div>
          <button type="submit" class="btn btn-primary">Crear</button>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<?php require_once("../footer.php"); ?>
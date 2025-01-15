<?php
require_once("../header.php");
require_once("sidebar.php");

$tipos_trabajador = [];
try {
    $consulta_tipos = $conexion->prepare("SELECT id, descripcion FROM tipo_trabajador");
    $consulta_tipos->execute();
    $tipos_trabajador = $consulta_tipos->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al obtener los tipos de trabajador: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rut = $_POST['rut'];
    $dv = $_POST['dv'];
    $nombre = $_POST['nombre'];
    $apellido_pat = $_POST['apellido_pat'];
    $apellido_mat = $_POST['apellido_mat'];
    $clave = $_POST['clave'];
    $tipo_trabajador = $_POST['tipo_trabajador'];

    // Validar que el tipo de trabajador existe
    $validar_tipo = $conexion->prepare("SELECT COUNT(*) FROM tipo_trabajador WHERE id = :id");
    $validar_tipo->bindParam(":id", $tipo_trabajador);
    $validar_tipo->execute();

    if ($validar_tipo->fetchColumn() == 0) {
        die("Error: Tipo de trabajador no válido.");
    }

    try {
        $consulta = $conexion->prepare("INSERT INTO usuarios (rut, dv, clave, nombre, apellido_pat, apellido_mat, tipo_trabajador) VALUES (:rut, :dv, :clave, :nombre, :apellido_pat, :apellido_mat, :tipo_trabajador)");
        $consulta->bindParam(":rut", $rut);
        $consulta->bindParam(":dv", $dv);
        $consulta->bindParam(":clave", $clave);
        $consulta->bindParam(":nombre", $nombre);
        $consulta->bindParam(":apellido_pat", $apellido_pat);
        $consulta->bindParam(":apellido_mat", $apellido_mat);
        $consulta->bindParam(":tipo_trabajador", $tipo_trabajador);
        $consulta->execute();

        echo "<script>
                Swal.fire({
                    title: 'Usuario creado exitosamente',
                    icon: 'success',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'index.php';
                });
              </script>";
    } catch (PDOException $e) {
        echo "<script>
                Swal.fire({
                    title: 'Error al crear el usuario',
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
          <h1>Página en Blanco</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item active">Página en Blanco</li>
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
        <h3 class="card-title">Título</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <!-- Aquí iría el contenido que deseas mostrar -->


<div class="card-body">
        <!-- Formulario para crear el usuario -->
        <form action="crear_usuario.php" method="post">
          <div class="card-body">
            <div class="form-group">
              <label for="rut">RUT</label>
              <input type="text" class="form-control" id="rut" name="rut" placeholder="Ingrese el RUT" required>
            </div>
            <div class="form-group">
              <label for="dv">Dígito Verificador</label>
              <input type="text" class="form-control" id="dv" name="dv" placeholder="Ingrese el Dígito Verificador" required>
            </div>
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el Nombre" required>
            </div>
            <div class="form-group">
              <label for="apellido_pat">Apellido Paterno</label>
              <input type="text" class="form-control" id="apellido_pat" name="apellido_pat" placeholder="Ingrese el Apellido Paterno" required>
            </div>
            <div class="form-group">
              <label for="apellido_mat">Apellido Materno</label>
              <input type="text" class="form-control" id="apellido_mat" name="apellido_mat" placeholder="Ingrese el Apellido Materno" required>
            </div>
            <div class="form-group">
              <label for="clave">Clave</label>
              <input type="text" class="form-control" id="clave" name="clave" placeholder="Ingrese la Clave" required>
            </div>
            <div class="form-group">
              <label for="tipo_trabajador">Tipo de Trabajador</label>
              <select class="form-control" id="tipo_trabajador" name="tipo_trabajador" required>
                <?php foreach ($tipos_trabajador as $tipo): ?>
                  <option value="<?php echo $tipo['id']; ?>"><?php echo $tipo['descripcion']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
            <button type="submit" class="btn btn-primary">Crear Usuario</button>
        </form>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
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
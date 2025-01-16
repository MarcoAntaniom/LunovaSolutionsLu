<?php
require_once("../header.php");
require_once("../sidebar.php");

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = $conexion->prepare("SELECT * FROM usuarios WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->execute();
    $registro = $sql->fetch(PDO::FETCH_ASSOC);

    if ($registro) {
        $nombre = $registro['nombre'];
        $apellido_pat = $registro['apellido_pat'];
        $apellido_mat = $registro['apellido_mat'];
        $tipo_trabajador = $registro['tipo_trabajador'];
        $rut = $registro['rut'];
        $dv = $registro['dv'];
        $clave = $registro['clave'];
    } else {
        echo "Usuario no encontrado.";
        exit;
    }
} else {
    echo "ID de usuario no proporcionado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido_pat = $_POST['apellido_pat'];
    $apellido_mat = $_POST['apellido_mat'];
    $tipo_trabajador = $_POST['tipo_trabajador'];
    $rut = $_POST['rut'];
    $dv = $_POST['dv'];
    $clave = $_POST['clave'];

    try {
        $sql = $conexion->prepare("UPDATE usuarios SET nombre = :nombre, apellido_pat = :apellido_pat, apellido_mat = :apellido_mat, tipo_trabajador = :tipo_trabajador, rut = :rut, dv = :dv, clave = :clave WHERE id = :id");
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":apellido_pat", $apellido_pat);
        $sql->bindParam(":apellido_mat", $apellido_mat);
        $sql->bindParam(":tipo_trabajador", $tipo_trabajador);
        $sql->bindParam(":rut", $rut);
        $sql->bindParam(":dv", $dv);
        $sql->bindParam(":clave", $clave);
        $sql->bindParam(":id", $id);
        $sql->execute();

        echo "<script>
                Swal.fire({
                    title: 'Usuario actualizado exitosamente',
                    icon: 'success',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php';
                    }
                });
              </script>";
    } catch (PDOException $e) {
        echo "<script>
                Swal.fire({
                    title: 'Error al actualizar el usuario',
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
          <h1>Editar Usuario</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item active">Editar Usuario</li>
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
        <h3 class="card-title">Editar Usuario</h3>

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
        <form action="editar_usuario.php?id=<?php echo $id; ?>" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" placeholder="Ingrese el Nombre">
                </div>
                <div class="form-group">
                  <label for="apellido_pat">Apellido Paterno</label>
                  <input type="text" class="form-control" id="apellido_pat" name="apellido_pat" value="<?php echo $apellido_pat; ?>" placeholder="Ingrese el Apellido Paterno">
                </div>
                <div class="form-group">
                  <label for="apellido_mat">Apellido Materno</label>
                  <input type="text" class="form-control" id="apellido_mat" name="apellido_mat" value="<?php echo $apellido_mat; ?>" placeholder="Ingrese el Apellido Materno">
                </div>
                <div class="form-group">
                  <label for="tipo_trabajador">Tipo de Trabajador</label>
                  <select class="form-control" id="tipo_trabajador" name="tipo_trabajador">
                    <?php
                    $consulta_tipos = $conexion->prepare("SELECT id, descripcion FROM tipo_trabajador");
                    $consulta_tipos->execute();
                    $tipos_trabajador = $consulta_tipos->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($tipos_trabajador as $tipo) {
                      $selected = ($tipo['id'] == $tipo_trabajador) ? 'selected' : '';
                      echo "<option value='{$tipo['id']}' {$selected}>{$tipo['descripcion']}</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="rut">RUT</label>
                  <input type="text" class="form-control" id="rut" name="rut" value="<?php echo $rut; ?>" placeholder="Ingrese el RUT">
                </div>
                <div class="form-group">
                  <label for="dv">Dígito Verificador</label>
                  <input type="text" class="form-control" id="dv" name="dv" value="<?php echo $dv; ?>" placeholder="Ingrese el Dígito Verificador">
                </div>
                <div class="form-group">
                  <label for="clave">Clave</label>
                  <input type="text" class="form-control" id="clave" name="clave" value="<?php echo $clave; ?>" placeholder="Ingrese la Clave">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
              </div>
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
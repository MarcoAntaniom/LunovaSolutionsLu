<?php
session_start();
require_once("conexion.php"); 

if (!$conexion) {
    die("Error en la conexión a la base de datos: " . $conexion->errorInfo());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rut = $_POST['rut'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!$rut || !$password) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    try {
        $query = "SELECT u.*, tt.id AS tipo_trabajador_id, tt.descripcion AS tipo_trabajador
                  FROM usuarios u
                  LEFT JOIN tipo_trabajador tt ON u.tipo_trabajador = tt.id
                  WHERE u.rut = :rut";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(":rut", $rut);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if ($password === $usuario['clave']) {
                // Crear variables de sesión
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['tipo_trabajador'] = $usuario['tipo_trabajador'];

                if ($usuario['id'] == 1) {
                    header("Location: administrador/index.php");
                } else {
                    header("Location: dashboard.php");
                }
                exit;
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page dark-mode">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingrese su RUT (sin DV) y contraseña</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="rut" placeholder="RUT">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recuérdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const savedUsername = localStorage.getItem("savedUsername");
    const savedPassword = localStorage.getItem("savedPassword");
    const rememberChecked = localStorage.getItem("rememberChecked");

    if (rememberChecked === "true") {
      document.querySelector("input[name='rut']").value = savedUsername;
      document.querySelector("input[name='password']").value = savedPassword;
      document.getElementById("remember").checked = true;
    }
  });

  document.getElementById("remember").addEventListener("change", function() {
    const rememberChecked = this.checked;

    if (rememberChecked) {
      const username = document.querySelector("input[name='rut']").value;
      const password = document.querySelector("input[name='password']").value;

      localStorage.setItem("savedUsername", username);
      localStorage.setItem("savedPassword", password);
      localStorage.setItem("rememberChecked", "true");
    } else {
      localStorage.removeItem("savedUsername");
      localStorage.removeItem("savedPassword");
      localStorage.removeItem("rememberChecked");
    }
  });
</script>
</body>
</html>
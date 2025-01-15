<?php
session_start();
require_once("conexion.php");

if ($_POST) {
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];
    
    // Preparar consulta para verificar usuario y contraseña
    $sentencia = $conexion->prepare("
        SELECT u.*, t.descripcion AS tipo_usuario_descripcion
        FROM usuarios u
        LEFT JOIN tipo_trabajador t ON u.tipo_trabajador = t.id
        WHERE u.rut = :usuario
        AND u.clave = :password
        LIMIT 1
    ");
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $contrasenia);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario existe
    if ($registro) {
        // Crear variables de sesión
        $_SESSION['usuario'] = $registro["rut"];
        $_SESSION['logueado'] = true;
        $_SESSION['password'] = $registro["clave"];
        $_SESSION['Tipo_usuario'] = $registro["tipo_usuario_descripcion"];
        $_SESSION['tipo_trabajador_id'] = $registro["tipo_trabajador"]; 
        $_SESSION['rut'] = $registro['rut'];
        $_SESSION['dv'] = $registro['dv'];
        $_SESSION['nombre'] = $registro['nombre'];
        $_SESSION['apellido_pat'] = $registro['apellido_pat'];
        $_SESSION['apellido_mat'] = $registro['apellido_mat'];
        $_SESSION['id'] = $registro['id'];


        $bienvenida = "Haz ingresado como <b>" . $registro["nombre"] . " " . $registro["apellido_pat"] . " " . $registro["apellido_mat"] . "</b><br> Tu Rut registrado es <br>" . $registro["rut"] . "- " . $registro["dv"];

        // Redirigir según el tipo de usuario
        switch ($_SESSION['Tipo_usuario']) {
            case "Administrator":
                header("Location: administrador/index.php?bienvenida=" . urlencode($bienvenida));
                break;
            case "Founder and CEO":
                header("Location: fundador/index.php?bienvenida=" . urlencode($bienvenida));
                break;
            case "Finance Administrator":
                header("Location: finanzas/index.php?bienvenida=" . urlencode($bienvenida));
                break;
            case "Support Technician":
                header("Location: soporte/index.php?bienvenida=" . urlencode($bienvenida));
                break;
            case "Operations Director":
                header("Location: operaciones/index.php?bienvenida=" . urlencode($bienvenida));
                break;
            default:
                echo "Tipo de usuario no reconocido.";
                break;
        }
        exit;
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #00c7ca;
    }
  </style>
</head>
<body>
  <header>
    <center><img src="dist/img/logo.png" alt="Logo"></center>
    <br>
    <center><label style="color: white;">Ingrese su Rut (sin DV) y contraseña</label></center>
  </header>
  <main class="container">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <br><br>
        <div class="card" style="background-color: #00c7ca;">
          <form action="" method="post">
            <div class="input-group mb-3">
              <input type="text" name="usuario" class="form-control" placeholder="Escriba su rut sin DV">
              <div class="input-group-append">
                <div class="input-group-text">
                  <i class="fas fa-id-card"></i>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="contrasenia" class="form-control" placeholder="Escriba su contraseña">
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
                  <label for="remember" style="color: white;">Recordar</label>
                </div>
              </div>
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

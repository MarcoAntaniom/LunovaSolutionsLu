<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
  // Usuario no definido, redireccionar a la página de inicio de sesión
  header("Location: login.php");
  exit(); // Asegúrate de salir del script después de la redirección
} else {
  // Obtener el tipo de trabajador del usuario desde la sesión
  $tipo_trabajador = $_SESSION['tipo_trabajador_id'];

  if ($tipo_trabajador == 1) {
    // Usuario tipo 1 (Administrador), redireccionar a la sección de administrador
    header("Location: administrador/index.php");
    exit(); // Asegúrate de salir del script después de la redirección
  } elseif ($tipo_trabajador == 2) {
    // Usuario tipo 2 (Founder and CEO), redireccionar a la sección correspondiente
    header("Location: usuario/index.php");
    exit(); // Asegúrate de salir del script después de la redirección
  } elseif ($tipo_trabajador == 3) {
    // Usuario tipo 3 (Finance Administrator), redireccionar a la sección de finanzas
    header("Location: finanzas/index.php");
    exit(); // Asegúrate de salir del script después de la redirección
  } elseif ($tipo_trabajador == 4) {
    // Usuario tipo 4 (Support Technician), redireccionar a la sección correspondiente
    header("Location: soporte/index.php");
    exit(); // Asegúrate de salir del script después de la redirección
  } elseif ($tipo_trabajador == 5) {
    // Usuario tipo 5 (Operations Director), redireccionar a la sección de operaciones
    header("Location: operaciones/index.php");
    exit(); // Asegúrate de salir del script después de la redirección
  } else {
    // Tipo de trabajador no reconocido, redireccionar a una página de error o logout
    header("Location: logout.php");
    exit(); // Asegúrate de salir del script después de la redirección
  }
}
?>
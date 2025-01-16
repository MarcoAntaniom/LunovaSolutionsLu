<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit(); // Asegúrate de salir del script después de la redirección
} else {
  $tipo_trabajador = $_SESSION['tipo_trabajador_id'];

  switch ($tipo_trabajador) {
    case 1:
      header("Location: administrador/index.php");
      break;
    case 2:
      header("Location: usuario/index.php");
      break;
    case 3:
      header("Location: finanzas/index.php");
      break;
    case 4:
      header("Location: soporte/index.php");
      break;
    case 5:
      header("Location: operaciones/index.php");
      break;
    default:
      header("Location: logout.php");
      break;
  }
  exit(); // Asegúrate de salir del script después de la redirección
}
?>
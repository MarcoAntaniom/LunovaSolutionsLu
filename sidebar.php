<?php
session_start(); // Inicia la sesión

// Verifica si la sesión 'tipo_trabajador_id' está definida
if (isset($_SESSION['tipo_trabajador_id'])) {
    $tipo_trabajador_id = $_SESSION['tipo_trabajador_id']; // Obtiene el ID del tipo de trabajador

    // Verifica el tipo de trabajador y carga el sidebar correspondiente
    if ($tipo_trabajador_id == 1) { // Administrador
        include 'administrador/sidebar.php'; // Barra lateral del administrador
    } elseif ($tipo_trabajador_id == 2) { // Usuario
        include 'usuario/sidebar.php'; // Barra lateral del usuario
    } elseif ($tipo_trabajador_id == 3) { // Finanzas
        include 'finanzas/sidebar.php'; // Barra lateral de finanzas
    } else {
        echo "Tipo de trabajador no identificado."; // Si el tipo de trabajador no se encuentra
    }
} else {
    // Si no se ha iniciado sesión, muestra un mensaje
    echo "No se ha establecido el tipo de usuario";
}
?>

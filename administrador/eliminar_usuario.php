<?php
require_once("../conexion.php");

$id = $_GET['id'] ?? null;

if ($id) {
    // Verificar que el usuario existe
    $sql = $conexion->prepare("SELECT id FROM usuarios WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->execute();
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Eliminar el usuario
        try {
            $sql = $conexion->prepare("DELETE FROM usuarios WHERE id = :id");
            $sql->bindParam(":id", $id);
            $sql->execute();

            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Usuario eliminado exitosamente',
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'listado_usuarios.php';
                            }
                        });
                    });
                  </script>";
        } catch (PDOException $e) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Error al eliminar el usuario',
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'listado_usuarios.php';
                            }
                        });
                    });
                  </script>";
        }
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Usuario no encontrado',
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'listado_usuarios.php';
                        }
                    });
                });
              </script>";
    }
} else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'ID de usuario no proporcionado',
                    icon: 'error',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'listado_usuarios.php';
                    }
                });
            });
          </script>";
}
?>
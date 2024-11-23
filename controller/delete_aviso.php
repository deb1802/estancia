<?php
include '../model/db.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); 
    include '../model/elimiinar_aviso.php';
    deleteAviso($conn, $id);
    // Redirigir de vuelta a la administración de avisos con un mensaje
    header("Location: ../view/avisos/crud_avisos.php?msg=aviso_eliminado");
    exit();
} else {
    // Si no se recibe un ID válido, redirigir con un mensaje de error
    header("Location: ../view/avisos/crud_avisos.php?msg=error_id_invalido");
    exit();
}
?>

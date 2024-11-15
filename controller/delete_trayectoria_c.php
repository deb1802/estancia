<?php
include "../model/db.php";
include "../model/delete_trayectoria.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $execute = eliminarTrayectoria($conn, $id);

    if (!$execute) {
        die("Eliminación falló: " . mysqli_error($conn));
    }

    // Redireccionar después de eliminar
    header("Location: ../view/trayectoria/update_delete.php");
    exit;
} else {
    echo "ID de trayectoria no especificado.";
}
?>

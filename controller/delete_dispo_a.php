<?php
include "../model/db.php";
include "../model/delete_dispon.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $execute = eliminarDisponibilidad($conn, $id);

    // Verificar si la eliminación fue exitosa
    if (!$execute) {
        die("Eliminación falló: " . mysqli_error($conn)); // Mostrar error si la eliminación falla
    }
    header("Location: ../../../../estancia/view/disponibilidad/crud_disponibilidad.php");
    exit;
} else {
    echo "ID de disponibilidad no especificado."; 
}

?>

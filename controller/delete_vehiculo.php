<?php
include "../model/db.php";
include "../model/delete_vehiculo.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $execute = eliminarVehiculo($conn, $id);

    if (!$execute) {
        die("Eliminación falló: " . mysqli_error($conn));
    }

    header("Location: ../view/vehiculo/update_delete.php");
    exit;
} else {
    echo "ID de vehículo no especificado.";
}

include 'includes/footer.php';
?>

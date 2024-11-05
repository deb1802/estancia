<?php
include "../model/db.php"; // Asegúrate de incluir la conexión a la base de datos
include "../model/delete_dispon.php";

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Obtener el ID de la disponibilidad desde la URL

    // Llamar a la función para eliminar la disponibilidad
    $execute = eliminarDisponibilidad($conn, $id);

    // Verificar si la eliminación fue exitosa
    if (!$execute) {
        die("Eliminación falló: " . mysqli_error($conn)); // Mostrar error si la eliminación falla
    }
    header("Location: ../view/disponibilidad/read_dispo.php");
    exit;
} else {
    echo "ID de disponibilidad no especificado."; 
}

?>

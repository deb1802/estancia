<?php
// Incluir la conexión a la base de datos
include_once "db.php";

function obtenerDisponibilidades($conn) {
    $sql = "SELECT * FROM disponibilidad;";
    $exec = mysqli_query($conn, $sql);
    
    if (!$exec) {
        die("Error en la consulta: " . mysqli_error($conn));
    }
    
    return $exec;
}
?>

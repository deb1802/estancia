<?php
function actualizarDisponibilidad($conn, $id, $dia, $horaInicio, $horaFin) {
    $sql = "UPDATE disponibilidad 
            SET dia = ?, horaInicio = ?, horaFin = ? 
            WHERE id = ?;";

    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $sql);
    
    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, "sssi", $dia, $horaInicio, $horaFin, $id);
    
    // Ejecutar la declaración
    $execute = mysqli_stmt_execute($stmt);
    
    // Cerrar la declaración
    mysqli_stmt_close($stmt);
    
    return $execute; 
}
?>

<?php
function actualizarVehiculo($conn, $id, $marca, $modelo, $anio, $placas, $color) {
    $sql = "UPDATE vehiculos 
            SET marca = ?, modelo = ?, anio = ?, placas = ?, color = ? 
            WHERE id = ?;";

    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $sql);
    
    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, "ssissi", $marca, $modelo, $anio, $placas, $color, $id);
    
    // Ejecutar la declaración
    $execute = mysqli_stmt_execute($stmt);
    
    // Cerrar la declaración
    mysqli_stmt_close($stmt);
    
    return $execute; 
}
?>

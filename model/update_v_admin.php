<?php
function actualizarVehiculo($conn, $id, $idconductor, $marca, $modelo, $anio, $placas, $color) {
    $sql = "UPDATE vehiculos 
            SET idConductor = ?, marca = ?, modelo = ?, anio = ?, placas = ?, color = ? 
            WHERE id = ?;";

    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $sql);
    
    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, "isssssi", $idconductor, $marca, $modelo, $anio, $placas, $color, $id);
    
    // Ejecutar la declaración
    $execute = mysqli_stmt_execute($stmt);
    
    // Verificar errores
    if (!$execute) {
        echo "Error al actualizar el registro: " . mysqli_error($conn);
    }

    // Cerrar la declaración
    mysqli_stmt_close($stmt);
    
    return $execute; 
}

?>

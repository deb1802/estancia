<?php
function insertarTrayectoria($conn, $idConductor, $idVehiculo, $capacidad, $origen, $destino, $pago) {
    // Consulta SQL para insertar la trayectoria
    $sql = "INSERT INTO trayectorias (idConductor, idVehiculo, capacidad, origen, destino, pago) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Preparar la consulta
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Enlazar parámetros
        mysqli_stmt_bind_param($stmt, "iiisss", $idConductor, $idVehiculo, $capacidad, $origen, $destino, $pago);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            return true;  // La trayectoria se insertó correctamente
        } else {
            return false;  // Error al ejecutar la consulta
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        return false;  // Error al preparar la consulta
    }
}
?>

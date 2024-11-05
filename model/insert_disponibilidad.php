<?php
function insertarDisponibilidad($conn, $idconductor, $dia, $horaInicio, $horaFin) {
    $query = "INSERT INTO disponibilidad (idconductor, dia, horaInicio, horaFin) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $idconductor, $dia, $horaInicio, $horaFin);

    if ($stmt->execute()) {
        return true; // Éxito
    } else {
        return false; // Error en la inserción
    }

    $stmt->close();
}
?>

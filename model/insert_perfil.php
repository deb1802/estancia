<?php
include 'db.php';
function guardarPerfil($conn, $idAlumno, $nombre, $telefono, $informacion, $imagen, $matricula, $viajes = 0) {
    // Asegúrate de que si $viajes no se proporciona, se establezca como 0
    $sql = "INSERT INTO perfiles (idAlumno, nombreUser, matricula, telefono, informacion, imagen, viajes) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("isssssi", $idAlumno, $nombre, $matricula, $telefono, $informacion, $imagen, $viajes);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true; // Éxito
        } else {
            return false; // Error en la ejecución
        }

        $stmt->close(); // Cerrar el statement
    }
    return false; // Si no se preparó el statement correctamente
}
?>
 
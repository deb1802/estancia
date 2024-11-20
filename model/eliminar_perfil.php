<?php
include 'db.php'; 

function eliminarPerfil($idAlumno) {
    global $conn;

    // Preparar la consulta para eliminar el perfil
    $sql = "DELETE FROM perfiles WHERE idAlumno = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular el parámetro
        $stmt->bind_param("i", $idAlumno);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $stmt->close();
            return true; // Eliminación exitosa
        } else {
            $stmt->close();
            return false; // Error al ejecutar la consulta
        }
    } else {
        return false; // Error al preparar la consulta
    }
}
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';

// Verificar si se enviaron los datos requeridos
if (isset($_POST['idTrayectoria']) && isset($_POST['nuevoEstado'])) {
    $idTrayectoria = intval($_POST['idTrayectoria']); 
    $nuevoEstado = $_POST['nuevoEstado'];
    $estadosPermitidos = ['ninguno', 'iniciado', 'finalizado'];
    if (!in_array($nuevoEstado, $estadosPermitidos)) {
        echo json_encode(['success' => false, 'error' => 'Estado no válido.']);
        exit();
    }

    // Crear la consulta SQL para actualizar el estado en detalleTrayectoria
    $sql = "UPDATE detalleTrayectoria SET estado_viaje = ? WHERE idTrayectoria = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular los parámetros y ejecutar la consulta
        $stmt->bind_param("si", $nuevoEstado, $idTrayectoria);
        $stmt->execute();

        // Verificar si se realizó algún cambio
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'El estado del viaje ha sido actualizado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se encontró la trayectoria o el estado no cambió.']);
        }

        // Cerrar el statement
        $stmt->close();
    } else {
        // Manejo de errores en la consulta
        echo json_encode(['success' => false, 'error' => 'Error en la consulta SQL.']);
    }
} else {
    // Respuesta en caso de datos incompletos
    echo json_encode(['success' => false, 'error' => 'Datos no válidos.']);
}

// Cerrar la conexión
$conn->close();
?>

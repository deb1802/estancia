<?php
// Incluir el archivo de conexión a la base de datos
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';

// Verificar si se han recibido los datos necesarios desde el formulario
if (isset($_POST['idSolicitud']) && isset($_POST['nuevoEstado'])) {
    $idSolicitud = $_POST['idSolicitud'];
    $nuevoEstado = $_POST['nuevoEstado'];

    // Preparar la consulta SQL para actualizar el estado de la solicitud
    $sql = "UPDATE solicitudes SET estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular los parámetros y ejecutar la consulta
        $stmt->bind_param("si", $nuevoEstado, $idSolicitud);
        $stmt->execute();

        // Verificar si la consulta afectó alguna fila
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se encontró la solicitud o el estado no cambió.']);
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        // Si la consulta no se preparó correctamente, enviar un error
        echo json_encode(['success' => false, 'error' => 'Error en la consulta SQL.']);
    }
} else {
    // Enviar un mensaje de error si no se reciben los datos necesarios
    echo json_encode(['success' => false, 'error' => 'Datos no válidos.']);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<?php
header('Content-Type: application/json; charset=utf-8'); // Asegura que la respuesta sea JSON

include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';

$response = ['success' => false, 'error' => 'Error desconocido.']; // Respuesta por defecto

if (isset($_POST['idSolicitud']) && isset($_POST['nuevoEstado'])) {
    $idSolicitud = $_POST['idSolicitud'];
    $nuevoEstado = $_POST['nuevoEstado'];

    $sql = "UPDATE solicitudes SET estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Verifica si el valor de $nuevoEstado no está vacío o nulo
        if (!empty($nuevoEstado)) {
            $stmt->bind_param("si", $nuevoEstado, $idSolicitud);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                // Si el estado se actualiza correctamente
                $response = ['success' => true];
            } else {
                // Si no se encontró la solicitud o el estado no cambió
                $response = ['success' => false, 'error' => 'No se encontró la solicitud o el estado no cambió.'];
            }
        } else {
            $response = ['success' => false, 'error' => 'El estado no es válido.'];
        }

        $stmt->close();
    } else {
        $response = ['success' => false, 'error' => 'Error en la consulta SQL.'];
    }
} else {
    $response = ['success' => false, 'error' => 'Datos no válidos.'];
}

$conn->close();
echo json_encode($response);
?>

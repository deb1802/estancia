<?php
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';
if (isset($_POST['idSolicitud']) && isset($_POST['nuevoEstado'])) {
    $idSolicitud = $_POST['idSolicitud'];
    $nuevoEstado = $_POST['nuevoEstado'];
    $sql = "UPDATE solicitudes SET estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("si", $nuevoEstado, $idSolicitud);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se encontró la solicitud o el estado no cambió.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Error en la consulta SQL.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Datos no válidos.']);
}
$conn->close();
?>

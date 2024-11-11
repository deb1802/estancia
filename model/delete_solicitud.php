<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';

if (!isset($_SESSION['id_conductor'])) {
    echo json_encode(['success' => false, 'message' => 'NO HAS INICIADO SESIÓN']);
    exit;
}

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos.']);
    exit;
}

// Obtener el id de la solicitud desde la solicitud AJAX
$idSolicitud = $_POST['id'] ?? null;

if ($idSolicitud) {
    // Preparar la consulta SQL para eliminar la solicitud
    $stmt = $conn->prepare("DELETE FROM solicitudes WHERE id = ?");
    $stmt->bind_param("i", $idSolicitud);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Solicitud eliminada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar la solicitud.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID de solicitud no válido.']);
}

$conn->close();
?>

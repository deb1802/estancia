<?php
include 'db.php'; // Asegúrate de que la conexión con mysqli esté configurada correctamente

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        // Eliminar los registros en detalleTrayectoria
        $deleteDetalleQuery = "DELETE FROM detalleTrayectoria WHERE idTrayectoria = ?";
        $stmtDetalle = $conn->prepare($deleteDetalleQuery);
        $stmtDetalle->bind_param('i', $id);
        $stmtDetalle->execute();

        // Ahora eliminar la trayectoria
        $deleteQuery = "DELETE FROM trayectorias2 WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param('i', $id); 
        $stmt->execute();

        // Respuesta exitosa en formato JSON
        echo json_encode(['success' => true]);

    } catch (Exception $e) {
        // Si ocurre un error
        echo json_encode(['success' => false, 'message' => 'Error al eliminar la trayectoria: ' . $e->getMessage()]);
    }
} else {
    // Respuesta en caso de falta de id
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
}
?>

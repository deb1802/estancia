<?php
session_start();
require 'db.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idAlumno'])) {
    echo json_encode(['success' => false, 'message' => 'NO HAS INCIADO SESIÓN']);
    exit;
}

$idAlumno = $_SESSION['idAlumno'];
$idTrayectoria = $_POST['idTrayectoria'] ?? null;

// Verificar el contenido de $_POST para ver si contiene 'idTrayectoria'
if (!$idTrayectoria) {
    echo json_encode(['success' => false, 'message' => 'ID de trayectoria no proporcionado', 'post_data' => $_POST]);
    exit;
}

try {
    $sql = "INSERT INTO solicitudes (idAlumno, idTrayectoria, estado) VALUES (?, ?, 'pendiente')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $idAlumno, $idTrayectoria);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Solicitud insertada correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al insertar la solicitud']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

?>

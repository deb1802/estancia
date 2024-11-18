<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';

if (!isset($_SESSION['idAlumno'])) {
    echo json_encode(['success' => false, 'message' => 'NO HAS INICIADO SESIÓN']);
    exit;
}

if (!$conn) {
    echo "Error: No se pudo conectar a la base de datos.";
    exit();
}

$idAlumno = $_SESSION['idAlumno'];
$sql = "SELECT titulo, mensaje FROM avisos WHERE idAlumno = ? ORDER BY fecha DESC";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Error en la consulta']);
    exit;
}

$stmt->bind_param("i", $idAlumno);
$stmt->execute();
$result = $stmt->get_result();
$avisos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $avisos[] = $row;
    }
} else {
    // Si no hay avisos, enviar un mensaje vacío
    $avisos = [];
}

// Cerrar la conexión
$stmt->close();
$conn->close();

// Enviar los avisos como un JSON
echo json_encode($avisos);
?>

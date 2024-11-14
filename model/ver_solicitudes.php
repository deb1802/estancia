<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';

if (!isset($_SESSION['id_conductor'])) {
    echo json_encode(['success' => false, 'message' => 'NO HAS INICIADO SESIÓN']);
    exit;
}

if (!$conn) {
    echo "Error: No se pudo conectar a la base de datos.";
    exit();
}

// Obtenemos el id del conductor desde la sesión
$idConductor = $_SESSION['id_conductor'];

// Consulta SQL para obtener las solicitudes del conductor específico
$sql = "
    SELECT 
        s.id,  -- Mantener la columna idSolicitud para las acciones, pero no mostrarla
        s.fechaSolicitud,
        s.estado,
        u1.nombre AS nombre_alumno,
        u1.correo AS email_alumno,
        u2.nombre AS nombre_conductor,
        t.origen,
        t.destino,
        v.marca,
        v.modelo,
        v.anio,
        t.capacidad,
        t.referencias
    FROM solicitudes s
    JOIN usuarios u1 ON s.idAlumno = u1.id
    JOIN trayectorias2 t ON s.idTrayectoria = t.id
    JOIN usuarios u2 ON t.idConductor = u2.id
    JOIN vehiculos v ON t.idVehiculo = v.id
    WHERE t.idConductor = ?  -- Filtra las solicitudes por idConductor
    ORDER BY s.fechaSolicitud DESC 
";

// Preparar la consulta
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $idConductor); // Enlaza el idConductor a la consulta
$stmt->execute();

// Obtener los resultados
$result = $stmt->get_result();
$solicitudes = $result->fetch_all(MYSQLI_ASSOC);
?>

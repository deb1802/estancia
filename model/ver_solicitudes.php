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
    JOIN trayectorias t ON s.idTrayectoria = t.id
    JOIN usuarios u2 ON t.idConductor = u2.id
    JOIN vehiculos v ON t.idVehiculo = v.id
    WHERE t.idConductor = ?;  -- Filtra las solicitudes por idConductor
";

// Preparar la consulta
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $idConductor); // Enlaza el idConductor a la consulta
$stmt->execute();

// Obtener los resultados
$result = $stmt->get_result();
$solicitudes = $result->fetch_all(MYSQLI_ASSOC);

// Mostrar los resultados (código comentado para mostrar tarjetas o mensajes)
/*if ($result->num_rows > 0) {
    foreach ($solicitudes as $solicitud) {
        echo "<div class='trayectoria-card'>";
        echo "<div class='trayectoria-details'>";
        echo "<h5><strong>Trayectoria:</strong></h5>";
        echo "<p><strong>Origen:</strong> " . htmlspecialchars($solicitud['origen']) . "</p>";
        echo "<p><strong>Destino:</strong> " . htmlspecialchars($solicitud['destino']) . "</p>";
        echo "<h5><strong>Conductor:</strong></h5>";
        echo "<p><strong>Nombre:</strong> " . htmlspecialchars($solicitud['nombre_conductor']) . "</p>";
        echo "<p><strong>Vehículo:</strong> " . htmlspecialchars($solicitud['marca']) . " " . htmlspecialchars($solicitud['modelo']) . " (" . htmlspecialchars($solicitud['anio']) . ")</p>";
        echo "<h5><strong>Alumno Solicitante:</strong></h5>";
        echo "<p><strong>Nombre:</strong> " . htmlspecialchars($solicitud['nombre_alumno']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($solicitud['email_alumno']) . "</p>";
        echo "<h5><strong>Detalles de la Solicitud:</strong></h5>";
        echo "<p><strong>Fecha de Solicitud:</strong> " . htmlspecialchars($solicitud['fechaSolicitud']) . "</p>";
        echo "<p><strong>Estado:</strong> " . ucfirst(htmlspecialchars($solicitud['estado'])) . "</p>";
        
        // Botones para cambiar el estado
        echo "<button class='btn btn-success' onclick='cambiarEstadoSolicitud(" . $solicitud['id'] . ", \"aceptada\")'>Aceptar</button>";
        echo "<button class='btn btn-danger' onclick='cambiarEstadoSolicitud(" . $solicitud['id'] . ", \"rechazada\")'>Rechazar</button>";
        echo "</div></div>";
    }
} else {
    echo "<p>No hay solicitudes para mostrar.</p>";
}

$stmt->close();*/
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php'; 

// Consulta las trayectorias desde la base de datos
$query = "
    SELECT 
        t.id, 
        t.origen, 
        t.destino, 
        t.referencias, 
        t.capacidad, 
        t.pago,
        u.nombre AS conductor, 
        v.marca, 
        v.modelo, 
        v.anio,
        v.color, 
        v.placas,
        u.id AS idConductor
    FROM trayectorias2 t
    JOIN usuarios u ON t.idConductor = u.id
    JOIN vehiculos v ON t.idVehiculo = v.id
    ";
$result = $conn->query($query);

$trayectorias = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Obtener las disponibilidades para este conductor
        $idConductor = $row['idConductor'];
        $queryDisponibilidad = "
            SELECT dia, TIME_FORMAT(horaInicio, '%H:%i') as horaInicio, TIME_FORMAT(horaFin, '%H:%i') as horaFin 
            FROM disponibilidad 
            WHERE idConductor = $idConductor";
        $resultDisponibilidad = $conn->query($queryDisponibilidad);
        
        $disponibilidades = [];
        if ($resultDisponibilidad) {
            while ($dispo = $resultDisponibilidad->fetch_assoc()) {
                $disponibilidades[] = $dispo;
            }
        }
        
        // Agregar la disponibilidad al array de trayectorias
        $row['disponibilidad'] = $disponibilidades;
        $trayectorias[] = $row;
    }
}
?>

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
        u.nombre AS conductor, 
        v.marca, 
        v.modelo, 
        v.anio, 
        v.placas
    FROM trayectorias t
    JOIN usuarios u ON t.idConductor = u.id
    JOIN vehiculos v ON t.idVehiculo = v.id";
$result = $conn->query($query);

$trayectorias = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $trayectorias[] = $row;
    }
}
?>

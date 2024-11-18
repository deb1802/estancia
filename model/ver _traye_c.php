<?php
session_start();
if (isset($_SESSION['id_conductor'])) {
    $idConductor = $_SESSION['id_conductor'];

    include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';

    // Consulta las trayectorias del conductor específico
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
            v.placas
        FROM trayectorias2 t
        JOIN usuarios u ON t.idConductor = u.id
        JOIN vehiculos v ON t.idVehiculo = v.id
        WHERE t.capacidad > 0 AND t.idConductor = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $idConductor);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener los resultados
        $result = $stmt->get_result();
        $trayectorias = [];
        while ($row = $result->fetch_assoc()) {
            $trayectorias[] = $row;
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta.";
    }

} else {
    echo "No se ha encontrado el conductor en la sesión.";
}
?>

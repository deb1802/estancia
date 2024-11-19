<?php
// Incluir la conexión a la base de datos
include_once "db.php";

function obtenerDisponibilidades($conn) {
    $sql = "SELECT 
                d.idConductor,
                u.nombre,
                u.apellido,
                d.dia,
                d.horaInicio,
                d.horaFin
            FROM disponibilidad AS d
            INNER JOIN usuarios AS u ON d.idConductor = u.id
            WHERE u.tipo = 'conductor';";

    $exec = mysqli_query($conn, $sql);

    if (!$exec) {
        die("Error en la consulta: " . mysqli_error($conn));
    }

    return $exec;
}

?>

<?php
include 'db.php'; // Incluye la conexión a la base de datos

// Verifica que se haya recibido el parámetro
if (isset($_GET['idTrayectoria'])) {
    $idTrayectoria = $_GET['idTrayectoria'];

    try {
        // Iniciar una transacción (deshabilitar autocommit)
        $conn->autocommit(false);  // Inicia la transacción

        // Primera consulta: detalles de la trayectoria
        $queryTrayectoria = "
            SELECT 
                t.origen, 
                t.destino, 
                dt.estado_viaje 
            FROM detalleTrayectoria dt
            INNER JOIN trayectorias2 t ON dt.idTrayectoria = t.id
            WHERE dt.idTrayectoria = ?
        ";
        $stmtTrayectoria = $conn->prepare($queryTrayectoria);
        $stmtTrayectoria->bind_param('i', $idTrayectoria); // 'i' es para entero
        $stmtTrayectoria->execute();
        $stmtTrayectoria->store_result();

        // Verificar si se encontraron detalles de la trayectoria
        if ($stmtTrayectoria->num_rows > 0) {
            $stmtTrayectoria->bind_result($origen, $destino, $estado_viaje);
            $stmtTrayectoria->fetch();  // Recuperar los datos de la consulta

            // Segunda consulta: alumnos asociados a esta trayectoria
            $queryAlumnos = "
                SELECT 
                    a.nombre AS nombre_alumno, 
                    a.correo AS email_alumno 
                FROM detalleTrayectoria dt
                INNER JOIN usuarios a ON dt.idAlumno = a.id
                WHERE dt.idTrayectoria = ?
            ";
            $stmtAlumnos = $conn->prepare($queryAlumnos);
            $stmtAlumnos->bind_param('i', $idTrayectoria); // 'i' es para entero
            $stmtAlumnos->execute();
            $resultAlumnos = $stmtAlumnos->get_result();

            // Obtener los alumnos
            $alumnos = [];
            while ($alumno = $resultAlumnos->fetch_assoc()) {
                $alumnos[] = $alumno;
            }

            // Confirmar la transacción
            $conn->commit();  // Confirmar la transacción

            // Devolver los datos en formato JSON
            echo json_encode([
                'success' => true,
                'detalles' => [
                    'origen' => $origen,
                    'destino' => $destino,
                    'estado_viaje' => $estado_viaje,
                    'alumnos' => $alumnos
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontraron detalles de la trayectoria.']);
        }
    } catch (Exception $e) {
        // Si ocurre algún error, revertir la transacción
        $conn->rollback();  // Revertir la transacción
        echo json_encode(['success' => false, 'message' => 'Error al cargar los detalles: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de trayectoria no proporcionado.']);
}

?>

<?php
// Limpia el buffer de salida
ob_start();

// Incluir conexión a la base de datos y librerías necesarias
require '../../estancia/vendor/autoload.php';
include '../../estancia/model/db.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

function generar_reporte_solicitudes($fecha_inicio, $fecha_fin) {
    global $conn;
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta principal: Solicitudes por estado
    $sql = "SELECT estado, COUNT(*) AS total 
            FROM solicitudes 
            WHERE fechaSolicitud BETWEEN ? AND ? 
            GROUP BY estado";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $fecha_inicio, $fecha_fin);
    $stmt->execute();
    $result = $stmt->get_result();

    // Consulta para el conductor que rechazó más
    $sql_rechazos = "SELECT CONCAT(u.nombre, ' ', u.apellido) AS conductor, COUNT(*) AS total 
                     FROM solicitudes s
                     JOIN trayectorias2 t ON s.idTrayectoria = t.id
                     JOIN usuarios u ON t.idConductor = u.id
                     WHERE s.estado = 'rechazada' AND u.tipo = 'conductor' AND s.fechaSolicitud BETWEEN ? AND ? 
                     GROUP BY u.id 
                     ORDER BY total DESC 
                     LIMIT 1";

    $stmt_rechazos = $conn->prepare($sql_rechazos);
    $stmt_rechazos->bind_param("ss", $fecha_inicio, $fecha_fin);
    $stmt_rechazos->execute();
    $resultado_rechazos = $stmt_rechazos->get_result()->fetch_assoc();
    $conductor_rechazos = $resultado_rechazos['conductor'] ?? 'N/A';
    $total_rechazos = $resultado_rechazos['total'] ?? 0;

    // Consulta para el conductor que aceptó más
    $sql_aceptados = "SELECT CONCAT(u.nombre, ' ', u.apellido) AS conductor, COUNT(*) AS total 
                      FROM solicitudes s
                      JOIN trayectorias2 t ON s.idTrayectoria = t.id
                      JOIN usuarios u ON t.idConductor = u.id
                      WHERE s.estado = 'aceptada' AND u.tipo = 'conductor' AND s.fechaSolicitud BETWEEN ? AND ? 
                      GROUP BY u.id 
                      ORDER BY total DESC 
                      LIMIT 1";

    $stmt_aceptados = $conn->prepare($sql_aceptados);
    $stmt_aceptados->bind_param("ss", $fecha_inicio, $fecha_fin);
    $stmt_aceptados->execute();
    $resultado_aceptados = $stmt_aceptados->get_result()->fetch_assoc();
    $conductor_aceptados = $resultado_aceptados['conductor'] ?? 'N/A';
    $total_aceptados = $resultado_aceptados['total'] ?? 0;

    // Generar hoja de cálculo
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Reservar espacio para el logo
    $sheet->mergeCells('A1:B3');
    $sheet->mergeCells('C1:D1');

    $drawing = new Drawing();
    $drawing->setName('Logo');
    $drawing->setDescription('Logo');
    $drawing->setPath('../public/img/Diseño sin título (2).png');
    $drawing->setHeight(60);
    $drawing->setCoordinates('A1');
    $drawing->setWorksheet($sheet);

    // Título
    $sheet->mergeCells('A4:D4'); 
    $sheet->setCellValue('A4', 'Reporte de Solicitudes por Estado');
    $sheet->getStyle('A4')->getFont()->setBold(true)->setSize(14);
    $sheet->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Fechas seleccionadas
    $sheet->setCellValue('A5', 'Fecha de Inicio:');
    $sheet->setCellValue('B5', $fecha_inicio);
    $sheet->setCellValue('C5', 'Fecha de Fin:');
    $sheet->setCellValue('D5', $fecha_fin);
    $sheet->getStyle('A5:D5')->getFont()->setItalic(true);

    // Encabezados
    $sheet->setCellValue('A7', 'Estado');
    $sheet->setCellValue('B7', 'Total');
    $sheet->setCellValue('C7', 'Conductor que rechazó más');
    $sheet->setCellValue('D7', 'Conductor que aceptó más');

    // Datos principales
    $row = 8;
    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $data['estado']);
        $sheet->setCellValue('B' . $row, $data['total']);
        $sheet->setCellValue('C' . $row, ($row === 8) ? $conductor_rechazos . " ($total_rechazos)" : '');
        $sheet->setCellValue('D' . $row, ($row === 8) ? $conductor_aceptados . " ($total_aceptados)" : '');
        $row++;
    }

    // Ajustar el ancho de las columnas automáticamente
    foreach (range('A', $sheet->getHighestColumn()) as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Descargar reporte
    $writer = new Xlsx($spreadsheet);
    $filename = "reporte_solicitudes_" . date('Y-m-d_H-i-s') . ".xlsx";

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit();
}

// Limpia cualquier salida previa
ob_end_clean();
?>

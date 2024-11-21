<?php
// Limpia el buffer de salida
ob_start();

// Incluir la conexión a la base de datos
require '../../estancia/vendor/autoload.php';
include '../../estancia/model/db.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

function generar_reporte($fecha_inicio, $fecha_fin) {
    global $conn;
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT u.id AS Alumno_ID, 
                   u.nombre AS Nombre, 
                   u.apellido AS Apellido, 
                   COUNT(dt.id) AS Total_Viajes
            FROM usuarios u
            JOIN detalleTrayectoria dt ON u.id = dt.idAlumno
            JOIN solicitudes s ON s.idTrayectoria = dt.idTrayectoria
            JOIN trayectorias2 t ON t.id = s.idTrayectoria
            WHERE dt.estado_viaje = 'finalizado'
              AND s.fechaSolicitud BETWEEN ? AND ?
            GROUP BY u.id
            ORDER BY COUNT(dt.id) DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $fecha_inicio, $fecha_fin);
    $stmt->execute();
    $result = $stmt->get_result();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Reservar espacio para el logo combinando celdas
    $sheet->mergeCells('A1:B3'); 
    $sheet->mergeCells('C1:D1'); 

    // Insertar el logo
    $drawing = new Drawing();
    $drawing->setName('Logo');
    $drawing->setDescription('Logo');
    $drawing->setPath('../public/img/Diseño sin título (2).png'); 
    $drawing->setHeight(60);
    $drawing->setCoordinates('A1');
    $drawing->setWorksheet($sheet);

    // Título
    $sheet->mergeCells('A4:D4'); // Combina celdas para el título
    $sheet->setCellValue('A4', 'Reporte de Alumnos y Total de Viajes');
    $sheet->getStyle('A4')->getFont()->setBold(true)->setSize(14);
    $sheet->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Encabezados
    $sheet->setCellValue('A6', 'Alumno_ID');
    $sheet->setCellValue('B6', 'Nombre');
    $sheet->setCellValue('C6', 'Apellido');
    $sheet->setCellValue('D6', 'Total_Viajes');

    // Datos
    $row = 7;
    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $data['Alumno_ID']);
        $sheet->setCellValue('B' . $row, $data['Nombre']);
        $sheet->setCellValue('C' . $row, $data['Apellido']);
        $sheet->setCellValue('D' . $row, $data['Total_Viajes']);
        $row++;
    }

    $writer = new Xlsx($spreadsheet);
    $filename = "reporte_alumnos_" . date('Y-m-d_H-i-s') . ".xlsx";

    // Cabeceras para la descarga
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Guardar en la salida
    $writer->save('php://output');
    exit();
}

// Limpia cualquier salida previa
ob_end_clean();
?>

<?php
// Limpia el buffer de salida
ob_start();

// Incluir la conexión a la base de datos
require '../../estancia/vendor/autoload.php';
include '../../estancia/model/db.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

function generar_reporte3() {
    global $conn;
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para el reporte 3
    $sql = "SELECT 
                v.id AS 'ID Vehículo', 
                CONCAT(v.marca, ' ', v.modelo, ' (', v.placas, ')') AS 'Vehículo',
                u.nombre AS 'Conductor',
                COUNT(t.id) AS 'Trayectorias Realizadas'
            FROM vehiculos v
            JOIN trayectorias2 t ON v.id = t.idVehiculo
            JOIN usuarios u ON u.id = v.idConductor
            GROUP BY v.id
            ORDER BY `Trayectorias Realizadas` DESC";

    $result = $conn->query($sql);

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

    // Título del reporte
    $sheet->mergeCells('A4:D4'); // Combina celdas para el título
    $sheet->setCellValue('A4', 'Reporte de Vehículos y Trayectorias Realizadas');
    $sheet->getStyle('A4')->getFont()->setBold(true)->setSize(14);
    $sheet->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Encabezados
    $sheet->setCellValue('A6', 'ID Vehículo');
    $sheet->setCellValue('B6', 'Vehículo');
    $sheet->setCellValue('C6', 'Conductor');
    $sheet->setCellValue('D6', 'Trayectorias Realizadas');

    // Datos
    $row = 7;
    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $data['ID Vehículo']);
        $sheet->setCellValue('B' . $row, $data['Vehículo']);
        $sheet->setCellValue('C' . $row, $data['Conductor']);
        $sheet->setCellValue('D' . $row, $data['Trayectorias Realizadas']);
        $row++;
    }

    // Crear archivo de Excel y configuraciones de cabecera para la descarga
    $writer = new Xlsx($spreadsheet);
    $filename = "reporte_vehiculos_trayectorias_" . date('Y-m-d_H-i-s') . ".xlsx";

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

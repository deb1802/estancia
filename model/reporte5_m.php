<?php
// Limpia el buffer de salida
ob_start();

// Incluir la conexión a la base de datos
require '../../estancia/vendor/autoload.php';
include '../../estancia/model/db.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

function generar_reporte5() {
    global $conn;
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consultas SQL
    $sqlMarcas = "SELECT marca, COUNT(*) AS total FROM vehiculos GROUP BY marca ORDER BY total DESC";
    $sqlModelos = "SELECT modelo, COUNT(*) AS total FROM vehiculos GROUP BY modelo ORDER BY total DESC";
    $sqlAnio = "SELECT anio, COUNT(*) AS total FROM vehiculos GROUP BY anio ORDER BY total DESC LIMIT 1";

    $resultMarcas = $conn->query($sqlMarcas);
    $resultModelos = $conn->query($sqlModelos);
    $resultAnio = $conn->query($sqlAnio)->fetch_assoc();

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
    $sheet->mergeCells('A4:E4');
    $sheet->setCellValue('A4', 'Reporte de Vehículos');
    $sheet->getStyle('A4')->getFont()->setBold(true)->setSize(14);
    $sheet->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Encabezados para Marcas
    $sheet->setCellValue('A6', 'Marca');
    $sheet->setCellValue('B6', 'Total');
    $row = 7;
    while ($marca = $resultMarcas->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $marca['marca']);
        $sheet->setCellValue('B' . $row, $marca['total']);
        $row++;
    }

    // Encabezados para Modelos
    $sheet->setCellValue('D6', 'Modelo');
    $sheet->setCellValue('E6', 'Total');
    $row = 7;
    while ($modelo = $resultModelos->fetch_assoc()) {
        $sheet->setCellValue('D' . $row, $modelo['modelo']);
        $sheet->setCellValue('E' . $row, $modelo['total']);
        $row++;
    }

    // Información del Año con Más Vehículos
    $sheet->setCellValue('A' . ($row + 2), 'Año con Más Vehículos:');
    $sheet->setCellValue('B' . ($row + 2), $resultAnio['anio']);
    $sheet->setCellValue('C' . ($row + 2), 'Total:');
    $sheet->setCellValue('D' . ($row + 2), $resultAnio['total']);

    // Ajustar columnas automáticamente
    foreach (range('A', $sheet->getHighestColumn()) as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Descargar archivo
    $writer = new Xlsx($spreadsheet);
    $filename = "reporte_vehiculos_" . date('Y-m-d_H-i-s') . ".xlsx";

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit();
}

// Limpia cualquier salida previa
ob_end_clean();
?>

<?php
// Limpia el buffer de salida
ob_start();

// Incluir la conexión a la base de datos
require '../../estancia/vendor/autoload.php';
include '../../estancia/model/db.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

function generar_reporte2() {
    global $conn;
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL sin manejo de fechas
    $sql = "SELECT 
                CONCAT(v.marca, ' ', v.modelo, ' (', v.placas, ')') AS Vehículo,
                t.origen AS Origen,
                t.destino AS Destino,
                t.capacidad AS 'Capacidad Inicial',
                COUNT(dt.id) AS 'Espacios Ocupados',
                (t.capacidad - COUNT(dt.id)) AS 'Espacios Disponibles'
            FROM trayectorias2 t
            JOIN vehiculos v ON t.idVehiculo = v.id
            LEFT JOIN detalleTrayectoria dt ON t.id = dt.idTrayectoria
            GROUP BY t.id, t.origen, t.destino, v.marca, v.modelo, v.placas, t.capacidad
            ORDER BY `Espacios Disponibles` DESC";  // Se elimina la condición de fecha

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

    // Título
    $sheet->mergeCells('A4:D4'); // Combina celdas para el título
    $sheet->setCellValue('A4', 'Reporte de Vehículos y Trayectorias');
    $sheet->getStyle('A4')->getFont()->setBold(true)->setSize(14);
    $sheet->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Encabezados
    $sheet->setCellValue('A6', 'Vehículo');
    $sheet->setCellValue('B6', 'Origen');
    $sheet->setCellValue('C6', 'Destino');
    $sheet->setCellValue('D6', 'Capacidad Inicial');
    $sheet->setCellValue('E6', 'Espacios Ocupados');
    $sheet->setCellValue('F6', 'Espacios Disponibles');

    // Datos
    $row = 7;
    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $data['Vehículo']);
        $sheet->setCellValue('B' . $row, $data['Origen']);
        $sheet->setCellValue('C' . $row, $data['Destino']);
        $sheet->setCellValue('D' . $row, $data['Capacidad Inicial']);
        $sheet->setCellValue('E' . $row, $data['Espacios Ocupados']);
        $sheet->setCellValue('F' . $row, $data['Espacios Disponibles']);
        $row++;
    }

    // Crear archivo de Excel y configuraciones de cabecera para la descarga
    $writer = new Xlsx($spreadsheet);
    $filename = "reporte_vehiculos_" . date('Y-m-d_H-i-s') . ".xlsx";

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

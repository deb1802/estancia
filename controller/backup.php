<?php
include '../model/connect.php';

// Obtener la fecha y hora actual para el nombre del archivo de respaldo
$day = date("d"); // Día actual
$month = date("m"); // Mes actual
$year = date("Y"); // Año actual
$hora = date("H-i-s"); // Hora actual
$fecha = "UPEMOV_" . $day . '_' . $month . '_' . $year . "_(" . $hora . "_hrs).sql"; // Nombre del archivo con fecha y hora

// Array para almacenar los nombres de las tablas
$tables = array();

// Obtener la lista de tablas de la base de datos
$result = SGBD::sql('SHOW TABLES');

// Procesar tablas si se obtienen correctamente
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0]; // Almacenar nombre de tabla
    }

    // Inicializar contenido del respaldo
    $sql = 'SET FOREIGN_KEY_CHECKS=0;' . "\n\n"; // Desactivar las comprobaciones de claves foráneas
    $sql .= 'CREATE DATABASE IF NOT EXISTS ' . BD . ";\n\n"; // Crear base de datos si no existe
    $sql .= 'USE ' . BD . ";\n\n"; // Seleccionar base de datos

    // Recorrer todas las tablas y generar el respaldo
    foreach ($tables as $table) {
        $result = SGBD::sql('SELECT * FROM ' . $table);
        if ($result) {
            $numFields = mysqli_num_fields($result); // Obtener número de campos

            // Crear la estructura de la tabla
            $sql .= 'DROP TABLE IF EXISTS ' . $table . ';';
            $row2 = mysqli_fetch_row(SGBD::sql('SHOW CREATE TABLE ' . $table));
            $sql .= "\n\n" . $row2[1] . ";\n\n"; // Incluir sentencia CREATE TABLE

            // Insertar los datos de la tabla
            while ($row = mysqli_fetch_row($result)) {
                $sql .= 'INSERT INTO ' . $table . ' VALUES(';
                for ($j = 0; $j < $numFields; $j++) {
                    $row[$j] = addslashes($row[$j]); // Escapar caracteres especiales
                    $row[$j] = str_replace("\n", "\\n", $row[$j]); // Manejar saltos de línea
                    $sql .= isset($row[$j]) ? '"' . $row[$j] . '"' : '""';
                    $sql .= ($j < ($numFields - 1)) ? ',' : '';
                }
                $sql .= ");\n"; // Finalizar sentencia INSERT
            }
            $sql .= "\n\n\n"; // Separar por saltos de línea
        }
    }

    // Reactivar comprobaciones de claves foráneas
    $sql .= 'SET FOREIGN_KEY_CHECKS=1;';

    // Guardar archivo de respaldo
    $backupPath = BACKUP_PATH . $fecha;

    // Enviar archivo para descarga si se guarda correctamente
    if (file_put_contents($backupPath, $sql)) {
        header('Content-Type: application/sql');
        header('Content-Disposition: attachment; filename="' . $fecha . '"');
        readfile($backupPath); // Leer archivo para descargar
        unlink($backupPath); // Eliminar archivo temporal
        exit;
    } else {
        echo 'Error al crear la copia de seguridad'; // Mensaje de error
    }
} else {
    echo 'Error inesperado al obtener las tablas'; // Mensaje si falla al obtener tablas
}

// Liberar el resultado de la consulta
mysqli_free_result($result);
?>

<?php
include '../model/connect.php';
$day = date("d");
$month = date("m");
$year = date("Y");
$hora = date("H-i-s");
$fecha = "UPEMOV_" . $day . '_' . $month . '_' . $year . "_(" . $hora . "_hrs).sql";

$tables = array();
$result = SGBD::sql('SHOW TABLES');

if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }

    $sql = 'SET FOREIGN_KEY_CHECKS=0;' . "\n\n";
    $sql .= 'CREATE DATABASE IF NOT EXISTS ' . BD . ";\n\n";
    $sql .= 'USE ' . BD . ";\n\n";

    foreach ($tables as $table) {
        $result = SGBD::sql('SELECT * FROM ' . $table);
        if ($result) {
            $numFields = mysqli_num_fields($result);
            $sql .= 'DROP TABLE IF EXISTS ' . $table . ';';
            $row2 = mysqli_fetch_row(SGBD::sql('SHOW CREATE TABLE ' . $table));
            $sql .= "\n\n" . $row2[1] . ";\n\n";

            while ($row = mysqli_fetch_row($result)) {
                $sql .= 'INSERT INTO ' . $table . ' VALUES(';
                for ($j = 0; $j < $numFields; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n", "\\n", $row[$j]);
                    $sql .= isset($row[$j]) ? '"' . $row[$j] . '"' : '""';
                    $sql .= ($j < ($numFields - 1)) ? ',' : '';
                }
                $sql .= ");\n";
            }
            $sql .= "\n\n\n";
        }
    }

    $sql .= 'SET FOREIGN_KEY_CHECKS=1;';
    $backupPath = BACKUP_PATH . $fecha;
    if (file_put_contents($backupPath, $sql)) {
        header('Content-Type: application/sql');
        header('Content-Disposition: attachment; filename="' . $fecha . '"');
        readfile($backupPath);
        unlink($backupPath); // Elimina el archivo temporal del servidor
        exit;
    } else {
        echo 'Error al crear la copia de seguridad';
    }
} else {
    echo 'Error inesperado al obtener las tablas';
}
mysqli_free_result($result);

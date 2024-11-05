<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function insertarVehiculo($conn, $idconductor, $marca, $modelo, $anio, $placas, $color) {
    // Comprobar que la conexión es válida
    if ($conn === false) {
        echo "Error en la conexión a la base de datos.";
        return false;
    }
    if (empty($marca) || empty($modelo) || empty($anio) || empty($placas) || empty($color)) {
        echo "Todos los campos son obligatorios.";
        return false;
    }

    $sql = "INSERT INTO vehiculos (idconductor, marca, modelo, anio, placas, color) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        // Convertir $anio a entero
        $anio = (int) $anio;

        // Vincular los parámetros (tipo: i = integer, s = string)
        mysqli_stmt_bind_param($stmt, "ississ", $idconductor, $marca, $modelo, $anio, $placas, $color);
        
        // Ejecutar la declaración
        $execute = mysqli_stmt_execute($stmt);
        
        if (!$execute) {
            echo "Error al ejecutar la declaración: " . mysqli_stmt_error($stmt);
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
        
        return $execute; 
    } else {
        echo "Error al preparar la declaración: " . mysqli_error($conn);
        return false;
    }
}
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function insertarVehiculo($conn, $idconductor, $marca, $modelo, $anio, $placas, $color) {
    // Comprobar que la conexión es válida
    if ($conn === false) {
        return "Error en la conexión a la base de datos.";
    }
    
    // Verificar si las placas ya existen
    $sql = "SELECT * FROM vehiculos WHERE placas = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $placas);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        // Si ya existe un vehículo con las mismas placas
        return "Las placas ya están registradas. Intenta con otras.";
    }

    // Si no está duplicado, proceder con el registro
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
        
        // Cerrar la declaración
        mysqli_stmt_close($stmt);
        
        return $execute; 
    } else {
        return "Error al preparar la declaración: " . mysqli_error($conn);
    }
}

?>

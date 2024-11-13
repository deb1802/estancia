<?php
session_start();

include "../model/db.php"; 
include "../model/insert_disponibilidad.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idconductor = $_POST['idConductor'];
    $dia = $_POST['dia'];
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];
    if (empty($idconductor)) {
        echo "Por favor ingrese el ID del conductor.";
        exit();
    }
    if (!empty($dia) && !empty($horaInicio) && !empty($horaFin)) {
        // Llamar a la función para insertar la disponibilidad
        $execute = insertarDisponibilidad($conn, $idconductor, $dia, $horaInicio, $horaFin);

        if ($execute) {
            echo "Disponibilidad registrada exitosamente.";
            header("Location:../../../view/disponibilidad/crud_disponibilidad.php"); 
            exit(); 
        } else {
            echo "Error al registrar la disponibilidad.";
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
} else {
    echo "Método no permitido.";
}

// Cerrar la conexión
mysqli_close($conn);
?>

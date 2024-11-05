<?php 
session_start();
var_dump($_SESSION); // Ver contenido de la sesión

include "../model/db.php"; 
include "../model/insert_disponibilidad.php"; 

if (!isset($_SESSION['id_conductor'])) {
    echo "No has iniciado sesión. Por favor, inicia sesión primero.";
    exit();
}

$idconductor = $_SESSION['id_conductor']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dia = $_POST['dia'];
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];

    // Verificar que los campos no estén vacíos
    if (!empty($dia) && !empty($horaInicio) && !empty($horaFin)) {
        // Llamar a la función para insertar la disponibilidad
        $execute = insertarDisponibilidad($conn, $idconductor, $dia, $horaInicio, $horaFin);

        if ($execute) {
            echo "Disponibilidad registrada exitosamente.";
            header("Location:../view/conductor/menu_conductor.php"); 
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
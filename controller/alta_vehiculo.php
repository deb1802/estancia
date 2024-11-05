<?php 
session_start();
//var_dump($_SESSION);

include "../model/db.php"; 
include "../model/insert_vehiculo.php"; 

if (!isset($_SESSION['id_conductor'])) {
    echo "No has iniciado sesión. Por favor, inicia sesión primero.";
    exit();
}

$idconductor = $_SESSION['id_conductor']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $pla = $_POST['placas'];
    $color = $_POST['color'];

    // que los campos no estén vacíos
    if (!empty($marca) && !empty($modelo) && !empty($anio) && !empty($pla) && !empty($color)) {
        // Llamar a la función para insertar el vehículo
        $execute = insertarVehiculo($conn, $idconductor, $marca, $modelo, $anio, $pla, $color);

        if ($execute) {
            echo "Registro exitoso.";
            header("Location:../view/conductor/menu_conductor.php"); 
            exit(); 
        } else {
            echo "Error al registrar el vehículo.";
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

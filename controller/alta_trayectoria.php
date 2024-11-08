<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';
var_dump($_POST);

// Verificar si el conductor está logueado
if (!isset($_SESSION['id_conductor'])) {
    echo "No has iniciado sesión. Por favor, inicia sesión primero.";
    exit();
}

// Obtener los datos del formulario
$idConductor = $_SESSION['id_conductor'];  // Obtener el id del conductor desde la sesión
$idVehiculo = $_POST['idVehiculo'];  // Obtener el id del vehículo seleccionado
$capacidad = $_POST['capacidad'];  // Obtener la capacidad
$origen = $_POST['origen_seleccionado'];  // Obtener el origen seleccionado
$destino = $_POST['destino_seleccionado'];  // Obtener el destino seleccionado
$referencias = isset($_POST['referencias']) ? $_POST['referencias'] : null;  // Obtener las referencias (opcional)
$pago = $_POST['pago'];

if (empty($idVehiculo) || empty($capacidad) || empty($origen) || empty($destino) || empty($pago)) {
    echo "Todos los campos son obligatorios.";
    exit();
}

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "INSERT INTO trayectorias (idConductor, idVehiculo, capacidad, origen, destino, referencias, pago) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("iiissss", $idConductor, $idVehiculo, $capacidad, $origen, $destino, $referencias, $pago);

if ($stmt->execute()) {
    echo "Trayectoria registrada exitosamente.";
    // Redirigir a otra página si es necesario
    header("Location: ../view/conductor/menu_conductor.php");
} else {
    echo "Error al registrar la trayectoria: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>

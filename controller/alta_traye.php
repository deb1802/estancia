<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';

// Verificar si el conductor está logueado
if (!isset($_SESSION['id_conductor'])) {
    echo "No has iniciado sesión. Por favor, inicia sesión primero.";
    exit();
}

// Obtener los datos del formulario
$idConductor = $_SESSION['id_conductor'];
$idVehiculo = $_POST['idVehiculo'];
$capacidad = $_POST['capacidad'];
$origen = $_POST['origen_seleccionado'];
$destino = $_POST['destino_seleccionado'];
$referencias = isset($_POST['referencias']) ? $_POST['referencias'] : null;
$pago = $_POST['pago'];

// Validar campos requeridos
if (empty($idVehiculo) || empty($capacidad) || empty($origen) || empty($destino) || empty($pago)) {
    echo "Todos los campos son obligatorios.";
    exit();
}

// Obtener las coordenadas de origen y destino desde el formulario (en formato latitud, longitud)
$origen_coords = isset($_POST['lat_origen']) && isset($_POST['lon_origen']) ? "POINT(" . $_POST['lat_origen'] . ", " . $_POST['lon_origen'] . ")" : null;
$destino_coords = isset($_POST['lat_destino']) && isset($_POST['lon_destino']) ? "POINT(" . $_POST['lat_destino'] . ", " . $_POST['lon_destino'] . ")" : null;

// Validar si las coordenadas están presentes
if (empty($origen_coords) || empty($destino_coords)) {
    echo "Las coordenadas de origen y destino son necesarias.";
    exit();
}

// Verificar conexión a la base de datos
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta SQL para insertar la trayectoria con coordenadas
$sql = "INSERT INTO trayectorias2 (idConductor, idVehiculo, capacidad, origen, destino, referencias, pago, origen_coords, destino_coords) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ST_GeomFromText(?), ST_GeomFromText(?))";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("iiissssss", $idConductor, $idVehiculo, $capacidad, $origen, $destino, $referencias, $pago, $origen_coords, $destino_coords);

if ($stmt->execute()) {
    echo "Trayectoria registrada exitosamente.";
    header("Location: ../view/conductor/menu_conductor.php");
    exit();
} else {
    echo "Error al registrar la trayectoria: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

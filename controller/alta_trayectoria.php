<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';

// Verificar si el conductor está logueado
if (!isset($_SESSION['id_conductor'])) {
    echo "No has iniciado sesión. Por favor, inicia sesión primero.";
    exit();
}


// Obtener los datos del formulario
$idConductor = $_SESSION['id_conductor'];  // Obtener el id del conductor desde la sesión
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

// Verificar conexión a la base de datos
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta SQL para insertar la trayectoria
$sql = "INSERT INTO trayectorias1 (idConductor, idVehiculo, capacidad, origen, destino, referencias, pago) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("iiissss", $idConductor, $idVehiculo, $capacidad, $origen, $destino, $referencias, $pago);

// Ejecutar la consulta y verificar si se insertó correctamente
if ($stmt->execute()) {
    echo "Trayectoria registrada exitosamente.";
    header("Location: ../view/conductor/menu_conductor.php");
    exit();  // Termina el script después de la redirección
} else {
    echo "Error al registrar la trayectoria: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

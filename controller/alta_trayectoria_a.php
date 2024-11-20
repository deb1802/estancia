<?php
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';
$idConductor = $_POST['idConductor'];  
if (empty($idConductor)) {
    echo "Por favor, selecciona un conductor.";
    exit();
}

// Obtener los datos del formulario
$idVehiculo = $_POST['idVehiculo'];
$capacidad = $_POST['capacidad'];
$origen = $_POST['origen'];
$destino = $_POST['destino'];
$referencias = $_POST['referencias'];
$pago = $_POST['pago'];

// Verificar si los datos obligatorios están presentes
if (empty($idVehiculo) || empty($capacidad) || empty($origen) || empty($destino) || empty($pago)) {
    echo "Por favor, completa todos los campos obligatorios.";
    exit();
}

// Preparar la consulta SQL para insertar los datos en la tabla trayectorias2
$sql = "INSERT INTO trayectorias2 (idConductor, idVehiculo, capacidad, origen, destino, referencias, pago) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

// Preparar la sentencia
$stmt = $conn->prepare($sql);

// Verificar si la sentencia fue preparada correctamente
if ($stmt === false) {
    echo "Error al preparar la consulta: " . $conn->error;
    exit();
}

// Vincular los parámetros a la sentencia
$stmt->bind_param("iiissss", $idConductor, $idVehiculo, $capacidad, $origen, $destino, $referencias, $pago);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Redirigir al formulario con un mensaje de éxito
    header("Location: ../../../../estancia/view/trayectoria/crud_trayectoria.php");
    exit();
} else {
    echo "Error al registrar la trayectoria: " . $stmt->error;
}

// Cerrar la sentencia y la conexión
$stmt->close();
$conn->close();
?>

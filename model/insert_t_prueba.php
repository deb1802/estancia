<?php
// Iniciar sesión para acceder a las variables de sesión
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';

// Verificar si el conductor está logueado
if (!isset($_SESSION['id_conductor'])) {
    echo json_encode(["success" => false, "message" => "No has iniciado sesión. Por favor, inicia sesión primero."]);
    exit();
}

// Obtener el ID del conductor desde la sesión
$idConductor = $_SESSION['id_conductor'];

// Verificar si se recibieron las coordenadas del cliente
if (isset($_POST['lat_origen'], $_POST['lon_origen'], $_POST['lat_destino'], $_POST['lon_destino'], $_POST['origen_seleccionado'], $_POST['destino_seleccionado'])) {
    $lat_origen = $_POST['lat_origen'];
    $lon_origen = $_POST['lon_origen'];
    $lat_destino = $_POST['lat_destino'];
    $lon_destino = $_POST['lon_destino'];
    $origen = $_POST['origen_seleccionado'];
    $destino = $_POST['destino_seleccionado'];
    $referencias = $_POST['referencias'];
    $idVehiculo = $_POST['idVehiculo'];
    $capacidad = $_POST['capacidad'];
    $pago = $_POST['pago'];

    // Validar coordenadas de origen y destino
    if (!is_numeric($lat_origen) || !is_numeric($lon_oigen) || !is_numeric($lat_destino) || !is_numeric($lon_destino)) {
        echo json_encode(["success" => false, "message" => "Error: Las coordenadas deben ser valores numéricos."]);
        exit();
    }

    if ($lat_origen < -90 || $lat_origen > 90 || $lon_origen < -180 || $lon_origen > 180 ||
        $lat_destino < -90 || $lat_destino > 90 || $lon_destino < -180 || $lon_destino > 180) {
        echo json_encode(["success" => false, "message" => "Error: Las coordenadas están fuera de rango."]);
        exit();
    }

    // Usar sentencias preparadas para insertar los datos de forma segura
    $stmt = $conn->prepare("INSERT INTO trayectorias (origen, destino, lat_origen, lon_origen, lat_destino, lon_destino, referencias, idVehiculo, capacidad, pago, idConductor) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $origen, $destino, $lat_origen, $lon_origen, $lat_destino, $lon_destino, $referencias, $idVehiculo, $capacidad, $pago, $idConductor);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Trayectoria registrada con éxito."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al registrar la trayectoria: " . $stmt->error]);
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Error: No se han recibido las coordenadas."]);
}
?>

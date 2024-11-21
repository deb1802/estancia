<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';
if (!isset($_SESSION['id_conductor'])) {
    echo "No has iniciado sesión. Por favor, inicia sesión primero.";
    exit();
}

// Obtener el id del conductor desde la sesión
$idConductor = $_SESSION['id_conductor'];

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

$sql = "INSERT INTO trayectorias2 (idConductor, idVehiculo, capacidad, origen, destino, referencias, pago) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
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
    echo "La trayectoria ha sido registrada correctamente.";
    // Agregar redirección con JavaScript
    echo '<script>
            setTimeout(function() {
                window.location.href = "../view/trayectoria/ver_trayectoria.php";
            }, 3000); // Redirigir después de 3 segundos
          </script>';
} else {
    echo "Error al registrar la trayectoria: " . $stmt->error;
}

// Cerrar la sentencia y la conexión
$stmt->close();
$conn->close();
?>

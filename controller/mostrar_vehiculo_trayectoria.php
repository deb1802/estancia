<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';


// Verificar si el conductor está logueado
if (!isset($_SESSION['id_conductor'])) {
    echo "No has iniciado sesión. Por favor, inicia sesión primero.";
    exit();
}

$idConductor = $_SESSION['id_conductor'];  // Obtener el id del conductor desde la sesión


if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta SQL para obtener los vehículos del conductor
$sql = "SELECT * FROM vehiculos WHERE idConductor = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $idConductor);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

// Verificar si el conductor tiene vehículos
if (!$result) {
    die("Error al ejecutar la consulta: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 0) {
    echo "No tienes vehículos registrados.";
    exit();
}

// Recuperar los vehículos para mostrarlos en el formulario
$vehiculos = [];
while ($row = mysqli_fetch_assoc($result)) {
    $vehiculos[] = $row;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>

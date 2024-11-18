<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';

// Verificar si la conexión es exitosa
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta SQL para obtener todos los vehículos registrados
$sqlVehiculos = "SELECT * FROM vehiculos";
$stmtVehiculos = mysqli_prepare($conn, $sqlVehiculos);

if (!$stmtVehiculos) {
    die("Error en la preparación de la consulta de vehículos: " . mysqli_error($conn));
}

mysqli_stmt_execute($stmtVehiculos);
$resultVehiculos = mysqli_stmt_get_result($stmtVehiculos);

// Verificar si hay vehículos registrados
if (!$resultVehiculos) {
    die("Error al ejecutar la consulta de vehículos: " . mysqli_error($conn));
}

if (mysqli_num_rows($resultVehiculos) == 0) {
    echo "No hay vehículos registrados.";
    exit();
}

// Recuperar todos los vehículos para mostrarlos en el formulario
$vehiculos = [];
while ($row = mysqli_fetch_assoc($resultVehiculos)) {
    $vehiculos[] = $row;
}

// Consulta SQL para obtener todos los usuarios con tipo 'conductor'
$sqlUsuarios = "SELECT * FROM usuarios WHERE tipo = 'conductor'";
$stmtUsuarios = mysqli_prepare($conn, $sqlUsuarios);

if (!$stmtUsuarios) {
    die("Error en la preparación de la consulta de usuarios: " . mysqli_error($conn));
}

mysqli_stmt_execute($stmtUsuarios);
$resultUsuarios = mysqli_stmt_get_result($stmtUsuarios);

// Verificar si hay conductores registrados
if (!$resultUsuarios) {
    die("Error al ejecutar la consulta de usuarios: " . mysqli_error($conn));
}

if (mysqli_num_rows($resultUsuarios) == 0) {
    echo "No hay conductores registrados.";
    exit();
}

// Recuperar todos los usuarios conductores
$conductores = [];
while ($row = mysqli_fetch_assoc($resultUsuarios)) {
    $conductores[] = $row;
}

mysqli_stmt_close($stmtVehiculos);
mysqli_stmt_close($stmtUsuarios);
mysqli_close($conn);
?>

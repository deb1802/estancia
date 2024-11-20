<?php
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';

// Verificar si la conexión es exitosa
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta SQL para obtener todos los usuarios con tipo 'conductor' y 'alumno'
$sqlUsuarios = "SELECT * FROM usuarios WHERE tipo IN ('conductor', 'alumno')";
$stmtUsuarios = mysqli_prepare($conn, $sqlUsuarios);

if (!$stmtUsuarios) {
    die("Error en la preparación de la consulta de usuarios: " . mysqli_error($conn));
}

mysqli_stmt_execute($stmtUsuarios);
$resultUsuarios = mysqli_stmt_get_result($stmtUsuarios);

// Verificar si hay usuarios registrados
if (!$resultUsuarios) {
    die("Error al ejecutar la consulta de usuarios: " . mysqli_error($conn));
}

if (mysqli_num_rows($resultUsuarios) == 0) {
    echo "No hay usuarios registrados de tipo 'conductor' o 'alumno'.";
    exit();
}

// Recuperar todos los usuarios de tipo 'conductor' y 'alumno'
$usuarios = [];
while ($row = mysqli_fetch_assoc($resultUsuarios)) {
    $usuarios[] = $row;
}

mysqli_stmt_close($stmtUsuarios);
mysqli_close($conn);

// Ahora puedes usar el arreglo $usuarios con los datos de los usuarios 'conductor' y 'alumno'
?>

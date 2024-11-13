<?php
include "db.php";

function obtenerConductoresDisponibles($conn) {
    $sql = "SELECT id, nombre, apellido FROM usuarios WHERE tipo = 'conductor';";
    return mysqli_query($conn, $sql);
}

function obtenerVehiculosRegistrados($conn) {
    $sql = "SELECT * FROM vehiculos;";
    return mysqli_query($conn, $sql);
}
?>

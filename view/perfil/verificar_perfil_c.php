<?php
include('../../model/db.php'); 
//include '../alumno/header_alumno.php';
session_start();
$idAlumno = $_SESSION['id_conductor'];
$query = "SELECT * FROM perfiles WHERE idAlumno = '$idAlumno'"; 
$result = mysqli_query($conn, $query);
$userData = mysqli_fetch_assoc($result);
mysqli_close($conn);
if (!$userData) {
    // Mostrar formulario de creación de perfil
    include('crearmiperfilconductor.php');
} else {
    // Mostrar perfil existente
    include('mostrarperfil_c.php');
}
?>
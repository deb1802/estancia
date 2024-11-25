<?php
session_start();
include('../../model/db.php'); 
if (!isset($_SESSION['idAlumno'])) {
    echo "<script>
        alert('No has iniciado sesión. Por favor, inicia sesión.');
        //window.location.href = '../login.php'; 
    </script>";
    exit();
}
$idAlumno = $_SESSION['idAlumno'];
$query = "SELECT * FROM perfiles WHERE idAlumno = '$idAlumno'"; 
$result = mysqli_query($conn, $query);
$userData = mysqli_fetch_assoc($result);
mysqli_close($conn);

// Si no se encuentra el perfil, mostrar el formulario para crear uno
if (!$userData) {
    // Mostrar formulario de creación de perfil
    include('crearmiperfil.php');
} else {
    // Mostrar perfil existente
    include('mostrarperfil.php');
}
?> 
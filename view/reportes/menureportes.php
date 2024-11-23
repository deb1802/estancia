<?php 
include "../admin/header_admin.php";
session_start();

if (isset($_SESSION['usuario'])) {
    $nombre = $_SESSION['nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administrativo</title>
    <link rel="stylesheet" href="../../public/css/menureportes.css">
</head>
<body>
    <div class="dashboard">
        <header class="dashboard-header">
            <div class="profile-section">
                <img src="../../public/img/excel.png" alt="Imagen de perfil" class="profile-img">
                <div>
                    <h2>Reportes</h2>
                    <h3>Selecciona una opción para generar el reporte</h3>
                </div>
            </div>
        </header>

        <main class="dashboard-content">
            <div class="dashboard-option" onclick="navigateTo('reporte1')">
                <img src="../../public/img/taxi.png" alt="reporte1">
                <span>Total de viajes por alumno</span>
            </div>
            <div class="dashboard-option" onclick="navigateTo('reporte2')">
                <img src="../../public/img/capacidad.png" alt="reporte2">
                <span>Ocupación de vehículos por capacidad</span>
            </div>
            <div class="dashboard-option" onclick="navigateTo('reporte3')">
                <img src="../../public/img/car2.png" alt="reporte3">
                <span>Uso de vehículos por conductor</span>
            </div>
            <div class="dashboard-option" onclick="navigateTo('reporte4')">
                <img src="../../public/img/query.png" alt="reporte4">
                <span>Solicitudes aceptadas y rechazadas</span>
            </div>
            <div class="dashboard-option" onclick="navigateTo('reporte5')">
                <img src="../../public/img/tm.png" alt="reporte5">
                <span>Vehículos más registrados</span>
            </div>
        </main>
    </div>
    <script src="../../public/js/menureportes.js"></script>
</body>
</html>
<?php
} else {
    header("Location: login.php");
}
?>

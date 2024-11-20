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
            <div class="dashboard-option" onclick="navigateTo('usuarios')">
                <img src="../../public/img/users.png" alt="Usuarios">
                <span>Usuarios</span>
            </div>
            <div class="dashboard-option" onclick="navigateTo('disponibilidades')">
                <img src="../../public/img/calendar-month.svg" alt="Disponibilidades">
                <span>Disponibilidades</span>
            </div>
            <div class="dashboard-option" onclick="navigateTo('trayectorias')">
                <img src="../../public/img/map.png" alt="Trayectorias">
                <span>Trayectorias</span>
            </div>
            <div class="dashboard-option" onclick="navigateTo('avisos')">
                <img src="../../public/img/avisos.png" alt="avisos">
                <span>Avisos</span>
            </div>
            <div class="dashboard-option" onclick="navigateTo('perfiles')">
                <img src="../../public/img/perfiles.png" alt="perfiles">
                <span>Perfiles</span>
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

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
    <title>Dashboard Administrador</title>
    <link rel="stylesheet" href="../../public/css/menuadmin.css">
</head>
<body>
    <?php include "header_admin.php"; ?>
    <div class="dashboard">
        <header class="dashboard-header">
            <div class="profile-section">
                <img src="../../public/img/administrador.png" alt="Imagen de perfil" class="profile-img">
                <div>
                    <h2>Bienvenido(a), <?php echo htmlspecialchars($nombre); ?></h2>
                    <h3>¿Qué deseas gestionar?</h3>
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
            <div class="dashboard-option" onclick="navigateTo('vehiculos')">
                <img src="../../public/img/cars.png" alt="vehiculos">
                <span>Vehículos</span>
            </div>
            <div class="dashboard-option" onclick="navigateTo('reportes')">
                <img src="../../public/img/reporte.png" alt="reportes">
                <span>Reportes</span>
            </div>
            <div class="dashboard-option" onclick="navigateTo('bd')">
                <img src="../../public/img/bd.png" alt="bd">
                <span>Base de datos</span>
            </div>
        </main>
    </div>
    <script src="../../public/js/menuadmin.js"></script>
</body>
</html>
<?php
} else {
    header("Location: login.php");
}
?>

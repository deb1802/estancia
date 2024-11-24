<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Conductor</title>
    <link rel="stylesheet" href="../../public/css/menu_conductor.css">
</head>
<body>
    <?php include "header_conductor.php"; ?>
    <?php
    session_start();
    if (isset($_SESSION['usuario'])) {
        $nombre = $_SESSION['nombre'];
    ?>
        <div class="dashboard">
            <header class="dashboard-header">
                <div class="profile-section">
                    <img src="../../public/img/conductor.png" alt="Imagen de perfil" class="profile-img">
                    <div>
                        <h2>Hola, <?php echo htmlspecialchars($nombre); ?></h2>
                        <h3>Bienvenido(a) a tu panel de conductor</h3>
                    </div>
                </div>
            </header>

            <main class="dashboard-content">
                <div class="dashboard-option" onclick="navigateTo('vehiculo')">
                    <img src="../../public/img/cari.png" alt="Vehículo">
                    <span>Registrar nuevo vehículo</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('mis-vehiculos')">
                    <img src="../../public/img/cars.png" alt="Mis Vehículos">
                    <span>Mis vehículos</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('disponibilidad')">
                    <img src="../../public/img/calendar-month.svg" alt="Disponibilidad">
                    <span>Registrar disponibilidad</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('mis-disponibilidades')">
                    <img src="../../public/img/clock.png" alt="Mis Disponibilidades">
                    <span>Mis disponibilidades</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('trayectoria')">
                    <img src="../../public/img/route-x.svg" alt="Trayectorias">
                    <span>Registrar nueva trayectoria</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('mis-trayectorias')">
                    <img src="../../public/img/map.png" alt="Mis Trayectorias">
                    <span>Mis trayectorias</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('mis-solicitudes')">
                    <img src="../../public/img/request.png" alt="Mis Solicitudes">
                    <span>Ver mis solicitudes</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('perfiles')">
                    <img src="../../public/img/perfiles.png" alt="perfiles">
                    <span>Ver perfiles</span>
                </div>
            </main>
        </div>
    <?php
    } else {
        header("Location: login.php");
    }
    ?>
    <script src="../../public/js/menu_conduc.js"></script>
</body>
</html>

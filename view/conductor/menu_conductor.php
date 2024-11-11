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
        $user = $_SESSION['usuario'];
    ?>
        <div class="dashboard">
            <header class="dashboard-header">
                <div class="profile-section">
                    <img src="../../public/img/conductor.png" alt="Imagen de perfil" class="profile-img">
                    <div>
                        <h2>Hola, <?php echo htmlspecialchars($user); ?>!</h2>
                        <h3>Bienvenido a tu panel de conductor</h3>
                    </div>
                </div>
            </header>

            <main class="dashboard-content">
                <div class="dashboard-option" onclick="navigateTo('vehiculo')">
                    <img src="../../public/img/cari.png" alt="Vehículo">
                    <span>Vehículo</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('mis-vehiculos')">
                    <img src="my-cars-icon.png" alt="Mis Vehículos">
                    <span>Mis Vehículos</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('disponibilidad')">
                    <img src="../../public/img/calendar-month.svg" alt="Disponibilidad">
                    <span>Disponibilidad</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('mis-disponibilidades')">
                    <img src="my-availability-icon.png" alt="Mis Disponibilidades">
                    <span>Mis Disponibilidades</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('trayectoria')">
                    <img src="../../public/img/route-x.svg" alt="Mis Disponibilidades">
                    <span>Trayectorias</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('mis-trayectorias')">
                    <img src="../../public/img/route-x.svg" alt="Mis Disponibilidades">
                    <span>Mis Trayectorias</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('mis-solicitudes')">
                    <img src="../../public/img/route-x.svg" alt="Mis Disponibilidades">
                    <span>Mis solis</span>
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

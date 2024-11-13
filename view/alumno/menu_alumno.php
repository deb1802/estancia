<?php include "../alumno/header_alumno.php"; ?>
<?php
session_start();
if (isset($_SESSION['usuario'])) {
    $user = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Conductor</title>
    <link rel="stylesheet" href="../../public/css/menu_conductor.css">
</head>
<body>
    <?php include "header_alumno.php"; ?>
    <?php
    if (isset($_SESSION['usuario'])) {
        $nombre = $_SESSION['nombre'];
    ?>
        <div class="dashboard">
            <header class="dashboard-header">
                <div class="profile-section">
                    <img src="../../public/img/alumno.png" alt="Imagen de perfil" class="profile-img">
                    <div>
                        <h2>Hola, <?php echo htmlspecialchars($nombre); ?></h2>
                        <h3>Bienvenido(a) a tu panel de alumno</h3>
                    </div>
                </div>
            </header>

            <main class="dashboard-content">
                <div class="dashboard-option" onclick="navigateTo('trayectorias')">
                    <img src="../../public/img/route-x.svg" alt="Mis Disponibilidades">
                    <span>Trayectorias Disponibles</span>
                </div>
                <div class="dashboard-option" onclick="navigateTo('solicitudes')">
                    <img src="../../public/img/route-x.svg" alt="Mis Disponibilidades">
                    <span>Solicitudes</span>
                </div>
            </main>
        </div>
    <?php
    } else {
        header("Location: login.php");
    }
    ?>
    <script src="../../public/js/menu_alumno.js"></script>
</body>
</html>

    </article>
<?php
} else {
    header("Location: login.php");
}
?>

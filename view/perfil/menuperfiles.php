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
    <link rel="stylesheet" href="../../public/css/menuperfiles.css">
</head>
<body>
    <div class="dashboard">
        <header class="dashboard-header">
            <div class="profile-section">
                <img src="../../public/img/user2.png" alt="Imagen de perfil" class="profile-img">
                <div>
                    <h2>Perfiles</h2>
                    <h3>Selecciona una opción</h3>
                </div>
            </div>
        </header>

        <main class="dashboard-content">
            <div class="dashboard-option" onclick="navigateTo('reporte1')">
                <img src="../../public/img/uadd.png" alt="reporte1">
                <span>Crear un nuevo perfil</span>
            </div>
            <div class="dashboard-option" onclick="navigateTo('reporte2')">
                <img src="../../public/img/uset.png" alt="reporte2">
                <span>Ver, editar y eliminar perfiles existentes</span>
            </div>
        </main>
    </div>
    <script src="../../public/js/menuperfiles.js"></script>
</body>
</html>
<?php
} else {
    header("Location: login.php");
}
?>

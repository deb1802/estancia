<?php 
include "../admin/header_admin.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de datos</title>
    <link rel="stylesheet" href="../../public/css/menutrayectoria.css">
</head>
<body>
    <div class="dashboard">
        <header class="dashboard-header">
            <div class="profile-section">
                <img src="../../public/img/travel.png" alt="Imagen de perfil" class="profile-img">
                <div>
                    <h2>Trayectorias</h2>
                    <h3>Selecciona una opción:</h3>
                </div>
            </div>
        </header>
        <main class="dashboard-content">
            <div class="dashboard-option" onclick="navigateTo('crear')">
                <img src="../../public/img/waypoint.png" alt="crear">
                <span>Crear una nueva trayectoria</span>
            </div>
            <div class="dashboard-option" onclick="navigateTo('veet')">
                <img src="../../public/img/mapedit.png" alt="veet">
                <span>Ver, editar y eliminar trayectorias existentes</span>
            </div>
        </main>
    </div>
    <script src="../../public/js/menutrayectoria.js"></script>
    <script>
        function submitRestoreForm() {
            const form = document.getElementById('restoreForm');
            form.submit();
        }
    </script>
</body>
</html>

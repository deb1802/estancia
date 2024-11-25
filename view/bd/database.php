<?php 
include "../admin/header_admin.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de datos</title>
    <link rel="stylesheet" href="../../public/css/database.css">
</head>
<body>
    <div class="dashboard">
        <header class="dashboard-header">
            <div class="profile-section">
                <img src="../../public/img/sql.png" alt="Imagen de perfil" class="profile-img">
                <div>
                    <h2>Base de datos</h2>
                    <h3>Selecciona una opción</h3>
                </div>
            </div>
        </header>
        <main class="dashboard-content">
            <!-- Opción para respaldar la base de datos -->
            <div class="dashboard-option" onclick="navigateTo('respaldar')">
                <img src="../../public/img/backup.png" alt="respaldar">
                <span>Respaldar</span>
            </div>
            <!-- Opción para restaurar la base de datos -->
            <div class="dashboard-option">
                <form id="restoreForm" action="../../controller/restore.php" method="POST" enctype="multipart/form-data">
                    <!-- Formulario para restaurar desde un archivo .sql -->
                    <label for="restoreFile">
                        <img src="../../public/img/restore.png" alt="restaurar">
                        <span>Restaurar</span>
                    </label>
                    <input type="file" id="restoreFile" name="restoreFile" accept=".sql" style="display: none;" onchange="submitRestoreForm()"> <!-- Input para archivo .sql -->
                </form>
            </div>
        </main>
    </div>
    <script src="../../public/js/database.js"></script>
    <script>
        // Función que envía el formulario de restauración al seleccionar el archivo
        function submitRestoreForm() {
            const form = document.getElementById('restoreForm');
            form.submit(); // Enviar el formulario
        }
    </script>
</body>
</html>

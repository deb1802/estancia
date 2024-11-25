<link href="../../public/css/perfiles.css" rel="stylesheet">
<?php
include('../../model/buscar_perfiles.php'); 
include '../alumno/header_alumno.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfiles de Usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Barra de búsqueda dinámica -->
        <div class="search-bar">
            <input type="text" id="busqueda" placeholder="Buscar perfiles..." onkeyup="filtrarPerfiles()">
            <select id="filtro" onchange="filtrarPerfiles()">
                <option value="0">Nombre de usuario</option>
                <option value="1">Matrícula</option>
                <option value="2">Teléfono</option>
                <option value="3">Viajes</option>
            </select>
        </div>

        <div class="row" id="perfiles">
            <?php
            // Mostrar perfiles
            if (!empty($profiles)) {
                foreach ($profiles as $profile) {
                    $imagePath = !empty($profile['imagen']) ? '../' . htmlspecialchars($profile['imagen']) : '../../public/img/perfil.svg';

                    echo '
                    <div class="col-md-4 col-sm-6 perfil-item">
                        <div class="card profile-card">
                            <div class="card-header">
                                <h4 class="nombreUser">@' . htmlspecialchars($profile['nombreUser']) . '</h4>
                            </div>
                            <div class="card-body">
                                <img src="' . $imagePath . '" alt="Foto de perfil">
                                <p class="profile-info matricula">Matrícula: ' . htmlspecialchars($profile['matricula']) . '</p>
                                <p class="profile-info telefono">Teléfono: ' . htmlspecialchars($profile['telefono']) . '</p>
                                <p class="profile-info informacion">Información: ' . htmlspecialchars($profile['informacion']) . '</p>
                                <p class="viajes"><i class="fas fa-car"></i> Viajes realizados: ' . htmlspecialchars($profile['viajes']) . '</p>
                                <i class="fas fa-heart like-btn" id="like_' . $profile['id'] . '"></i>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p class="text-center">No se encontraron perfiles que coincidan con el término de búsqueda.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Scripts de JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function filtrarPerfiles() {
            const busqueda = document.getElementById('busqueda').value.toLowerCase();
            const filtro = document.getElementById('filtro').value;
            const perfiles = document.querySelectorAll('.perfil-item');

            perfiles.forEach(perfil => {
                const datos = [
                    perfil.querySelector('.nombreUser').textContent.toLowerCase(),
                    perfil.querySelector('.matricula').textContent.toLowerCase(),
                    perfil.querySelector('.telefono').textContent.toLowerCase(),
                    perfil.querySelector('.viajes').textContent.toLowerCase()
                ];

                perfil.style.display = datos[filtro].includes(busqueda) ? '' : 'none';
            });
        }

        // Manejar el clic en el corazón (like)
        $(document).ready(function() {
            $('.like-btn').click(function() {
                $(this).toggleClass('liked'); // Cambiar el color del corazón al darle like
            });
        });
    </script>

</body>
</html>

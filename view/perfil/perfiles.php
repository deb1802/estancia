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
        <!-- Barra de búsqueda -->
        <form method="GET" class="search-bar">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Ingresa un nombre de user..." value="<?php echo htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : ''); ?>">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>

        <div class="row">
            <?php
            // Mostrar perfiles
            if (!empty($profiles)) {
                foreach ($profiles as $profile) {
                    $imagePath = !empty($profile['imagen']) ? '../' . htmlspecialchars($profile['imagen']) : '../../public/img/perfil.svg';

                    echo '
                    <div class="col-md-4 col-sm-6">
                        <div class="card profile-card">
                            <div class="card-header">
                                <h4>@' . htmlspecialchars($profile['nombreUser']) . '</h4>
                            </div>
                            <div class="card-body">
                                <img src="' . $imagePath . '" alt="Foto de perfil">
                                <p class="profile-info">Matrícula: ' . htmlspecialchars($profile['matricula']) . '</p>
                                <p class="profile-info">Teléfono: ' . htmlspecialchars($profile['telefono']) . '</p>
                                <p class="profile-info">Información: ' . htmlspecialchars($profile['informacion']) . '</p>
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
        // Manejar el clic en el corazón (like)
        $(document).ready(function() {
            $('.like-btn').click(function() {
                $(this).toggleClass('liked'); // Cambiar el color del corazón al darle like
            });
        });
    </script>
</body>
</html>

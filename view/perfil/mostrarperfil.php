<?php
//include 'verificar_perfil.php';
include '../alumno/header_alumno.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@<?php echo htmlspecialchars($userData['nombreUser']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="../../public/css/perfil.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>@<?php echo htmlspecialchars($userData['nombreUser']); ?></h2>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <!-- Foto de perfil -->
                    <?php
                    if (!empty($userData['imagen'])) {
                        echo '<img id="fotoPerfil" src="../' . htmlspecialchars($userData['imagen']) . '" alt="Foto de Perfil" class="img-thumbnail mb-3">';
                    } else {
                        echo '<img id="fotoPerfil" src="../../public/img/perfil.svg" alt="Foto de Perfil" class="img-thumbnail mb-3">';
                    }
                    ?>
                </div>
                
                <!-- Información del usuario -->
                <div class="form-group">
                    <label>Matrícula:</label>
                    <p class="profile-info" id="matriculaUsuario"><?php echo htmlspecialchars($userData['matricula']); ?></p>
                </div>

                <div class="form-group">
                    <label>Teléfono móvil:</label>
                    <p class="profile-info" id="telefonoUsuario"><?php echo htmlspecialchars($userData['telefono']); ?></p>
                </div>

                <div class="form-group">
                    <label>Información adicional:</label>
                    <p class="profile-info" id="infoUsuario"><?php echo htmlspecialchars($userData['informacion']); ?></p>
                </div>

                <!-- Número de viajes -->
                <div class="form-group">
                    <label>Número de viajes:</label>
                    <div class="profile-info" id="viajesUsuario">
                        <i class="fas fa-car cart-icon"></i> 
                        <span><?php echo htmlspecialchars($userData['viajes']); ?> viajes</span>
                    </div>
                </div>

                <!-- Íconos para Editar y Eliminar -->
                <div class="icon-buttons">
                    <a href="update_perfil.php?idAlumno=<?php echo  $idAlumno; ?>"  class="edit" title="Editar perfil">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="../../controller/delete_perfil.php?idAlumno=<?php echo $idAlumno; ?>" class="delete" title="Eliminar perfil" onclick="return confirm('¿Estás seguro de que deseas eliminar este perfil?');">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Apartado fuera del contenedor para ver otros perfiles -->
    <div class="container mt-5">
        <div class="other-profiles-container">
            <h3><i class="fas fa-users"></i> ¡Conoce más usuarios!</h3>
            <p>Ven a descubrir quién más forma parte de Upemov.</p>
            <a href="perfiles.php" class="btn btn-info">
                Ver perfiles
            </a>
        </div>
    </div>

    <!-- Scripts de JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

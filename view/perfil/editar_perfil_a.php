<?php
// Incluir archivos necesarios
include '../admin/header_admin.php';
include '../../model/actualizar_perfil.php';

// Verificar si el formulario fue enviado con POST o si se accedió mediante GET
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idAlumno'])) {
    $idAlumno = $_POST['idAlumno'];
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idAlumno'])) {
    $idAlumno = $_GET['idAlumno'];
} else {
    die("Datos insuficientes proporcionados.");
}

// Consulta para obtener los datos del usuario
$query = "SELECT * FROM perfiles WHERE idAlumno = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $idAlumno);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontró al usuario
if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    die("Usuario no encontrado.");
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil de Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../public/css/perfil.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Editar Perfil</h2>
            </div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario(event)">
                    <!-- Campo oculto para enviar el ID del alumno -->
                    <input type="hidden" name="idAlumno" value="<?php echo htmlspecialchars($idAlumno); ?>">

                    <!-- Foto de perfil -->
                    <div class="form-group text-center">
                        <img id="fotoPerfil" src="../<?php echo !empty($userData['imagen']) ? htmlspecialchars($userData['imagen']) : '../../public/img/perfil.svg'; ?>" alt="Foto de Perfil" class="img-thumbnail mb-3">
                        <div class="custom-file text-center">
                            <label for="uploadFoto" class="btn btn-info upload-btn">Cambiar Foto</label>
                            <input type="file" id="uploadFoto" name="fotoPerfil" accept="image/*" class="form-control-file" style="display: none;">
                        </div>
                    </div>

                    <!-- Campo de nombre -->
                    <div class="form-group">
                        <label for="nombre">Nombre de usuario:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($userData['nombreUser']); ?>">
                    </div>
                    <p class="alert" id="errorvacioNombre" style="display: none;">Este campo debe estar lleno.</p>
                    <p class="alert" id="errorNombre" style="display: none;">El nombre usuario debe tener mínimo de 3 a 18 caracteres.</p>

                    <!-- Campo de matrícula -->
                    <div class="form-group">
                        <label for="matricula">Matrícula:</label>
                        <input type="text" id="matricula" name="matricula" class="form-control" value="<?php echo htmlspecialchars($userData['matricula']); ?>">
                    </div>
                    <p class="alert" id="errorMatricula" style="display: none;">La matrícula debe contener solo 10 caracteres y sólo se aceptan letras y números.</p>

                    <!-- Campo de teléfono móvil -->
                    <div class="form-group">
                        <label for="cel">Teléfono móvil:</label>
                        <input type="tel" id="cel" name="telefono" class="form-control" value="<?php echo htmlspecialchars($userData['telefono']); ?>">
                    </div>
                    <p class="alert" id="errorTel" style="display: none;">Ingresa un teléfono que contenga 10 dígitos</p>

                    <!-- Campo de información adicional -->
                    <div class="form-group">
                        <label for="info">Información adicional:</label>
                        <textarea id="info" name="informacion" class="form-control" rows="4"><?php echo htmlspecialchars($userData['informacion']); ?></textarea>
                    </div>
                    <p class="alert" id="errorInfo" style="display: none;">Este campo debe estar lleno. No pongas malas palabras.</p>

                    <!-- Botón para guardar los cambios -->
                    <button id="guardar" type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts de JavaScript -->
    <script>
        // Función para mostrar una vista previa de la imagen seleccionada
        document.getElementById('uploadFoto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('fotoPerfil').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script src="../../public/js/validar_perfil.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

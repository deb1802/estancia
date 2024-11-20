<?php 
include '../conductor/header_conductor.php'
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear perfil de usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../public/css/perfil.css" rel="stylesheet">
    <script src="../../public/js/validacion_perfil.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Crea tu perfil de Usuario</h2>
            </div>
            <div class="card-body">
                <!-- Formulario de perfil -->
                <form action="../../controller/alta_perfil_c.php" method="POST" enctype="multipart/form-data" id="perfilForm" onsubmit="validarFormulario(event)">
                    <!-- Foto de perfil -->
                    <div class="form-group text-center">
                        <img id="fotoPerfil" src="../../public/img/perfil.svg" alt="Foto de Perfil" class="img-thumbnail mb-3">
                        <div class="custom-file text-center">
                            <!-- Botón de selección de archivo -->
                            <label for="uploadFoto" class="btn btn-info upload-btn">Seleccionar Foto</label>
                            <input type="file" id="uploadFoto" name="fotoPerfil" accept="image/*" class="form-control-file" style="display: none;">
                        </div>
                    </div>

                    <!-- Campo de nombre -->
                    <div class="form-group">
                        <label for="nombre">Nombre de usuario:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="username">
                    </div>
                    <p class="alert" id="errorvacioNombre" style="display: none;">Este campo debe estar lleno.</p>
                    <p class="alert" id="errorNombre" style="display: none;">El nombre usuario debe tener mínimo de 3 a 18 caracteres.</p>

                    <!-- Campo de matrícula -->
                    <div class="form-group">
                        <label for="matricula">Matrícula:</label>
                        <input type="text" id="matricula" name="matricula" class="form-control" placeholder="Matrícula del usuario">
                    </div>
                    <p class="alert" id="errorMatricula" style="display: none;">La matrícula debe contener solo 10 caracteres y sólo se aceptan letras y números.</p>

                    <!-- Campo de teléfono móvil -->
                    <div class="form-group">
                        <label for="cel">Teléfono móvil:</label>
                        <input type="tel" id="cel" name="telefono" class="form-control" placeholder="Número de celular">
                    </div>
                    <p class="alert" id="errorTel" style="display: none;">Ingresa un teléfono que contenga 10 dígitos</p>

                    <!-- Campo de información adicional -->
                    <div class="form-group">
                        <label for="info">Información adicional:</label>
                        <textarea id="info" name="informacion" class="form-control" rows="4" placeholder="Agrega tu información adicional, no pongas malas palabras."></textarea>
                    </div>
                    <p class="alert" id="errorInfo" style="display: none;">Este campo debe estar lleno. No pongas malas palabras.</p>

                    <!-- Botón de Guardar -->
                    <button id="guardar" type="submit" class="btn btn-primary">Guardar información</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts de JavaScript -->
    <script>
    // Función para actualizar la vista previa de la imagen
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

    <!-- Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

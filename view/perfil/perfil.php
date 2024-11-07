<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace al archivo CSS -->
    <link href="../../public/css/perfil.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Perfil de Usuario</h2>
            </div>
            <div class="card-body">
                <!-- Foto de perfil -->
                <div class="form-group text-center">
                    <img id="fotoPerfil" src="default-profile.png" alt="Foto de Perfil" class="img-thumbnail mb-3">
                    <div class="custom-file text-center">
                        <!-- Botón de selección de archivo -->
                        <label for="uploadFoto" class="btn btn-info upload-btn">Seleccionar Foto</label>
                        <input type="file" id="uploadFoto" accept="image/*" class="form-control-file" style="display: none;">
                    </div>
                </div>

                <!-- Campo de matrícula -->
                <div class="form-group">
                    <label for="matricula">Matrícula:</label>
                    <input type="text" id="matricula" class="form-control" placeholder="Matrícula del usuario" disabled>
                </div>

                <!-- Valoración con estrellas -->
                <div class="form-group">
                    <label>Valoración:</label>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 estrellas">&#9733;</label>
                        <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 estrellas">&#9733;</label>
                        <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 estrellas">&#9733;</label>
                        <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 estrellas">&#9733;</label>
                        <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 estrella">&#9733;</label>
                    </div>
                </div>

                <!-- Campo de cantidad de viajes -->
                <div class="form-group">
                    <label for="viajes">Cantidad de viajes:</label>
                    <input type="number" id="viajes" class="form-control" placeholder="Número de viajes" disabled>
                </div>

                <!-- Campo de comentarios -->
                <div class="form-group">
                    <label for="comentarios">Comentarios:</label>
                    <textarea id="comentarios" class="form-control" rows="4" placeholder="Comentarios del usuario"></textarea>
                </div>

                <!-- Botón de Guardar -->
                <button id="guardar" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>

    <!-- Scripts de JavaScript -->
    <script src="../../public/js/perfil.js"></script>
    <!-- Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

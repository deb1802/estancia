<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Estilo para la imagen de perfil en forma de círculo */
        #profileImagePreview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        /* Estilo para el contenedor del formulario */
        .form-container {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="form-container">
            <h2 class="text-center mb-4">Crear mi perfil</h2>
            <form id="perfilForm" action="submit_form.php" method="POST" enctype="multipart/form-data">

                <!-- Vista previa de la imagen -->
                <div class="text-center mb-3">
                    <img id="profileImagePreview" src="#" alt="Vista previa de la imagen" style="display:none;">
                </div>

                <!-- Campo para imagen -->
                <div class="mb-3">
                    <label for="imagen" class="form-label">Subir imagen de perfil</label>
                    <input class="form-control" type="file" id="imagen" name="imagen" accept="image/*" required>
                </div>

                <!-- Campo para teléfono -->
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>

                <!-- Campo para valoración -->
                <div class="mb-3">
                    <label for="valoracion" class="form-label">Valoración</label>
                    <select class="form-select" id="valoracion" name="valoracion" required>
                        <option value="" disabled selected>Seleccione una valoración</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <!-- Campo para viajes -->
                <div class="mb-3">
                    <label for="viajes" class="form-label">Viajes realizados</label>
                    <input type="number" class="form-control" id="viajes" name="viajes" min="0" value="0" required>
                </div>

                <!-- Campo para comentarios -->
                <div class="mb-3">
                    <label for="comentarios" class="form-label">Comentarios</label>
                    <textarea class="form-control" id="comentarios" name="comentarios" rows="3" required></textarea>
                </div>

                <!-- Botón para enviar el formulario -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Guardar Perfil</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Función para mostrar la imagen seleccionada en un círculo
        document.getElementById("imagen").addEventListener("change", function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const imagePreview = document.getElementById("profileImagePreview");
                imagePreview.src = e.target.result;
                imagePreview.style.display = "block"; // Muestra la imagen
            }

            if (file) {
                reader.readAsDataURL(file); // Lee la imagen seleccionada
            }
        });

        // Validación para la subida de imagen (opcional)
        document.getElementById("perfilForm").addEventListener("submit", function(event) {
            const imageInput = document.getElementById("imagen");
            if (imageInput.files.length === 0) {
                alert("Por favor, suba una imagen.");
                event.preventDefault(); // Evita que el formulario se envíe
            }
        });
    </script>

</body>
</html>

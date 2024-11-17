<?php include "../alumno/header_alumno.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trayectorias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/ver_traye.css">
    <style>
        /* Estilo para las tarjetas de trayectoria */
        .trayectoria-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra más suave */
            display: flex;
            flex-direction: row; /* Disposición horizontal */
            justify-content: space-between;
        }

        /* Detalles de la trayectoria */
        .trayectoria-details {
            margin-right: 20px;
            flex: 1; /* Ocupa el 50% del espacio disponible */
        }

        /* Contenedor del mapa */
        .map-container {
            width: 50%;
            height: 300px; /* Ajusta la altura del mapa */
            border-radius: 8px;
            border: 5px solid #4CAF50; /* Borde verde */
            box-shadow: 0 4px 12px rgba(0, 128, 0, 0.2); /* Sombra verde para el mapa */
            padding: 5px; /* Espacio entre el borde y el mapa */
        }

        /* Ajustes en pantallas pequeñas */
        @media (max-width: 767px) {
            .trayectoria-card {
                flex-direction: column; /* En pantallas pequeñas se apilan */
            }

            .map-container {
                height: 250px; /* Ajustar la altura del mapa en pantallas pequeñas */
                margin-top: 15px;
            }

            .trayectoria-details {
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Trayectorias Disponibles</h2>

        <?php include '../../model/ver_traye.php'; ?>

        <div class="row">
            <?php foreach ($trayectorias as $trayectoria): ?>
                <div class="col-md-12">
                    <div class="trayectoria-card">
                        <!-- Detalles de la trayectoria -->
                        <div class="trayectoria-details">
                            <h5><strong>Origen:</strong> <?= $trayectoria['origen'] ?></h5>
                            <h5><strong>Destino:</strong> <?= $trayectoria['destino'] ?></h5>
                            <p><strong>Conductor:</strong> <?= $trayectoria['conductor'] ?></p>
                            <p><strong>Vehículo:</strong> <?= $trayectoria['marca'] ?> <?= $trayectoria['modelo'] ?> (<?= $trayectoria['anio'] ?>)</p>
                            <p><strong>Placas:</strong> <?= $trayectoria['placas'] ?></p>
                            <p><strong>Color:</strong> <?= $trayectoria['color'] ?></p>
                            <p><strong>Capacidad:</strong> <?= $trayectoria['capacidad'] ?> personas</p>
                            <p><strong>Referencias:</strong> <?= $trayectoria['referencias'] ?></p>
                            <!-- Botón de solicitud con el idTrayectoria como atributo -->
                            <button class="btn btn-primary btn-solicitar" onclick="solicitarTrayectoria(<?= $trayectoria['id'] ?>)">Solicitar</button>
                        </div>
                        <!-- Contenedor para el mapa -->
                        <div id="map-<?php echo htmlspecialchars($trayectoria['id'], ENT_QUOTES, 'UTF-8'); ?>" class="map-container"></div>
                    </div>
                </div>
                <!-- Mensaje de éxito al enviar solicitud -->
                <div id="mensaje-solicitud" class="alert alert-success" role="alert" style="display: none;">
                 Solicitud enviada correctamente.
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        // Función para mostrar el mapa en el contenedor de cada trayectoria
        function mostrarMapa(idTrayectoria, origen, destino) {
            // Verifica si el origen o destino es "upemor"
            let location = (origen.toLowerCase() !== 'upemor' && origen.trim() !== '') ? origen : destino;

            // API key para Google Maps (reemplaza con la tuya)
            const apiKey = "AIzaSyBr1kk7jLRVoLpjy-uvr1-JhvP304A5Q5I";
            const mapUrl = `https://www.google.com/maps/embed/v1/place?key=${apiKey}&q=${encodeURIComponent(location)}`;
            document.getElementById('map-' + idTrayectoria).innerHTML = `<iframe width="100%" height="100%" style="border:0;" loading="lazy" allowfullscreen src="${mapUrl}"></iframe>`;
        }

        // Llama a la función de mapa pasando los valores de cada trayectoria
        <?php foreach ($trayectorias as $trayectoria): ?>
            mostrarMapa(<?= htmlspecialchars($trayectoria['id'], ENT_QUOTES, 'UTF-8') ?>, "<?= htmlspecialchars($trayectoria['origen'], ENT_QUOTES, 'UTF-8') ?>", "<?= htmlspecialchars($trayectoria['destino'], ENT_QUOTES, 'UTF-8') ?>");
        <?php endforeach; ?>
    </script>

    <script src="../../public/js/solicitar_trayectoria.js"></script>
</body>
</html>

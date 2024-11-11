<?php include "../alumno/header_alumno.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trayectorias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="../../public/css/ver_traye.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Trayectorias Disponibles</h2>

        <?php include '../../model/ver_traye.php'; ?>

        <div class="row">
            <?php foreach ($trayectorias as $trayectoria): ?>
                <div class="trayectoria-card">
                    <div class="trayectoria-details">
                        <h5><strong>Origen:</strong> <?= $trayectoria['origen'] ?></h5>
                        <h5><strong>Destino:</strong> <?= $trayectoria['destino'] ?></h5>
                        <p><strong>Conductor:</strong> <?= $trayectoria['conductor'] ?></p>
                        <p><strong>Vehículo:</strong> <?= $trayectoria['marca'] ?> <?= $trayectoria['modelo'] ?> (<?= $trayectoria['anio'] ?>)</p>
                        <p><strong>Capacidad:</strong> <?= $trayectoria['capacidad'] ?> personas</p>
                        <p><strong>Referencias:</strong> <?= $trayectoria['referencias'] ?></p>
                        <!-- Botón de solicitud con el idTrayectoria como atributo -->
                        <button class="btn btn-primary btn-solicitar" onclick="solicitarTrayectoria(<?= $trayectoria['id'] ?>)">Solicitar</button>
                    </div>
                    <div id="map-<?php echo htmlspecialchars($trayectoria['id'], ENT_QUOTES, 'UTF-8'); ?>" class="map-container"></div>
                </div>
                <div id="mensaje-solicitud" class="alert alert-success" role="alert" style="display: none;">
                 Solicitud enviada correctamente.
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
        <?php foreach ($trayectorias as $trayectoria): ?>
            // Crear el mapa
            const map<?= $trayectoria['id'] ?> = L.map('map-<?= $trayectoria['id'] ?>').setView([<?= $trayectoria['lat_origen'] ?>, <?= $trayectoria['lon_origen'] ?>], 13);

            // Capa del mapa
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(map<?= $trayectoria['id'] ?>);

            // Marcadores para origen y destino
            L.marker([<?= $trayectoria['lat_origen'] ?>, <?= $trayectoria['lon_origen'] ?>]).addTo(map<?= $trayectoria['id'] ?>)
                .bindPopup('<strong>Origen:</strong> <?= $trayectoria['origen'] ?>')
                .openPopup();

            L.marker([<?= $trayectoria['lat_destino'] ?>, <?= $trayectoria['lon_destino'] ?>]).addTo(map<?= $trayectoria['id'] ?>)
                .bindPopup('<strong>Destino:</strong> <?= $trayectoria['destino'] ?>');
        <?php endforeach; ?>

    </script>
    <script src="../../public/js/solicitar_trayectoria.js"></script>
</body>
</html>

<?php include "../alumno/header_alumno.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Trayectorias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/ver_traye.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Solicitudes de Trayectorias</h2>
        
        <?php include '../../model/ver_solicitudes_a.php'; ?>
        
        <div class="row">
            <?php foreach ($solicitudes as $solicitud): ?>
                <div class="trayectoria-card" id="solicitud-<?= $solicitud['id'] ?>">
                    <div class="trayectoria-details">
                        <h5><strong>Trayectoria:</strong></h5>
                        <p><strong>Origen:</strong> <?= $solicitud['origen'] ?></p>
                        <p><strong>Destino:</strong> <?= $solicitud['destino'] ?></p>

                        <h5><strong>Conductor:</strong></h5>
                        <p><strong>Nombre:</strong> <?= $solicitud['nombre_conductor'] ?></p>
                        <p><strong>Vehículo:</strong> <?= $solicitud['marca'] ?> <?= $solicitud['modelo'] ?> (<?= $solicitud['anio'] ?>)</p>

                        <h5><strong>Alumno Solicitante:</strong></h5>
                        <p><strong>Nombre:</strong> <?= $solicitud['nombre_alumno'] ?></p>
                        <p><strong>Email:</strong> <?= $solicitud['email_alumno'] ?></p>

                        <h5><strong>Detalles de la Solicitud:</strong></h5>
                        <p><strong>Fecha de Solicitud:</strong> <?= $solicitud['fechaSolicitud'] ?></p>
                        <p><strong>Estado:</strong> <span id="estado-<?= $solicitud['id'] ?>"><?= ucfirst($solicitud['estado']) ?></span></p>

                        <div id="acciones-<?= $solicitud['id'] ?>">
                            <?php if ($solicitud['estado'] === 'pendiente'): ?>
                                <button class="btn btn-danger" onclick="cancelarSolicitud(<?= $solicitud['id'] ?>)">Cancelar Solicitud</button>
                            <?php else: ?>
                                <!-- No button for non-pending requests -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function cancelarSolicitud(idSolicitud) {
            const data = new URLSearchParams();
            data.append('id', idSolicitud);

            fetch('../../model/eliminar_solicitud.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: data.toString()
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`solicitud-${idSolicitud}`).remove();
                    alert('Solicitud eliminada correctamente.');
                } else {
                    alert('Error al eliminar la solicitud.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>

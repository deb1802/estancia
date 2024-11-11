<?php include "../conductor/header_conductor.php"; ?>
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
        
        <?php include '../../model/ver_solicitudes.php'; ?>
        
        <div class="row">
            <?php foreach ($solicitudes as $solicitud): ?>
                <div class="trayectoria-card">
                    <div class="trayectoria-details">
                        <!-- Información de la trayectoria -->
                        <h5><strong>Trayectoria:</strong></h5>
                        <p><strong>Origen:</strong> <?= $solicitud['origen'] ?></p>
                        <p><strong>Destino:</strong> <?= $solicitud['destino'] ?></p>

                        <!-- Información del conductor -->
                        <h5><strong>Conductor:</strong></h5>
                        <p><strong>Nombre:</strong> <?= $solicitud['nombre_conductor'] ?></p>
                        <p><strong>Vehículo:</strong> <?= $solicitud['marca'] ?> <?= $solicitud['modelo'] ?> (<?= $solicitud['anio'] ?>)</p>

                        <!-- Información del alumno solicitante -->
                        <h5><strong>Alumno Solicitante:</strong></h5>
                        <p><strong>Nombre:</strong> <?= $solicitud['nombre_alumno'] ?></p>
                        <p><strong>Email:</strong> <?= $solicitud['email_alumno'] ?></p>

                        <!-- Detalles de la solicitud -->
                        <h5><strong>Detalles de la Solicitud:</strong></h5>
                        <p><strong>Fecha de Solicitud:</strong> <?= $solicitud['fechaSolicitud'] ?></p>
                        <p><strong>Estado:</strong> <?= ucfirst($solicitud['estado']) ?></p>

                        <!-- Opciones de acción para aceptar o rechazar la solicitud -->
                        <button class="btn btn-success" onclick="cambiarEstadoSolicitud(<?= $solicitud['id'] ?>, 'aceptada')">Aceptar</button>
                        <button class="btn btn-danger" onclick="cambiarEstadoSolicitud(<?= $solicitud['id'] ?>, 'rechazada')">Rechazar</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function cambiarEstadoSolicitud(idSolicitud, nuevoEstado) {
            const data = new URLSearchParams();
            data.append('idSolicitud', idSolicitud);
            data.append('nuevoEstado', nuevoEstado);

            fetch('../../model/actualizar_solicitud.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: data.toString()
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Estado de la solicitud actualizado correctamente.');
                    location.reload(); // Recargar la página para mostrar el cambio
                } else {
                    alert('Error al actualizar el estado de la solicitud.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>

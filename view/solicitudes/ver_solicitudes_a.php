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
                        <button class="btn btn-danger" onclick="eliminarSolicitud(<?= $solicitud['id'] ?>)">Cancelar solicitud</button>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        function eliminarSolicitud(idSolicitud) {
            if (confirm('¿Estás seguro de que deseas cancelar esta solicitud?')) {
                fetch('../../model/delete_solicitud.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id=' + idSolicitud
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Mostrar mensaje de confirmación al usuario
                    if (data.success) {
                        // Elimina la tarjeta de solicitud del DOM
                        document.querySelector(`#solicitud-${idSolicitud}`).remove();

                        // Redirigir a otra página después de 3 segundos
                        setTimeout(() => {
                            window.location.href = '../solicitudes/ver_solicitudes_a.php';
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    //alert('Error al procesar la solicitud.');
                });
            }
        }
    </script>

</body>
</html>

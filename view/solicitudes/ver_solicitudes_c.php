<?php include '../../model/ver_solicitudes.php'; ?>
<?php include "../conductor/header_conductor.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Trayectorias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/ver_traye.css">
    <style>
        .trayectoria-card { border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 5px; }
        .trayectoria-card.aceptada { border-color: green; background-color: #e6ffe6; }
        .trayectoria-card.rechazada { border-color: red; background-color: #ffe6e6; }
        .trayectoria-card.pendiente { border-color: gray; background-color: #f9f9f9; }
        .trayectoria-detalles-card { border: 1px solid #007bff; padding: 15px; border-radius: 5px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Solicitudes de Trayectorias</h2>
        
        <div class="row">
    <?php foreach ($solicitudes as $solicitud): ?>
        <div class="trayectoria-card <?= $solicitud['estado'] ?>" id="solicitud-<?= $solicitud['id'] ?>">
            <div class="trayectoria-details">
                <h5><strong>Trayectoria:</strong></h5>
                <p><strong>Origen:</strong> <?= $solicitud['origen'] ?></p>
                <p><strong>Destino:</strong> <?= $solicitud['destino'] ?></p>

                <h5><strong>Alumno Solicitante:</strong></h5>
                <p><strong>Nombre:</strong> <?= $solicitud['nombre_alumno'] ?></p>
                <p><strong>Email:</strong> <?= $solicitud['email_alumno'] ?></p>

                <p><strong>Estado:</strong> <span id="estado-<?= $solicitud['id'] ?>"><?= ucfirst($solicitud['estado']) ?></span></p>

                <div id="acciones-<?= $solicitud['id'] ?>">
                    <?php if ($solicitud['estado'] === 'pendiente'): ?>
                        <!-- Botones de Aceptar y Rechazar la solicitud -->
                        <button class="btn btn-success" onclick="cambiarEstadoSolicitud(<?= $solicitud['id'] ?>, 'aceptada')">Aceptar</button>
                        <button class="btn btn-danger" onclick="cambiarEstadoSolicitud(<?= $solicitud['id'] ?>, 'rechazada')">Rechazar</button>
                    <?php elseif ($solicitud['estado'] === 'aceptada'): ?>
                        <!-- Botón para Iniciar Viaje (si está aceptada) -->
                        <button class="btn btn-info" onclick="mostrarDetallesTrayectoria(<?= $solicitud['idTrayectoria'] ?>)">
                            Detalles de la Trayectoria
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Tarjeta de Detalles de Trayectoria -->
<div id="trayectoria-detalles" class="trayectoria-detalles-card d-none">
    <h4>Detalles de la Trayectoria</h4>
    <p><strong>Origen:</strong> <span id="detalle-origen"></span></p>
    <p><strong>Destino:</strong> <span id="detalle-destino"></span></p>
    <p><strong>Estado del Viaje:</strong> <span id="detalle-estado-viaje"></span></p>

    <h5>Alumnos en la Trayectoria:</h5>
    <ul id="lista-alumnos"></ul>

    <div>
        <!-- Botones para Iniciar y Finalizar Viaje -->
        <button class="btn btn-info" id="btn-iniciar-viaje" onclick="cambiarEstadoTrayectoria(<?= $solicitud['idTrayectoria'] ?>, 'iniciado')">
            Iniciar Viaje
        </button>
        <button class="btn btn-info" id="btn-finalizar-viaje" onclick="cambiarEstadoTrayectoria(<?= $solicitud['idTrayectoria'] ?>, 'finalizado')">
            Finalizar Viaje
        </button>
    </div>
</div>

    </div>
    <script src="../../public/js/solicituddes.js"></script>
</body>
</html> 

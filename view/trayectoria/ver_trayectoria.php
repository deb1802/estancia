<?php include '../conductor/header_conductor.php' ;?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trayectorias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/ver_traye.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Trayectorias de este conductor</h2>
        <?php include '../../model/ver _traye_c.php'; ?>
        
        <div class="row">
    <?php foreach ($trayectorias as $trayectoria): ?>
        <!-- Agregar un id único al contenedor principal -->
        <div class="col-md-12" id="trayectoria-<?= htmlspecialchars($trayectoria['id'], ENT_QUOTES, 'UTF-8') ?>">
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
                    <p><strong>Forma de pago:</strong> <?= $trayectoria['pago'] ?></p>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary" onclick="editarTrayectoria(<?= $trayectoria['id'] ?>)">Editar</button>
                        <button class="btn btn-danger" onclick="eliminarTrayectoria(<?= $trayectoria['id'] ?>)">Eliminar</button>
                    </div>
                </div>

                <!-- Mapa para cada trayectoria -->
                <div id="map-<?= htmlspecialchars($trayectoria['id'], ENT_QUOTES, 'UTF-8') ?>" class="map-container"></div>
            </div>
        </div>

        <script>
            function mostrarMapa(idTrayectoria, origen, destino) {
                let location = (origen.toLowerCase() !== 'upemor' && origen.trim() !== '') ? origen : destino;
                const apiKey = "AIzaSyBr1kk7jLRVoLpjy-uvr1-JhvP304A5Q5I";
        
                const mapUrl = `https://www.google.com/maps/embed/v1/place?key=${apiKey}&q=${encodeURIComponent(location)}`;
                document.getElementById('map-' + idTrayectoria).innerHTML = `<iframe width="100%" height="100%" style="border:0;" loading="lazy" allowfullscreen src="${mapUrl}"></iframe>`;
            }
            mostrarMapa(<?= htmlspecialchars($trayectoria['id'], ENT_QUOTES, 'UTF-8') ?>, "<?= htmlspecialchars($trayectoria['origen'], ENT_QUOTES, 'UTF-8') ?>", "<?= htmlspecialchars($trayectoria['destino'], ENT_QUOTES, 'UTF-8') ?>");
        </script>
    <?php endforeach; ?>
</div>

<script>
    function editarTrayectoria(id) {
        window.location.href = `../../model/update_trayectoria.php?id=${id}`;
    }

    function eliminarTrayectoria(id) {
        if (confirm("¿Estás seguro de que deseas eliminar esta trayectoria? (Toma en cuenta que se eliminarán los detalles de Trayectoria asociados a esta trayectoria)")) {
            fetch(`../../controller/eliminar_traye.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${id}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Elimina el contenedor del DOM
                    document.getElementById(`trayectoria-${id}`).remove();
                    alert('Trayectoria eliminada correctamente.');
                } else {
                    alert(data.message || 'Error al eliminar la trayectoria.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }
</script>

</body>
</html>

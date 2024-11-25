<?php include "../alumno/header_alumno.php"; ?>
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
        <h2 class="text-center">Trayectorias Disponibles</h2>
        <!-- Barra de búsqueda y filtros -->
        <div class="search-bar">
            <input type="text" id="busqueda" placeholder="Buscar trayectorias..." onkeyup="filtrarTrayectorias()">
            <select id="filtro" onchange="filtrarTrayectorias()">
                <option value="0">Origen</option>
                <option value="1">Destino</option>
                <option value="2">Conductor</option>
                <option value="3">Vehículo</option>
                <option value="4">Placas</option>
                <option value="5">Color del vehículo</option>
                <option value="6">Capacidad</option>
                <option value="7">Forma de pago</option>
            </select>
        </div>

        <?php include '../../model/ver_traye.php'; ?>

        <div class="row">
        <?php foreach ($trayectorias as $trayectoria): ?>
        <!-- Agregar un id único al contenedor principal -->
        <div class="col-md-12 trayectoria-item" id="trayectoria-<?= htmlspecialchars($trayectoria['id'], ENT_QUOTES, 'UTF-8') ?>">
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
                    <!-- Disponibilidad -->
                    <p><strong>Esta trayectoria está disponible en los siguientes días y horarios:</strong></p>
                            <ul>
                                <?php foreach ($trayectoria['disponibilidad'] as $dispo): ?>
                                    <li><strong><?= $dispo['dia'] ?>:</strong> <?= $dispo['horaInicio'] ?> - <?= $dispo['horaFin'] ?></li>
                                <?php endforeach; ?>
                            </ul>

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

        // Función para filtrar trayectorias
        function filtrarTrayectorias() {
    const busqueda = document.getElementById('busqueda').value.toLowerCase();
    const filtro = document.getElementById('filtro').value;
    const trayectorias = document.querySelectorAll('.trayectoria-item'); // Cambiar la clase aquí

    trayectorias.forEach(trayectoria => {
        const datos = [
            trayectoria.querySelector('h5:nth-of-type(1)').textContent.toLowerCase(), // Origen
            trayectoria.querySelector('h5:nth-of-type(2)').textContent.toLowerCase(), // Destino
            trayectoria.querySelector('p:nth-of-type(1)').textContent.toLowerCase(), // Conductor
            trayectoria.querySelector('p:nth-of-type(2)').textContent.toLowerCase(), // Vehículo
            trayectoria.querySelector('p:nth-of-type(3)').textContent.toLowerCase(), // Placas
            trayectoria.querySelector('p:nth-of-type(4)').textContent.toLowerCase(), // Color
            trayectoria.querySelector('p:nth-of-type(5)').textContent.toLowerCase(), // Capacidad
            trayectoria.querySelector('p:nth-of-type(7)').textContent.toLowerCase()  // Forma de pago
        ];

        trayectoria.style.display = datos[filtro].includes(busqueda) ? '' : 'none';
    });
}
// Filtrar trayectorias cuando se escriba en la barra de búsqueda
document.getElementById('busqueda').addEventListener('keyup', filtrarTrayectorias);
        document.getElementById('filtro').addEventListener('change', filtrarTrayectorias);
    </script>

    <script src="../../public/js/solicitar_trayectoria.js"></script>
</body>
</html>

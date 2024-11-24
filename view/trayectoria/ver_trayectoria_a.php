<?php include '../admin/header_admin.php'; ?>
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
        <h2 class="text-center">Trayectorias de todos los conductores</h2>

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

        <?php include '../../model/ver_traye_a.php'; ?>

        <div class="row" id="trayectorias-list">
            <?php foreach ($trayectorias as $trayectoria): ?>
                <div class="col-md-12 trayectoria-card perfil-item" id="trayectoria-<?= htmlspecialchars($trayectoria['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <div class="trayectoria-details">
                        <h5><strong>Origen:</strong> <span class="origen"><?= $trayectoria['origen'] ?></span></h5>
                        <h5><strong>Destino:</strong> <span class="destino"><?= $trayectoria['destino'] ?></span></h5>
                        <p><strong>Conductor:</strong> <span class="conductor"><?= $trayectoria['conductor'] ?></span></p>
                        <p><strong>Vehículo:</strong> <span class="vehiculo"><?= $trayectoria['marca'] ?> <?= $trayectoria['modelo'] ?> (<?= $trayectoria['anio'] ?>)</span></p>
                        <p><strong>Placas:</strong> <span class="placas"><?= $trayectoria['placas'] ?></span></p>
                        <p><strong>Color:</strong> <span class="color"><?= $trayectoria['color'] ?></span></p>
                        <p><strong>Capacidad:</strong> <span class="capacidad"><?= $trayectoria['capacidad'] ?> personas</span></p>
                        <p><strong>Referencias:</strong> <span class="referencias"><?= $trayectoria['referencias'] ?></span></p>
                        <p><strong>Forma de pago:</strong> <span class="pago"><?= $trayectoria['pago'] ?></span></p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary" onclick="editarTrayectoria(<?= $trayectoria['id'] ?>)">Editar</button>
                            <button class="btn btn-danger" onclick="eliminarTrayectoria(<?= $trayectoria['id'] ?>)">Eliminar</button>
                        </div>
                    </div>

                    <!-- Mapa para cada trayectoria -->
                    <div id="map-<?= htmlspecialchars($trayectoria['id'], ENT_QUOTES, 'UTF-8') ?>" class="map-container"></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        // Función para mostrar el mapa
        function mostrarMapa(idTrayectoria, origen, destino) {
            let location = (origen.toLowerCase() !== 'upemor' && origen.trim() !== '') ? origen : destino;
            const apiKey = "AIzaSyBr1kk7jLRVoLpjy-uvr1-JhvP304A5Q5I";
            const mapUrl = `https://www.google.com/maps/embed/v1/place?key=${apiKey}&q=${encodeURIComponent(location)}`;
            document.getElementById('map-' + idTrayectoria).innerHTML = `<iframe width="100%" height="100%" style="border:0;" loading="lazy" allowfullscreen src="${mapUrl}"></iframe>`;
        }

        // Llamar la función para cada trayectoria
        <?php foreach ($trayectorias as $trayectoria): ?>
            mostrarMapa(<?= htmlspecialchars($trayectoria['id'], ENT_QUOTES, 'UTF-8') ?>, "<?= htmlspecialchars($trayectoria['origen'], ENT_QUOTES, 'UTF-8') ?>", "<?= htmlspecialchars($trayectoria['destino'], ENT_QUOTES, 'UTF-8') ?>");
        <?php endforeach; ?>

        // Función para filtrar trayectorias
        function filtrarTrayectorias() {
            const busqueda = document.getElementById('busqueda').value.toLowerCase();
            const filtro = document.getElementById('filtro').value;
            const trayectorias = document.querySelectorAll('.perfil-item');

            trayectorias.forEach(trayectoria => {
                const datos = [
                    trayectoria.querySelector('.origen').textContent.toLowerCase(),
                    trayectoria.querySelector('.destino').textContent.toLowerCase(),
                    trayectoria.querySelector('.conductor').textContent.toLowerCase(),
                    trayectoria.querySelector('.vehiculo').textContent.toLowerCase(),
                    trayectoria.querySelector('.placas').textContent.toLowerCase(),
                    trayectoria.querySelector('.color').textContent.toLowerCase(),
                    trayectoria.querySelector('.capacidad').textContent.toLowerCase(),
                    trayectoria.querySelector('.pago').textContent.toLowerCase()
                ];

                trayectoria.style.display = datos[filtro].includes(busqueda) ? '' : 'none';
            });
        }

        // Filtrar trayectorias cuando se escriba en la barra de búsqueda
        document.getElementById('busqueda').addEventListener('keyup', filtrarTrayectorias);
        document.getElementById('filtro').addEventListener('change', filtrarTrayectorias);
    </script>
</body>
</html>

<?php
include '../../estancia/model/mostrar_avisos.php';
include 'header.php';
$anuncios = obtenerAvisos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anuncios Upemov</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/avisos.css">
</head>
<body>
    <div class="container mt-5">
        <!--<h1 class="text-center mb-4">Avisos Generales</h1> -->
        <div id="avisosCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicadores -->
            <div class="carousel-indicators">
                <?php foreach ($anuncios as $index => $anuncio): ?>
                    <button type="button" data-bs-target="#avisosCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
                <?php endforeach; ?>
            </div>

            <!-- Elementos del Carrusel -->
            <div class="carousel-inner">
                <?php foreach ($anuncios as $index => $anuncio): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="carousel-caption">
                            <h5><?= htmlspecialchars($anuncio['titulo']) ?></h5>
                            <p><?= htmlspecialchars($anuncio['mensaje']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Controles -->
            <button class="carousel-control-prev" type="button" data-bs-target="#avisosCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#avisosCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

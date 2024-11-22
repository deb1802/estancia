<?php
include '../admin/header_admin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Reporte</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-success text-white text-center">
                        <h4>Generar Reporte</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../../controller/reporte1_t.php">
                        <h5 class="text-center">Reporte de cantidad de viajes por alumno</h5>
                        <p class="text-center">cantidad de viajes que viajes que ha hecho un alumno con estado finalizado por un rango de fechas, mostrado de forma descendente.</p>
                            <div class="mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="fecha_fin" class="form-label">Fecha de fin:</label>
                                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="generar_reporte" class="btn btn-success w-100">
                                    Generar Reporte en Excel
                                </button>
                                <a class="cancelar" href="../reportes/menureportes.php" class="cancelar">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

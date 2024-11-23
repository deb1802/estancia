<!DOCTYPE html>
<html lang="es">
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
                        <h5 class="text-center">Reporte de Vehículos por Marca, Modelo y Año</h5>
                        <p class="text-center">Vehículos más registrados por marca, modelo y año.</p>

                        <form action="../../controller/reporte5_c.php" method="POST">
                            <div class="text-center mt-4">
                                <button type="submit" name="generar_reporte" class="btn btn-success w-100">
                                    Generar Reporte
                                </button>
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

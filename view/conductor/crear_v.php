<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo</title>
    <link rel="stylesheet" href="../../public/css/create_v.css">
    
    <script src="../public/js/validaryear.js" defer></script>
</head>
<body>
    <div class="contendor_login">
        <div class="login-box">
            <h2>Registrar Vehículo</h2>
            <p>Empieza a compartir tus viajes con los demás</p>
            <form action="../../controller/alta_vehiculo.php" method="post">
                <div class="input">
                    <input type="text" placeholder="Ingresa marca" name="marca" required>
                </div>
                <div class="input">
                    <input type="text" placeholder="Ingresa modelo" name="modelo" required> 
                </div>
                <div class="input">
                    <input type="number" placeholder="Ingresa año" name="anio" required min="1950" max="2025" onblur="validateYear(event)"> <!-- Limitar año -->
                </div>
                <div class="input">
                    <input type="text" placeholder="Ingresa placas" name="placas" required>
                </div>
                <div class="input">
                    <input type="text" placeholder="Ingresa color" name="color" required>
                </div>
                <button type="submit">Registrar vehículo</button>
            </form>
        </div>
    </div>
</body>
</html>

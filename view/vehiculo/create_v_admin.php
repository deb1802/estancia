<?php include "../conductor/header_conductor.php"; ?>

<br><br><br>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo</title>
    <link rel="stylesheet" href="../../public/css/create_v.css">
    <script src="../../public/js/validacion_vehiculo.js" defer></script>
</head>
<body>
    <div class="contenedor_login">
        <div class="login-box">
            <h2>Registrar Vehículo</h2>
            <p>Empieza a compartir tus viajes con los demás</p>
            <form name="frm" action="../../controller/alta_v_admin.php" method="post" onsubmit="return validacion();">
                <div class="input">
                    <input type="text" placeholder="Ingresa id del conductor" name="idconductor">
                </div>
                <p class="alert alert-danger" id="erroridconductor" style="display: none;">
                    Ingresa id de conductor válido
                </p>
                <div class="input">
                    <input type="text" placeholder="Ingresa marca" name="marca">
                </div>
                <p class="alert alert-danger" id="errorMarca" style="display: none;">
                    La marca debe contener entre 1 y 40 caracteres y no debe contener caracteres especiales.
                </p>

                <div class="input">
                    <input type="text" placeholder="Ingresa modelo" name="modelo"> 
                </div>
                <p class="alert alert-danger" id="errorModelo" style="display: none;">
                    El modelo debe contener entre 1 y 40 caracteres y no debe contener caracteres especiales.
                </p>

                <div class="input">
                    <input type="number" placeholder="Ingresa año" name="anio">
                </div>
                <p class="alert alert-danger" id="errorAnio" style="display: none;">
                    El año debe estar entre 1950 y 2025.
                </p>

                <div class="input">
                    <input type="text" placeholder="Ingresa placas" name="placas">
                </div>
                <p class="alert alert-danger" id="errorPlacas" style="display: none;">
                    Las placas deben contener solo letras y números y tener un máximo de 10 caracteres.
                </p>

                <div class="input">
                    <input type="text" placeholder="Ingresa color" name="color">
                </div>
                <p class="alert alert-danger" id="errorColor" style="display: none;">
                    El color debe contener entre 1 y 30 caracteres y no debe contener números.
                </p>

                <button type="submit" class="form_btn">Registrar vehículo</button>
                <p class="alert alert-primary" id="btn" style="display: none;">
                    Datos enviando...
                </p>
            </form>
        </div>
    </div>
</body>
</html>

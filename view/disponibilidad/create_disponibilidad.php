<?php
include "../conductor/header_conductor.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Disponibilidad</title>
    <link rel="stylesheet" href="../../public/css/create_dispo.css">
    <script src="../../public/js/validacion_dispo.js"></script>
</head>
<body>
    <div class="contenedor_login">
        <div class="login-box">
            <h2>Registrar Disponibilidad</h2>
            <form name="frmDisponibilidad" action="../../controller/alta_dispo.php" method="post" onsubmit="return validacionDisponibilidad();">
                
                <div class="input">
                    <select name="dia">
                        <option value="">Seleccione el día</option>
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miércoles">Miércoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                        <option value="Sábado">Sábado</option>
                        <option value="Domingo">Domingo</option>
                    </select>
                </div>
                <p class="alert alert-danger" id="errorDia" style="display: none;">
                    Por favor seleccione un día de la semana.
                </p>

                <div class="input">
                    <label for="horaInicio">Hora de Inicio:</label>
                    <select name="horaInicio">
                        <option value="">Seleccione la hora de inicio</option>
                        <?php
                        for ($hour = 6; $hour <= 21; $hour++) {
                            for ($minute = 0; $minute < 60; $minute += 30) {
                                $time24 = sprintf('%02d:%02d', $hour, $minute);
                                $ampm = $hour < 12 ? 'a.m.' : 'p.m.';
                                $displayHour = $hour % 12 == 0 ? 12 : $hour % 12;
                                $time12 = sprintf('%02d:%02d %s', $displayHour, $minute, $ampm);
                                echo "<option value='$time24'>$time12</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <p class="alert alert-danger" id="errorHoraInicio" style="display: none;">
                    Por favor seleccione una hora de inicio válida.
                </p>

                <div class="input">
                    <label for="horaFin">Hora de Fin:</label>
                    <select name="horaFin">
                        <option value="">Seleccione la hora de fin</option>
                        <?php
                        for ($hour = 6; $hour <= 21; $hour++) {
                            for ($minute = 0; $minute < 60; $minute += 30) {
                                $time24 = sprintf('%02d:%02d', $hour, $minute);
                                $ampm = $hour < 12 ? 'a.m.' : 'p.m.';
                                $displayHour = $hour % 12 == 0 ? 12 : $hour % 12;
                                $time12 = sprintf('%02d:%02d %s', $displayHour, $minute, $ampm);
                                echo "<option value='$time24'>$time12</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <p class="alert alert-danger" id="errorHoraFin" style="display: none;">
                    Por favor seleccione una hora de fin válida.
                </p>

                <button type="submit" class="form_btn">Registrar Disponibilidad</button>
                <p class="alert alert-primary" id="btn" name="btn" style="display: none;">
                    Enviando disponibilidad...
                </p>
            </form>
        </div>
    </div>
</body>
</html>

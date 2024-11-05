<?php 
//include "../conductor/header_conductor.php"; 
include "../model/db.php"; // Incluir conexión a la base de datos
include "../model/update_disponibilidad.php"; // Incluir la función de actualización

// Verificar si se ha establecido un ID en la cadena de consulta
if (isset($_GET['id'])) {
    $ID = $_GET['id'];
    $SQL = "SELECT * FROM disponibilidad WHERE id = $ID;";
    $resu = mysqli_query($conn, $SQL);
    
    if (mysqli_num_rows($resu) == 1) {
        $row = mysqli_fetch_array($resu);
        $dia = $row['dia'];
        $horaInicio = $row['horaInicio'];
        $horaFin = $row['horaFin'];
    } else {
        echo "No existen registros";
    }
}

if (isset($_POST['actualizar'])) {
    $id = $_GET['id'];
    $dia = $_POST['dia'];
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];

    // Función para actualizar la disponibilidad
    if (actualizarDisponibilidad($conn, $id, $dia, $horaInicio, $horaFin)) {
        header("Location: ../view/disponibilidad/read_dispo.php");
        exit();
    } else {
        echo "Error actualizando registro: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Disponibilidad</title>
    <link rel="stylesheet" href="../public/css/create_dispo.css">
    <script src="../public/js/validacion_dispo.js" defer></script>
</head>
<body>
    <div class="contenedor_login">
        <div class="login-box">
            <h2>Actualizar Disponibilidad</h2>
            <form name="frmDisponibilidad" action="update_disponibilidad.php?id=<?php echo $_GET['id']; ?>" method="POST" onsubmit="return validacionDisponibilidad();">
                
                <div class="input">
                    <select name="dia">
                        <option value="">Seleccione el día</option>
                        <option value="Lunes" <?php echo ($dia == 'Lunes') ? 'selected' : ''; ?>>Lunes</option>
                        <option value="Martes" <?php echo ($dia == 'Martes') ? 'selected' : ''; ?>>Martes</option>
                        <option value="Miércoles" <?php echo ($dia == 'Miércoles') ? 'selected' : ''; ?>>Miércoles</option>
                        <option value="Jueves" <?php echo ($dia == 'Jueves') ? 'selected' : ''; ?>>Jueves</option>
                        <option value="Viernes" <?php echo ($dia == 'Viernes') ? 'selected' : ''; ?>>Viernes</option>
                        <option value="Sábado" <?php echo ($dia == 'Sábado') ? 'selected' : ''; ?>>Sábado</option>
                        <option value="Domingo" <?php echo ($dia == 'Domingo') ? 'selected' : ''; ?>>Domingo</option>
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
                        for ($hour = 0; $hour < 24; $hour++) {
                            for ($minute = 0; $minute < 60; $minute += 30) {
                                $time = sprintf('%02d:%02d', $hour, $minute);
                                $selected = ($time == $horaInicio) ? 'selected' : '';
                                echo "<option value='$time' $selected>$time</option>";
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
                        for ($hour = 0; $hour < 24; $hour++) {
                            for ($minute = 0; $minute < 60; $minute += 30) {
                                $time = sprintf('%02d:%02d', $hour, $minute);
                                $selected = ($time == $horaFin) ? 'selected' : '';
                                echo "<option value='$time' $selected>$time</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <p class="alert alert-danger" id="errorHoraFin" style="display: none;">
                    Por favor seleccione una hora de fin válida.
                </p>

                <button type="submit" name="actualizar" class="form_btn">Actualizar Disponibilidad</button>
                <p class="alert alert-primary" id="btn" name="btn" style="display: none;">
                    Enviando disponibilidad...
                </p>
            </form>
        </div>
    </div>
</body>
</html>

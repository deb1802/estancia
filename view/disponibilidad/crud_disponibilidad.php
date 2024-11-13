<?php 
include "../admin/header_admin.php"; 
include "../../model/consultar_conductores.php"; 
include "../../model/consultar_disponibilidades_a.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Disponibilidad</title>
    <link rel="stylesheet" href="../../public/css/crud_disponibilidad.css">
    <script src="../../public/js/validacion_dispo.js"></script>
</head>
<body>
    <div class="contenedor_login">
        <div class="login-box">
            <h2>Registrar Disponibilidad</h2>
            <form name="frmDisponibilidad" action="../../controller/alta_dispo_a.php" method="post" onsubmit="return validacionDisponibilidad();">
                <div class="input">
                    <label for="idConductor">ID del Conductor:</label>
                    <input type="text" name="idConductor" id="idConductor" placeholder="Ingrese el ID del conductor" required>
                </div>
                <p class="alert alert-danger" id="errorIdConductor" style="display: none;">
                    Por favor ingrese un ID de conductor válido.
                </p>

                <!-- Campo para seleccionar el día -->
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

                <!-- Campo para seleccionar la hora de inicio -->
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

                <!-- Campo para seleccionar la hora de fin -->
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

    <div class="table-container">
        <h3>Conductores</h3>
        <table class="centered-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $execConductores = obtenerConductoresDisponibles($conn);

                while ($rowConductor = mysqli_fetch_array($execConductores)) {
            ?>
                <tr>
                    <td><?php echo $rowConductor['id']; ?></td>
                    <td><?php echo $rowConductor['nombre']; ?></td>
                    <td><?php echo $rowConductor['apellido']; ?></td>
                </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div>
    <?php
        include "../disponibilidad/confirmacion_delete.php";
    ?>
    <script src="../../public/js/modalControl.js"></script>
    <div class="table-container">
        <h3>Disponibilidades</h3>
        <table class="table-primary centered-table">
            <thead>
                <tr>
                    <th>Id conductor</th>
                    <th>Día</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $execDisponibilidades = obtenerDisponibilidades($conn); // Llamamos a la función para obtener las disponibilidades

                if (mysqli_num_rows($execDisponibilidades) == 0) {
                    echo "<tr><td colspan='5'>No se encontraron disponibilidades.</td></tr>";
                } else {
                    while ($rows = mysqli_fetch_assoc($execDisponibilidades)) {
                    ?>    
                        <tr>
                            <td><?php echo $rows['idConductor']; ?></td>
                            <td><?php echo $rows['dia']; ?></td>
                            <td><?php echo $rows['horaInicio']; ?></td>
                            <td><?php echo $rows['horaFin']; ?></td>
                            <td class="action-buttons">
                                <a href="../../controller/update_disponibilidad_a.php?id=<?php echo $rows['id']; ?>" class="edit-btn">
                                    <img src="../../public/img/refresh.svg" alt="Editar" class="icon"> Editar
                                </a>
                                <a href="javascript:void(0);" onclick="openModal('../../controller/delete_dispo_a.php?id=<?php echo $rows['id']; ?>')" class="delete-btn">
                                    <img src="../../public/img/trash.svg" alt="Eliminar" class="icon"> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php    
                    }
                }        
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

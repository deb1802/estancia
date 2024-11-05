<?php
session_start(); 
include "../conductor/header_conductor.php";
include "../../model/db.php";
include "../disponibilidad/confirmacion_delete.php";

$link_rel = "../../public/css/read_v.css";
$id = $_SESSION['id_conductor']; 

// Vincular el archivo CSS para estilo
echo '<link rel="stylesheet" href="' . $link_rel . '">';
echo '<link rel="stylesheet" href="../../public/css/updel.css">';
?>
<script src="../../public/js/modalControl.js"></script>
<div class="table-container">
    <table class="table-primary centered-table">
        <thead>
            <tr>
                <th>Día</th>
                <th>Hora de Inicio</th>
                <th>Hora de Fin</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM disponibilidad WHERE idConductor = '$id';";
            $exec = mysqli_query($conn, $sql);
            
            if (!$exec) {
                die("Error en la consulta: " . mysqli_error($conn));
            }
            
            if (mysqli_num_rows($exec) == 0) {
                echo "<tr><td colspan='6'>No se encontraron disponibilidades para este conductor.</td></tr>";
            } else {
                while ($rows = mysqli_fetch_assoc($exec)) {
                    ?>    
                    <tr>
                        <td><?php echo $rows['dia']; ?></td>
                        <td><?php echo $rows['horaInicio']; ?></td>
                        <td><?php echo $rows['horaFin']; ?></td>
                        <td class="action-buttons">
                            <a href="../../controller/update_disponibilidad.php?id=<?php echo $rows['id']; ?>" class="edit-btn">
                                <img src="../../public/img/refresh.svg" alt="Editar" class="icon"> Editar
                            </a>
                            <a href="javascript:void(0);" onclick="openModal('../../controller/delete_dispo.php?id=<?php echo $rows['id']; ?>')" class="delete-btn">
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

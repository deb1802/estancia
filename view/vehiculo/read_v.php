<?php
session_start(); 
include "../conductor/header_conductor.php";
include "../../model/db.php";
include "../vehiculo/confirmacion_delete.php";

$id = $_SESSION['id_conductor']; 
?>

<link rel="stylesheet" href="../../public/css/read_v.css">
<!--<link rel="stylesheet" href="../../public/css/updel.css"> -->
<script src="../../public/js/modalControl.js"></script>

<!-- Tabla de vehículos -->
<table class="table-primary centered-table">
    <thead>
        <tr>
            <th>Marca</th> 
            <th>Modelo</th>
            <th>Año</th>
            <th>Placas</th>
            <th>Color</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM vehiculos WHERE idConductor = '$id';";
        $exec = mysqli_query($conn, $sql);
        
        if (!$exec) {
            die("Error en la consulta: " . mysqli_error($conn));
        }
        
        if (mysqli_num_rows($exec) == 0) {
            echo "<tr><td colspan='8'>No se encontraron vehículos para este conductor.</td></tr>";
        } else {
            while ($rows = mysqli_fetch_assoc($exec)) {
                ?>    
                <tr>
                    <td><?php echo $rows['marca']; ?></td>
                    <td><?php echo $rows['modelo']; ?></td>
                    <td><?php echo $rows['anio']; ?></td>
                    <td><?php echo $rows['placas']; ?></td>
                    <td><?php echo $rows['color']; ?></td>
                    <td class="action-buttons">
                        <!-- Botón de Editar -->
                        <a href="../../controller/actualizar_vehiculo.php?id=<?php echo $rows['id']; ?>" class="edit-btn">
                            <img src="../../public/img/refresh.svg" alt="Editar" class="icon"> Editar
                        </a>
                        <a href="javascript:void(0);" onclick="openModal('../../controller/delete_vehiculo.php?id=<?php echo $rows['id']; ?>')" class="delete-btn">
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

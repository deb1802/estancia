<?php include "../../model/db.php"?>
<?php include '../vehiculo/confirmacion_delete.php'; ?>

<!-- Vincular el archivo CSS -->
<link rel="stylesheet" href="../../public/css/updel.css">

<script src="../../public/js/modalControl.js"></script>


<!-- Tabla de vehículos -->
<table class="centered-table">
    <thead>
        <tr>
            <th>Id vehículo</th>
            <th>Id del conductor</th>
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
        $sql = "SELECT * FROM vehiculos;";
        $exec = mysqli_query($conn, $sql);

        while($rows = mysqli_fetch_array($exec)){
        ?>    
            <tr>
                <td><?php echo $rows['id']; ?></td>
                <td><?php echo $rows['idConductor']; ?></td>
                <td><?php echo $rows['marca']; ?></td>
                <td><?php echo $rows['modelo']; ?></td>
                <td><?php echo $rows['anio']; ?></td>
                <td><?php echo $rows['placas']; ?></td>
                <td><?php echo $rows['color']; ?></td>
                <td class="action-buttons">
                    <!-- Botón de Editar -->
                    <a href="../../controller/update_v.php?id=<?php echo $rows['id']; ?>" class="edit-btn">
                        <img src="../../public/img/refresh.svg" alt="Editar" class="icon"> Editar
                    </a>

                    <a href="javascript:void(0);" onclick="openModal('../../controller/delete_vehiculo.php?id=<?php echo $rows['id']; ?>')" class="delete-btn">
                        <img src="../../public/img/trash.svg" alt="Eliminar" class="icon"> Eliminar
                    </a>
                </td>
            </tr>
        <?php    
        }
        ?>
    </tbody>
</table>

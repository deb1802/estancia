<?php
session_start();

include "../../model/db.php";
$link_rel = "../../public/css/read_v.css";

?>

<link rel="stylesheet" href="<?php echo $link_rel; ?>">
<table class="table-primary centered-table">
    <thead>
        <tr>
            <th>Id vehículo</th>
            <th>Id del conductor</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Placas</th>
            <th>Color</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM vehiculos;";
        $exec = mysqli_query($conn, $sql);

        // Ciclo para recorrer fila por fila los resultados
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
            </tr>
        <?php    
        }
        ?>
    </tbody>
</table>

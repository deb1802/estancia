<?php include "../admin/header_admin.php"; ?>
<?php include "../../model/db.php"; ?>
<?php include "../../model/consultar_conductores.php"; ?>
<?php include '../vehiculo/confirmacion_delete.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Vehículos</title>
    <link rel="stylesheet" href="../../public/css/crud_vehiculo.css">
    <script src="../../public/js/validacion_vehiculo.js" defer></script>
    <script src="../../public/js/modalControl.js" defer></script>
</head>
<body>
    <div class="main-container">
        <!-- Contenedor del formulario -->
        <div class="form-container">
            <h2>Registrar Vehículo</h2>
            <p>Registra un vehículo para algún conductor</p>
            <form name="frm" action="../../controller/alta_v_admin.php" method="post" onsubmit="return validacion();">
                <div class="input">
                    <input type="text" placeholder="Ingresa id del conductor" name="idconductor">
                </div>
                <p class="alert" id="erroridconductor" style="display: none;">Ingresa id de conductor válido</p>

                <div class="input">
                    <input type="text" placeholder="Ingresa marca" name="marca">
                </div>
                <p class="alert" id="errorMarca" style="display: none;">La marca debe contener entre 1 y 40 caracteres y no debe contener caracteres especiales.</p>

                <div class="input">
                    <input type="text" placeholder="Ingresa modelo" name="modelo">
                </div>
                <p class="alert" id="errorModelo" style="display: none;">El modelo debe contener entre 1 y 40 caracteres y no debe contener caracteres especiales.</p>

                <div class="input">
                    <input type="number" placeholder="Ingresa año" name="anio">
                </div>
                <p class="alert" id="errorAnio" style="display: none;">El año debe estar entre 1950 y 2025.</p>

                <div class="input">
                    <input type="text" placeholder="Ingresa placas" name="placas">
                </div>
                <p class="alert" id="errorPlacas" style="display: none;">Las placas deben contener solo letras y números y tener un máximo de 10 caracteres.</p>

                <div class="input">
                    <input type="text" placeholder="Ingresa color" name="color">
                </div>
                <p class="alert" id="errorColor" style="display: none;">El color debe contener entre 1 y 30 caracteres y no debe contener números.</p>

                <button type="submit" class="form_btn">Registrar vehículo</button>
            </form>
        </div>

        <!-- Contenedor de la tabla de conductores disponibles -->
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

        <!-- Contenedor de la tabla de vehículos registrados -->
        <div class="table-container">
            <h3>Vehículos Registrados</h3>
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
                    // Consulta para obtener vehículos registrados
                    $sqlVehiculos = "SELECT * FROM vehiculos;";
                    $execVehiculos = mysqli_query($conn, $sqlVehiculos);

                    while ($rows = mysqli_fetch_array($execVehiculos)) {
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
                                <a href="../../controller/update_v_admin.php?id=<?php echo $rows['id']; ?>" class="edit-btn">
                                    <img src="../../public/img/refresh.svg" alt="Editar" class="icon"> Editar
                                </a>
                                <a href="javascript:void(0);" onclick="openModal('../../controller/delete_v_admin.php?id=<?php echo $rows['id']; ?>')" class="delete-btn">
                                    <img src="../../public/img/trash.svg" alt="Eliminar" class="icon"> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

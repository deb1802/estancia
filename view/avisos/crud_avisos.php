<?php include "../admin/header_admin.php"; ?>
<?php include "../../model/db.php" ?>
<?php //include '../avisos/confirmacion_delete.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Avisos</title>
    <link rel="stylesheet" href="../../public/css/crud_avisos.css">
    <script src="../../public/js/validacion_avisos.js" defer></script>
    <script src="../../public/js/modalControl_a.js" defer></script>
</head>
<body>
    <div class="main-container">
        <!-- Formulario para registrar avisos -->
        <div class="form-container">
            <h2>Registrar Aviso</h2>
            <p>Gestiona los avisos importantes</p>
            <form name="frmAvisos" action="../../controller/alta_avisos.php" method="post" onsubmit="return validacionAvisos();">
                <div class="input">
                    <input type="text" placeholder="Título del Aviso" name="titulo">
                </div>
                <p class="alert" id="errorTitulo" style="display: none;">El campo título es obligatorio.</p>

                <div class="input">
                    <textarea placeholder="Mensaje del Aviso" name="mensaje"></textarea>
                </div>
                <p class="alert" id="errorMensaje" style="display: none;">El mensaje debe tener entre 10 y 500 caracteres.</p>

                <button type="submit" class="form_btn">Registrar Aviso</button>
            </form>
        </div>

        <!-- Tabla para listar avisos -->
        <div class="table-container">
            <table class="centered-table">
                <thead>
                    <tr>
                        <th>Id Aviso</th>
                        <th>Título</th>
                        <th>Mensaje</th>
                        <th>Fecha de creación</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM avisosGeneral;";
                    $exec = mysqli_query($conn, $sql);

                    while ($rows = mysqli_fetch_array($exec)) {
                    ?>
                        <tr>
                            <td><?php echo $rows['id']; ?></td>
                            <td><?php echo $rows['titulo']; ?></td>
                            <td><?php echo $rows['mensaje']; ?></td>
                            <td><?php echo $rows['fecha']; ?></td>
                            <td class="action-buttons">
                                <a href="../../model/update_avisos.php?id=<?php echo $rows['id']; ?>" class="edit-btn">
                                    <img src="../../public/img/refresh.svg" alt="Editar" class="icon"> Editar
                                </a>
                                <a href="javascript:void(0);" onclick="openModala('../../controller/delete_aviso.php?id=<?php echo $rows['id']; ?>')" class="delete-btn">
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

<?php include "../admin/header_admin.php"; ?> 
<?php include "../../model/db.php" ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Avisos</title>
    <!-- Archivo de estilos CSS para el formulario y la tabla -->
    <link rel="stylesheet" href="../../public/css/crud_avisos.css">
    <!-- Archivo JavaScript de validación del formulario -->
    <script src="../../public/js/validacion_avisos.js" defer></script>

    <script>
        // Función para mostrar un alert de confirmación antes de eliminar un aviso
        function confirmDelete(url) {
            // Muestra un mensaje de confirmación para el usuario
            if (confirm("¿Estás seguro de que deseas eliminar este aviso? Esta acción no se puede deshacer.")) {
                window.location.href = url; // Redirige a la URL de eliminación si el usuario confirma
            }
        }
    </script>
</head>
<body>
    <div class="main-container">
        <!-- Formulario para registrar un nuevo aviso -->
        <div class="form-container">
            <h2>Registrar Aviso</h2>
            <p>Gestiona los avisos importantes</p>
            <form name="frmAvisos" action="../../controller/alta_avisos.php" method="post" onsubmit="return validacionAvisos();">
                <!-- Campo para el título del aviso -->
                <div class="input">
                    <input type="text" placeholder="Título del Aviso" name="titulo">
                </div>
                <!-- Mensaje de error si el campo título está vacío -->
                <p class="alert" id="errorTitulo" style="display: none;">El campo título es obligatorio.</p>

                <!-- Campo para el mensaje del aviso -->
                <div class="input">
                    <textarea placeholder="Mensaje del Aviso" name="mensaje"></textarea>
                </div>
                <!-- Mensaje de error si el mensaje no cumple con la longitud mínima o máxima -->
                <p class="alert" id="errorMensaje" style="display: none;">El mensaje debe tener entre 10 y 500 caracteres.</p>

                <!-- Botón para enviar el formulario y registrar el aviso -->
                <button type="submit" class="form_btn">Registrar Aviso</button>
            </form>
        </div>

        <!-- Tabla para mostrar los avisos registrados -->
        <div class="table-container">
            <table class="centered-table">
                <thead>
                    <tr>
                        <!-- Encabezados de las columnas -->
                        <th>Id Aviso</th>
                        <th>Título</th>
                        <th>Mensaje</th>
                        <th>Fecha de creación</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta para obtener todos los avisos registrados
                    $sql = "SELECT * FROM avisosGeneral;";
                    $exec = mysqli_query($conn, $sql);

                    // Itera sobre los resultados y muestra cada aviso en una fila de la tabla
                    while ($rows = mysqli_fetch_array($exec)) {
                    ?>
                        <tr>
                            <!-- Muestra los datos de cada aviso en la tabla -->
                            <td><?php echo $rows['id']; ?></td>
                            <td><?php echo $rows['titulo']; ?></td>
                            <td><?php echo $rows['mensaje']; ?></td>
                            <td><?php echo $rows['fecha']; ?></td>
                            <td class="action-buttons">
                                <!-- Enlace para editar el aviso -->
                                <a href="../../model/update_avisos.php?id=<?php echo $rows['id']; ?>" class="edit-btn">
                                    <img src="../../public/img/refresh.svg" alt="Editar" class="icon"> Editar
                                </a>
                                <!-- Enlace para eliminar el aviso, con confirmación antes de realizar la acción -->
                                <a href="javascript:void(0);" onclick="confirmDelete('../../controller/delete_aviso.php?id=<?php echo $rows['id']; ?>')" class="delete-btn">
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

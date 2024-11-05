<?php include "../admin/header_admin.php"; ?>
<?php include "../../model/db.php" ?>
<?php include '../usuarios/confirmacion_delete.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios</title>
    <link rel="stylesheet" href="../../public/css/crud_usuarios.css">
    <script src="../../public/js/validacion_registro.js" defer></script>
    <script src="../../public/js/modalControl_u.js" defer></script>
</head>
<body>
    <div class="main-container">
        <div class="form-container">
            <h2>Registrar Usuario</h2>
            <p>Gestiona el acceso de los usuarios</p>
            <form name="frm" action="../../controller/alta_usuario_admin.php" method="post" onsubmit="return validacion();">
                <div class="input">
                    <input type="text" placeholder="Nombre" name="nombre">
                </div>
                <p class="alert" id="errorNombre" style="display: none;">El campo nombre debe contener entre 3 y 40 caracteres y no debe contener números.</p>

                <div class="input">
                    <input type="text" placeholder="Apellido" name="apellido">
                </div>
                <p class="alert" id="errorApellido" style="display: none;">El campo apellido debe contener entre 3 y 40 caracteres y no debe contener números.</p>

                <div class="input">
                    <input type="email" placeholder="Correo Electrónico" name="correo">
                </div>
                <p class="alert" id="errorCorreo" style="display: none;">Ingresa un correo electrónico válido en formato ejemplo@dominio.com.</p>

                <div class="input">
                    <input type="text" placeholder="Usuario" name="usuario">
                </div>
                <p class="alert" id="errorUsuario" style="display: none;">El campo usuario debe tener entre 4 y 20 caracteres, solo puede incluir letras, números y guiones bajos.</p>

                <div class="input">
                    <input type="password" placeholder="Contraseña" name="contrasena">
                </div>
                <p class="alert" id="errorContrasena" style="display: none;">La contraseña debe tener al menos 6 caracteres.</p>

                <!-- Campo para seleccionar tipo de usuario -->
                <div class="input">
                    <select name="tipo_usuario">
                        <option value="">Selecciona tipo de usuario</option>
                        <option value="1">Alumno</option>
                        <option value="2">Conductor</option>
                        <option value="3">Administrador</option>
                    </select>
                </div>
                <p class="alert" id="errorTipoUsuario" style="display: none;">Selecciona un tipo de usuario válido.</p>

                <button type="submit" class="form_btn">Registrar Usuario</button>
            </form>
        </div>

        <!-- Contenedor de la tabla -->
        <div class="table-container">
            <table class="centered-table">
                <thead>
                    <tr>
                        <th>Id Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Usuario</th>
                        <th>Contrasena</th>
                        <th>Tipo de Usuario</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM usuarios;";
                    $exec = mysqli_query($conn, $sql);

                    while ($rows = mysqli_fetch_array($exec)) {
                        $tipoUsuario = '';
                        switch ($rows['tipo']) {
                            case 'alumno':
                                $tipoUsuario = 'Alumno';
                                break;
                            case 'conductor':
                                $tipoUsuario = 'Conductor';
                                break;
                            case 'administrador':
                                $tipoUsuario = 'Administrador';
                                break;
                            default:
                                $tipoUsuario = 'Desconocido';
                                break;
                        }
                    ?>
                        <tr>
                            <td><?php echo $rows['id']; ?></td>
                            <td><?php echo $rows['nombre']; ?></td>
                            <td><?php echo $rows['apellido']; ?></td>
                            <td><?php echo $rows['correo']; ?></td>
                            <td><?php echo $rows['usuario']; ?></td>
                            <td><?php echo $rows['contrasena']; ?></td>
                            <td><?php echo $tipoUsuario; ?></td>
                            <td class="action-buttons">
                                <a href="../../controller/update_usuarios_admin.php?id=<?php echo $rows['id']; ?>" class="edit-btn">
                                    <img src="../../public/img/refresh.svg" alt="Editar" class="icon"> Editar
                                </a>
                                <a href="javascript:void(0);" onclick="openModalu('../../controller/delete_usuarios_admin.php?id=<?php echo $rows['id']; ?>')" class="delete-btn">
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

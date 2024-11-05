<?php include "../model/db.php"; ?>
<?php include "../model/update_usuario.php"; ?>

<!--<?php include "../../estancia/view/admin/header_admin.php"; ?>!-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link rel="stylesheet" href="../public/css/update_u.css">
    <script src="../public/js/validacion_registro.js" defer></script>
</head>
<body>
    <div class="contenedor_login">
        <div class="login-box">
            <h2>Actualizar Usuario</h2>
            <p>Modifica los datos del usuario</p>

            <?php
            if (isset($_GET['id'])) {
                $ID = $_GET['id'];
                $SQL = "SELECT * FROM usuarios WHERE id = $ID;";
                $resu = mysqli_query($conn, $SQL);
                
                if (mysqli_num_rows($resu) == 1) {
                    $row = mysqli_fetch_array($resu);
                    $nombre = $row['nombre'];
                    $apellido = $row['apellido'];
                    $correo = $row['correo'];
                    $usuario = $row['usuario'];
                    $tipo_usuario = $row['tipo'];
                } else {
                    echo "No existen registros";
                }
            }

            if (isset($_POST['actualizar'])) {
                $id = $_GET['id'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $correo = $_POST['correo'];
                $usuario = $_POST['usuario'];
                $tipo_usuario = $_POST['tipo_usuario'];

                // Función de actualizar
                if (actualizarUsuario($conn, $id, $nombre, $apellido, $correo, $usuario, $tipo_usuario)) {
                    header("Location: ../view/usuarios/crud_usuarios.php");
                    exit();
                } else {
                    echo "Error actualizando registro: " . mysqli_error($conn);
                }
            }
            ?>

            <form action="update_usuarios_admin.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <div class="input">
                    <input type="text" placeholder="Nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
                </div>

                <div class="input">
                    <input type="text" placeholder="Apellido" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>" required>
                </div>

                <div class="input">
                    <input type="email" placeholder="Correo Electrónico" name="correo" value="<?php echo htmlspecialchars($correo); ?>" required>
                </div>

                <div class="input">
                    <input type="text" placeholder="Usuario" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>" required>
                </div>

                <div class="input">
                    <select name="tipo_usuario" required>
                        <option value="">Selecciona tipo de usuario</option>
                        <option value="alumno" <?php echo ($tipo_usuario == 'alumno') ? 'selected' : ''; ?>>Alumno</option>
                        <option value="conductor" <?php echo ($tipo_usuario == 'conductor') ? 'selected' : ''; ?>>Conductor</option>
                        <option value="administrador" <?php echo ($tipo_usuario == 'administrador') ? 'selected' : ''; ?>>Administrador</option>
                    </select>
                </div>

                <button type="submit" name="actualizar">Actualizar</button>
            </form>
        </div>
    </div>
</body>
</html>

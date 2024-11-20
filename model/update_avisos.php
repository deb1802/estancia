<link rel="stylesheet" href="../public/css/crud_usuarios.css">
<?php
include 'db.php';

$id = $_GET['id'];
$titulo = $_POST['titulo'] ?? '';
$mensaje = $_POST['mensaje'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE avisosGeneral SET titulo = '$titulo', mensaje = '$mensaje' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../view/avisos/crud_avisos.php");
    } else {
        echo "Error al actualizar el aviso.";
    }
} else {
    $sql = "SELECT * FROM avisosGeneral WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $aviso = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aviso</title>
    <link rel="stylesheet" href="../public/css/crud_avisos.css">
    <script src="../../public/js/validacion_avisos.js" defer></script>
</head>
<body>
    <div class="form-container">
        <h2>Editar Aviso</h2>
        <p>Gestiona los avisos importantes</p>
        <form name="frmAvisos" action="" method="post" onsubmit="return validacionAvisos();">
            <div class="input">
                <input type="text" placeholder="Título del Aviso" name="titulo" value="<?php echo htmlspecialchars($aviso['titulo']); ?>">
            </div>
            <p class="alert" id="errorTitulo" style="display: none;">El campo título es obligatorio.</p>

            <div class="input">
                <textarea placeholder="Mensaje del Aviso" name="mensaje"><?php echo htmlspecialchars($aviso['mensaje']); ?></textarea>
            </div>
            <p class="alert" id="errorMensaje" style="display: none;">El mensaje debe tener entre 10 y 500 caracteres.</p>

            <button type="submit" class="form_btn">Guardar Cambios</button>
            <br><br>
            <a href="../view/avisos/crud_avisos.php" class="cancelar">Cancelar</a>
        </form>
    </div>
</body>
</html>

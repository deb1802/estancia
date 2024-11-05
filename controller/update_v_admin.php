<?php include "../model/db.php"; ?>
<?php include "../model/update_vehiculo.php"; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Vehículo</title>
    <link rel="stylesheet" href="../public/css/create_v_admin.css">
    <script src="../public/js/validaryear.js" defer></script>
</head>
<body>
    <div class="contenedor_login">
        <div class="login-box">
            <h2>Actualizar Vehículo</h2>
            <p>Modifica los datos del vehículo</p>

            <?php
            if (isset($_GET['id'])) {
                $ID = $_GET['id'];
                $SQL = "SELECT * FROM vehiculos WHERE id = $ID;";
                $resu = mysqli_query($conn, $SQL);
                
                if (mysqli_num_rows($resu) == 1) {
                    $row = mysqli_fetch_array($resu);
                    $marca = $row['marca'];
                    $modelo = $row['modelo'];
                    $anio = $row['anio'];
                    $placas = $row['placas'];
                    $color = $row['color'];
                } else {
                    echo "No existen registros";
                }
            }

            if (isset($_POST['actualizar'])) {
                $id = $_GET['id'];
                $marca = $_POST['marca'];
                $modelo = $_POST['modelo'];
                $anio = $_POST['anio'];
                $placas = $_POST['placas'];
                $color = $_POST['color'];

                // función de actualizar
                if (actualizarVehiculo($conn, $id, $marca, $modelo, $anio, $placas, $color)) {
                    header("Location: ../view/vehiculo/crud_vehiculo.php");
                    exit();
                } else {
                    echo "Error actualizando registro: " . mysqli_error($conn);
                }
            }
            ?>

            <form action="update_v_admin.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <div class="input">
                    <input type="text" placeholder="Marca del vehículo" name="marca" id="marca" value="<?php echo htmlspecialchars($marca); ?>" required>
                </div>

                <div class="input">
                    <input type="text" placeholder="Modelo del vehículo" name="modelo" id="modelo" value="<?php echo htmlspecialchars($modelo); ?>" required>
                </div>

                <div class="input">
                    <input type="number" placeholder="Año del vehículo" name="anio" id="anio" value="<?php echo htmlspecialchars($anio); ?>" required min="1950" max="2025" onblur="validateYear(event)">
                </div>

                <div class="input">
                    <input type="text" placeholder="Placas del vehículo" name="placas" id="placas" value="<?php echo htmlspecialchars($placas); ?>" required>
                </div>

                <div class="input">
                    <input type="text" placeholder="Color del vehículo" name="color" id="color" value="<?php echo htmlspecialchars($color); ?>" required>
                </div>

                <button type="submit" name="actualizar">Actualizar</button>
            </form>
        </div>
    </div>
</body>
</html>

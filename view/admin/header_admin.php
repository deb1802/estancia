<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPEMOV</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/header.css">
</head>
<body>
    <header class="header bg-light">
        <div class="container d-flex justify-content-between align-items-center py-3">
            <div class="logo d-flex align-items-center">
                <img src="../../public/img/seeding.svg" class="logo-img" alt="Logo">
                <h1 class="ml-2">
                    <span class="u">U</span>
                    <span class="p">P</span>
                    <span class="e">E</span>
                    <span class="m">M</span>
                    <span class="o">O</span>
                    <span class="v">V</span>
                </h1>
                <span class="text-muted ml-1">rutas verdes</span>
            </div>
            <nav class="nav d-flex align-items-center">
            <a href="../admin/menuadmin.php" class="nav-link d-flex align-items-center">
                    <div class="icon-circle"><img src="../../public/img/home1.png" alt="Home"></div>
                    Home
                </a>
                <a href="../usuarios/crud_usuarios.php" class="nav-link d-flex align-items-center">
                    <div class="icon-circle"><img src="../../public/img/cari.png" alt="Home"></div>
                    Usuarios
                </a>
                <a href="../vehiculo/crud_vehiculo.php" class="nav-link d-flex align-items-center">
                    <div class="icon-circle"><img src="../../public/img/logout.svg" alt="Home"></div>
                    Vehiculos
                </a>
                <a href="../../view/vehiculo/read_v.php" class="nav-link d-flex align-items-center">
                    <div class="icon-circle"><img src="../../public/img/logout.svg" alt="Home"></div>
                    Perfil
                </a>
                <a href="../../controller/logout.php" class="nav-link d-flex align-items-center">
                    <div class="icon-circle"><img src="../../public/img/logout.svg" alt="Home"></div>
                    Cerrar sesión
                </a>
            </nav>
        </div>
    </header>
</body>
</html>

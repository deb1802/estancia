<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPEMOV</title>
    <!-- Estilos -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../estancia/public/css/header.css">
</head>
<body>
    <!-- Encabezado para dispositivos grandes -->
    <header class="header bg-light d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center py-3">
            <!-- Logotipo -->
            <div class="logo d-flex align-items-center">
                <img src="../../estancia/public/img/seeding.svg" class="logo-img" alt="Logo">
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
            <!-- Navegación -->
            <nav class="nav d-flex align-items-center">
                <a href="../../estancia/index.php" class="nav-link d-flex align-items-center">
                    <div class="icon-circle">
                        <img src="../../estancia/public/img/home1.png" alt="Home">
                    </div>
                    Inicio
                </a>
                <a href="../../estancia/view/trayectoria/ver_trayectorias_index.php" class="nav-link d-flex align-items-center">
                    <div class="icon-circle">
                        <img src="../../estancia/public/img/cari.png" alt="Viaja">
                    </div>
                    Viaja
                </a>
                <a href="../../estancia/view/avisosGeneral.php" class="nav-link d-flex align-items-center">
                    <div class="icon-circle">
                        <img src="../../estancia/public/img/bell-ringing.svg" alt="Conduce">
                    </div>
                    Info
                </a>
                <a href="../../estancia/view/nosotros.php" class="nav-link d-flex align-items-center">
                    <div class="icon-circle">
                        <img src="../../estancia/public/img/info.png" alt="Acerca de Nosotros">
                    </div>
                    Nosotros
                </a>
                <a href="../../estancia/view/login.php" class="nav-link d-flex align-items-center">
                    <div class="icon-circle">
                        <img src="../../estancia/public/img/log.png" alt="Iniciar Sesión">
                    </div>
                    Iniciar Sesión
                </a>
            </nav>
        </div>
    </header>

    <!-- Barra de navegación para dispositivos móviles -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light container-fluid d-lg-none">
        <a class="navbar-brand" href="#">
            <div class="logo d-flex align-items-center">
                <img src="../../estancia/public/img/seeding.svg" class="logo-img" alt="Logo">
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
        </a>
        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse pt-2" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../../estancia/index.php">
                        <div class="icon-circle">
                            <img src="../../estancia/public/img/home1.png" alt="Home">
                        </div>
                        Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../estancia/view/trayectoria/ver_trayectorias_index.php">
                        <div class="icon-circle">
                            <img src="../../estancia/public/img/cari.png" alt="Viaja">
                        </div>
                        Viaja
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">
                        <div class="icon-circle">
                            <img src="../../estancia/public/img/condu.png" alt="Conduce">
                        </div>
                        Conduce
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../estancia/view/nosotros.php">
                        <div class="icon-circle">
                            <img src="../../estancia/public/img/info.png" alt="Acerca de Nosotros">
                        </div>
                        Nosotros
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../estancia/view/login.php">
                        <div class="icon-circle">
                            <img src="../../estancia/public/img/log.png" alt="Iniciar Sesión">
                        </div>
                        Iniciar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

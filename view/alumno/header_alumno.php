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
        <nav class="navbar navbar-expand-md navbar-light container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../../public/img/seeding.svg" class="logo-img" alt="Logo">
                <h1 class="ml-2 mb-0">
                    <span class="u">U</span>
                    <span class="p">P</span>
                    <span class="e">E</span>
                    <span class="m">M</span>
                    <span class="o">O</span>
                    <span class="v">V</span>
                </h1>
                <span class="text-muted ml-1">rutas verdes</span>
            </a>

            <!-- Botón de menú para pantallas pequeñas -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <!-- Enlace con ícono de Home -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="../alumno/menu_alumno.php">
                            <div class="icon-circle"><img src="../../public/img/home1.png" alt="Home"></div>
                            Home
                        </a>
                    </li>

                    <!-- Enlace con ícono de perfil -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="../../view/perfil/verificar_perfil.php">
                            <div class="icon-circle"><img src="../../public/img/user.png" alt="Perfil"></div>
                            Mi perfil
                        </a>
                    </li>

                    <!-- Enlace con ícono de notificaciones -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="../avisos/mostrar_avisos.php">
                            <div class="icon-circle"><img src="../../public/img/bell.svg" alt="Notificaciones"></div>
                            Notificaciones
                        </a>
                    </li>

                    <!-- Enlace con ícono de cerrar sesión -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="../../controller/logout.php">
                            <div class="icon-circle"><img src="../../public/img/logout.svg" alt="Cerrar sesión"></div>
                            Cerrar sesión
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Scripts necesarios para el funcionamiento del menú -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

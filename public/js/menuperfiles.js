function navigateTo(page) {
    switch (page) {
        case 'reporte1':
            window.location.href = '../../view/perfil/crear_perfil_a.php';
            break;
        case 'reporte2':
            window.location.href = '../../view/perfil/perfiles_a.php';
            break;
        default:
            console.error("Página desconocida");
    }
}

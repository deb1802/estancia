function navigateTo(page) {
    switch (page) {
        case 'reporte1':
            window.location.href = '../../../estancia/view/reportes/reporte1.php';
            break;
        case 'disponibilidades':
            window.location.href = '';
            break;
        case 'trayectorias':
            window.location.href = '';
            break;
        case 'avisos':
            window.location.href = '';
            break;
        case 'perfiles':
            window.location.href = '';
            break;
        default:
            console.error("Página desconocida");
    }
}

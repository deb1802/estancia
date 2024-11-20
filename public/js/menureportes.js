function navigateTo(page) {
    switch (page) {
        case 'usuarios':
            window.location.href = '';
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

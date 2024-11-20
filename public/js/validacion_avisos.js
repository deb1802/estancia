function validacionAvisos() {
    const titulo = document.forms['frmAvisos']['titulo'].value.trim();
    const mensaje = document.forms['frmAvisos']['mensaje'].value.trim();

    if (titulo === "") {
        document.getElementById('errorTitulo').style.display = 'block';
        return false;
    }

    if (mensaje.length < 10 || mensaje.length > 500) {
        document.getElementById('errorMensaje').style.display = 'block';
        return false;
    }

    return true;
}

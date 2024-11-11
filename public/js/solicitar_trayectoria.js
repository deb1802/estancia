function solicitarTrayectoria(idTrayectoria) {
    const data = new URLSearchParams();
    data.append('idTrayectoria', idTrayectoria);

    fetch('../../model/insert_solicitud.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: data.toString()
    })
    .then(response => response.json())
    .then(data => {
        const mensajeSolicitud = document.getElementById('mensaje-solicitud');
        
        if (data.success) {
            mensajeSolicitud.style.display = 'block'; 
            mensajeSolicitud.textContent = 'Solicitud enviada correctamente.';
            mensajeSolicitud.classList.remove('alert-danger');
            mensajeSolicitud.classList.add('alert-success');
        } else {
            mensajeSolicitud.style.display = 'block';
            mensajeSolicitud.textContent = 'Error al enviar la solicitud: ' + data.message;
            mensajeSolicitud.classList.remove('alert-success');
            mensajeSolicitud.classList.add('alert-danger');
        }

        // Ocultar el mensaje después de unos segundos
        setTimeout(() => {
            mensajeSolicitud.style.display = 'none';
        }, 4000);
    })
    .catch(error => console.error('Error:', error));
}

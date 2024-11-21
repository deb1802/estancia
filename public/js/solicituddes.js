// Función para cambiar el estado de la solicitud
function cambiarEstadoSolicitud(idSolicitud, nuevoEstado) {
    const data = new URLSearchParams();
    data.append('idSolicitud', idSolicitud);
    data.append('nuevoEstado', nuevoEstado);

    fetch('../../model/actualizar_solicitud.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: data.toString(),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                const card = document.getElementById(`solicitud-${idSolicitud}`);
                card.classList.remove('pendiente', 'rechazada', 'aceptada');
                card.classList.add(nuevoEstado);

                const estadoElem = document.getElementById(`estado-${idSolicitud}`);
                estadoElem.innerText = nuevoEstado.charAt(0).toUpperCase() + nuevoEstado.slice(1);

                const accionesDiv = document.getElementById(`acciones-${idSolicitud}`);
                if (nuevoEstado === 'aceptada') {
                    accionesDiv.innerHTML = ` 
                        <button class="btn btn-info" onclick="mostrarDetallesTrayectoria(${idSolicitud})">
                            Detalles de la Trayectoria
                        </button>`;
                    alert('Solicitud aceptada.');
                } else if (nuevoEstado === 'rechazada') {
                    alert('Solicitud rechazada.');
                    accionesDiv.innerHTML = '';
                } else {
                    accionesDiv.innerHTML = '';
                }
            } else {
                //console.log('Error al actualizar el estado.');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            //alert('Hubo un problema al cambiar el estado de la solicitud.');
        });
}

// Función para mostrar los detalles de la trayectoria
function mostrarDetallesTrayectoria(idTrayectoria) {
    fetch(`../../../estancia/model/detalle_trayectoria.php?idTrayectoria=${idTrayectoria}`)
        .then(response => response.json())
        .then(data => {
            // Verificar si la respuesta es exitosa
            if (data.success) {
                // Mostrar los detalles de la trayectoria
                document.getElementById('detalle-origen').innerText = data.detalles.origen;
                document.getElementById('detalle-destino').innerText = data.detalles.destino;
                document.getElementById('detalle-estado-viaje').innerText = data.detalles.estado_viaje;

                // Mostrar la lista de alumnos
                const listaAlumnos = document.getElementById('lista-alumnos');
                listaAlumnos.innerHTML = '';  // Limpiar lista anterior
                if (data.detalles.alumnos && data.detalles.alumnos.length > 0) {
                    // Si hay alumnos, agregar a la lista
                    data.detalles.alumnos.forEach(alumno => {
                        const li = document.createElement('li');
                        li.innerText = `Nombre: ${alumno.nombre_alumno} - Email: ${alumno.email_alumno}`;
                        listaAlumnos.appendChild(li);
                    });
                } else {
                    // Si no hay alumnos, mostrar un mensaje
                    listaAlumnos.innerHTML = '<li>No hay alumnos en esta trayectoria.</li>';
                }

                // Mostrar la sección de detalles
                document.getElementById('trayectoria-detalles').classList.remove('d-none');
            } else {
                // Si no fue exitoso, mostrar mensaje de error
                alert(data.message || 'No se pudieron obtener los detalles.');
            }
        })
        .catch(error => {
            // En caso de error con la solicitud
            console.error('Error al obtener los detalles:', error);
            alert('Hubo un problema al cargar los detalles de la trayectoria.');
        });
}

// Función para cambiar el estado de la trayectoria
function cambiarEstadoTrayectoria(idTrayectoria, nuevoEstado) {
    const data = new URLSearchParams();
    data.append('idTrayectoria', idTrayectoria);
    data.append('nuevoEstado', nuevoEstado);

    fetch('../../model/cambiar_estado_dt.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: data.toString(),
    })
    .then((response) => response.json())
    .then((data) => {
        console.log(data);
        if (data.success) {
            // Actualizar la clase del estado en la interfaz
            const card = document.getElementById(`trayectoria-detalles`); // Asegurándonos de modificar solo la tarjeta de los detalles
            card.classList.remove('ninguno', 'iniciado', 'finalizado');
            card.classList.add(nuevoEstado);

            // Verificar que estado_viaje esté relacionado con el idAlumno o idTrayectoria en detalleTrayectoria
            // Acceder al elemento correcto donde debe actualizarse el estado de la trayectoria
            const estadoElem = document.getElementById(`detalle-estado-viaje`);

            if (estadoElem) {
                estadoElem.innerText = nuevoEstado.charAt(0).toUpperCase() + nuevoEstado.slice(1);
            } else {
                console.error('Elemento de estado no encontrado.');
            }

            // Actualizar los botones de acciones según el nuevo estado
            const accionesDiv = document.getElementById('acciones-' + idTrayectoria);

            if (nuevoEstado === 'iniciado') {
                accionesDiv.innerHTML = `
                    <button class="btn btn-success" onclick="cambiarEstadoTrayectoria(${idTrayectoria}, 'finalizado')">
                        Finalizar Viaje
                    </button>`;
                alert('El viaje ha comenzado.');
            } else if (nuevoEstado === 'finalizado') {
                accionesDiv.innerHTML = '';
                alert('El viaje ha finalizado.');
            }
        } else {
            console.log('Error al actualizar el estado.');
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

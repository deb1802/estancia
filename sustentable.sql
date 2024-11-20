DROP DATABASE IF EXISTS sustentable;
CREATE DATABASE sustentable;
USE sustentable;

CREATE TABLE usuarios (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre TEXT NOT NULL,
  apellido TEXT NOT NULL,
  correo TEXT NOT NULL,
  usuario TEXT NOT NULL,
  contrasena TEXT NOT NULL,
  tipo ENUM('alumno', 'conductor', 'administrador') NOT NULL
);

drop table if exists perfiles;
CREATE TABLE perfiles (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idAlumno INT NOT NULL,
    nombreUser TEXT NULL,
    matricula TEXT NULL,
    telefono TEXT NOT NULL,
    valoracion ENUM('1', '2', '3', '4', '5') NULL,
    viajes INT NULL,
    informacion TEXT NULL,
    imagen VARCHAR(255) NULL,  -- Campo para la ruta de la imagen
    FOREIGN KEY (idAlumno) REFERENCES usuarios(id)
);
CREATE TABLE vehiculos (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  idConductor INT NOT NULL,
  marca TEXT NOT NULL,
  modelo TEXT NOT NULL,
  anio INT NOT NULL,
  placas TEXT NOT NULL,
  color TEXT NOT NULL,
  FOREIGN KEY (idConductor) REFERENCES usuarios(id)
);

CREATE TABLE disponibilidad (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idConductor INT NOT NULL,
    dia ENUM('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo') NOT NULL,
    horaInicio TIME NOT NULL,
    horaFin TIME NOT NULL,
    FOREIGN KEY (idConductor) REFERENCES usuarios(id)
);

drop table if exists trayectorias2;
CREATE TABLE trayectorias2 (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idConductor INT NOT NULL,
    idVehiculo INT NOT NULL,
    capacidad INT NOT NULL,
    origen TEXT NOT NULL,
    destino TEXT NOT NULL,
    referencias TEXT,
    pago ENUM('Efectivo', 'Transferencia') NOT NULL,
    estado_viaje ENUM('ninguno', 'iniciado', 'finalizado') DEFAULT 'ninguno',
    FOREIGN KEY (idVehiculo) REFERENCES vehiculos(id)
);


CREATE TABLE detalleTrayectoria (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idTrayectoria INT NOT NULL,
    idAlumno INT NOT NULL,
    estado_viaje ENUM('ninguno', 'iniciado', 'finalizado') DEFAULT 'ninguno',
    FOREIGN KEY (idTrayectoria) REFERENCES trayectorias2(id)
);
drop table if exists avisos;
CREATE TABLE avisos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idAlumno INT NOT NULL,
    titulo TEXT NOT NULL,
    mensaje TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idAlumno) REFERENCES usuarios(id)
);
drop table if exists avisos;
CREATE TABLE avisosGeneral (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titulo TEXT NOT NULL,
    mensaje TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE solicitudes (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idAlumno INT NOT NULL,
    idTrayectoria INT NOT NULL,
    fechaSolicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'aceptada', 'rechazada') NOT NULL DEFAULT 'pendiente',
    FOREIGN KEY (idAlumno) REFERENCES usuarios(id),
    FOREIGN KEY (idTrayectoria) REFERENCES trayectorias(id)
);

INSERT INTO usuarios (id, nombre, apellido, correo, usuario, contrasena, tipo) VALUES 
('1', 'Debanni', 'Morales', 'admin@upemor.edu.mx', 'admin', '1234', 'administrador'),
('2', 'Patrick', 'Perez', 'admin2@upemor.edu.mx', 'admin2', '1234', 'administrador'),
('3', 'Wendy', 'Moreno', 'wenmb@upemor.edu.mx', 'wen', '1234', 'conductor'),
('4', 'Yatziry', 'Serrano', 'yatzsh@upemor.edu.mx', 'yatz', '1234', 'alumno'),
('5', 'Dulce', 'Villega', 'dulvm@upemor.edu.mx', 'dul', '1234', 'alumno'),
('6', 'Jesus', 'Arizmendi', 'yisus@upemor.edu.mx', 'yisus', '1234', 'alumno'),
('7', 'Jorge', 'Alejandro', 'yorch@upemor.edu.mx', 'yorch', '1234', 'conductor'),
('8', 'Gerardo', 'Ascencio', 'gera@upemor.edu.mx', 'gera', '1234', 'conductor'),
('9', 'Jesus', 'Torres', 'jesusatf@upemor.edu.mx', 'jesusatf', '1234', 'alumno'),
('10', 'Fernando', 'Ortiz', 'fer@upemor.edu.mx', 'ferso', '1234', 'alumno');

INSERT INTO vehiculos (id, idConductor, marca, modelo, anio, placas, color) VALUES 
('1', '3', 'Volkswagen', 'Jetta', 2000, 'HBC-405-B', 'Rojo'),
('2', '7', 'Volkswagen', 'Clasico', 2014, 'PYA-45-06', 'Gris'),
('3', '8', 'Volkswagen', 'Beetle', 1987, 'RNB-88-54', 'Blanco');

INSERT INTO disponibilidad (id, idConductor, dia, horaInicio, horaFin) VALUES 
('1', '3', 'Lunes', '10:00:00', '14:00:00'),
('2', '7', 'Martes', '12:00:00', '16:00:00'),
('3', '8', 'Miércoles', '08:00:00', '12:00:00'),
('4', '3', 'Jueves', '15:00:00', '19:00:00'),
('5', '7', 'Viernes', '11:00:00', '15:00:00');

DROP TRIGGER IF EXISTS after_update_solicitud;
DELIMITER //
CREATE TRIGGER after_update_solicitud
AFTER UPDATE ON solicitudes
FOR EACH ROW
BEGIN
    DECLARE metodo_pago TEXT;
    DECLARE fecha_aceptacion DATETIME;
    SET fecha_aceptacion = NOW();

    IF NEW.estado = 'aceptada' THEN
        -- Inserción en detalleTrayectoria
        INSERT INTO detalleTrayectoria (idTrayectoria, idAlumno)
        VALUES (NEW.idTrayectoria, NEW.idAlumno);

        -- Inserción en avisos con mensajes predefinidos
        INSERT INTO avisos (idAlumno, titulo, mensaje)
        VALUES 
            (NEW.idAlumno, 'Información', CONCAT('El conductor ha aceptado tu solicitud el ', fecha_aceptacion));

        -- Consulta del metodoPago solo si idTrayectoria existe en trayectorias
        SELECT pago INTO metodo_pago
        FROM trayectorias
        WHERE id = NEW.idTrayectoria;

        -- Disminuir la capacidad de la trayectoria
        UPDATE trayectorias2
        SET capacidad = capacidad - 1
        WHERE id = NEW.idTrayectoria AND capacidad > 0;
    END IF;
END //
DELIMITER ;


select * from detalleTrayectoria;



drop trigger if exists actualizarViajesYCrearAvisos;
DELIMITER //
CREATE TRIGGER actualizarViajesYCrearAvisos
AFTER UPDATE ON detalleTrayectoria
FOR EACH ROW
BEGIN
    -- Verificar que el estado cambió a 'finalizado'
    IF NEW.estado_viaje = 'finalizado' THEN
        -- Incrementar viajes del conductor asociado a la trayectoria
        UPDATE perfiles
        SET viajes = COALESCE(viajes, 0) + 1
        WHERE idAlumno = (
            SELECT idConductor
            FROM trayectorias
            WHERE id = NEW.idTrayectoria
        );

        -- Incrementar viajes de los alumnos asociados a la trayectoria
        UPDATE perfiles
        SET viajes = COALESCE(viajes, 0) + 1
        WHERE idAlumno IN (
            SELECT idAlumno
            FROM detalleTrayectoria
            WHERE idTrayectoria = NEW.idTrayectoria
        );

        -- Crear aviso para el método de pago (si no es NULL)
        IF (
            SELECT pago
            FROM trayectorias2
            WHERE id = NEW.idTrayectoria
        ) IS NOT NULL THEN
            INSERT INTO avisos (idAlumno, titulo, mensaje)
            SELECT 
                idAlumno,
                'Información',
                CONCAT('Recuerda pagarle al conductor. Este viaje se paga por ', 
                       (SELECT pago FROM trayectorias2 WHERE id = NEW.idTrayectoria))
            FROM detalleTrayectoria
            WHERE idTrayectoria = NEW.idTrayectoria;
        END IF;

        -- Crear aviso para informar que el viaje finalizó
        INSERT INTO avisos (idAlumno, titulo, mensaje)
        SELECT 
            idAlumno,
            'Viaje Finalizado',
            CONCAT('Tu viaje finalizó el día ', DATE(NOW()), ' a las ', TIME(NOW()))
        FROM detalleTrayectoria
        WHERE idTrayectoria = NEW.idTrayectoria;
    END IF;
END;
//
DELIMITER ;



select * from perfiles;
select * from detalleTrayectoria;
select * from avisos;
select * from usuarios;
select * from vehiculos;
select * from trayectorias2;
select * from trayectorias2;

select * from perfiles;
select * from avisosGeneral;

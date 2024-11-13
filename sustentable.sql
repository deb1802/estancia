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

CREATE TABLE perfiles (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  idAlumno INT NOT NULL,
  telefono TEXT NOT NULL,
  matricula TEXT NOT NULL,
  valoracion ENUM('1', '2', '3', '4', '5') NULL,
  viajes INT NULL,
  comentarios TEXT NULL,
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

drop table if exists trayectorias;
CREATE TABLE trayectorias1 (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idConductor INT NOT NULL,
    idVehiculo INT NOT NULL,
	capacidad INT NOT NULL,
    origen TEXT NOT NULL,
    destino TEXT NOT NULL,
    referencias TEXT,
	pago ENUM('Efectivo', 'Transferencia') NOT NULL,
    FOREIGN KEY (idVehiculo) REFERENCES vehiculos(id)
);

CREATE TABLE trayectorias (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idConductor INT NOT NULL,
    idVehiculo INT NOT NULL,
    capacidad INT NOT NULL,
    origen TEXT NOT NULL,
    destino TEXT NOT NULL,
    referencias TEXT,
    pago ENUM('Efectivo', 'Transferencia') NOT NULL,
    origen_coords POINT NOT NULL,   -- Coordenadas de origen como POINT
    destino_coords POINT NOT NULL,  -- Coordenadas de destino como POINT
    FOREIGN KEY (idVehiculo) REFERENCES vehiculos(id),
    SPATIAL INDEX (origen_coords),  -- Índices espaciales para mejorar la búsqueda
    SPATIAL INDEX (destino_coords)
);



CREATE TABLE detalleTrayectoria (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idTrayectoria INT NOT NULL,
    idAlumno INT NOT NULL,
    FOREIGN KEY (idTrayectoria) REFERENCES trayectorias(id)
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

INSERT INTO perfiles (id, idAlumno, telefono, matricula, valoracion, viajes, comentarios) VALUES 
('1', '3', '7772670694', 'MBWO220238', '5', '0', 'Maneja muy bien'),
('2', '4', '7774931305', 'SHYO221058', '4', '0', 'Es educada'),
('3', '5', '7775368702', 'VMDO220377', '3', '0', 'Impuntual'),
('4', '6', '7774428209', 'AMJO220898', '2', '0', 'Habla mucho'),
('5', '7', '7771670103', 'AGJO220589', '1', '0', 'Se vuela los topes'),
('6', '8', '7775456768', 'AOCO220147', '4', '0', 'Precio accesible'),
('7', '9', '7771414733', 'TFJO220203', '5', '0', 'Es muy callado'),
('8', '10', '7772630012', 'OSDO240095', '5', '0', 'Es divertido y amable');

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

INSERT INTO trayectorias (id, idConductor, idVehiculo, capacidad, origen, destino, referencias, pago) VALUES
('1', '3', '1', '4', 'Grand Outlet Cuernavaca', 'UPEMOR', 'Frente a Farmacias Guadalajara', 'Efectivo'),
('2', '7', '2', '2', 'UPEMOR', 'Zona Arqueológica de Teopanzolco', 'En la caseta de entrada', 'Transferencia'),
('3', '8', '3', '3', 'Zócalo De Emiliano Zapata', 'UPEMOR', 'A una cuadra del zócalo', 'Efectivo'),
('4', '3', '1', '4', 'UPEMOR', 'Bodega Aurrera Yautepec', 'En el auditorio de LS2', 'Transferencia'),
('5', '7', '2', '2', 'Estadio Centenario', 'UPEMOR', 'En la curva rumbo a Avenida Universidad', 'Efectivo');

INSERT INTO detalleTrayectoria (id, idTrayectoria, idAlumno) VALUES
('1', '1', '4'),
('2', '1', '5'),
('3', '1', '6'),
('4', '2', '9'),
('5', '3', '10'),
('6', '4', '5'),
('7', '4', '6');

INSERT INTO avisos (id, titulo, mensaje) VALUES
('1', 'Seguridad', 'Usa el cinturón, aunque sea un viaje corto'),
('2', 'Seguridad', 'Presta atención a los señalamientos'),
('3', 'Seguridad', 'Asegúrate de compartir tu viaje con alguien de confianza'),
('4', 'Seguridad', 'No olvides tus pertenencias en el vehículo'),
('5', 'Información', 'Recuerda pagarle al conductor. Puede ser en efectivo o por transferencia'),
('6', 'Información', 'El conductor ha aceptado tu solicitud'),
('7', 'Información', 'El conductor ha rechazado tu solicitud'),
('8', 'Información', 'Tienes una nueva solicitud'),
('9', 'Calificación', 'Si tuviste una buena experiencia, no olvides dejar una calificación'),
('10', 'Asistencia', 'Si necesitas ayuda, por favor contacta a nuestro soporte');

INSERT INTO solicitudes (id, idAlumno, idTrayectoria, estado) VALUES
('1', '4', '1', 'aceptada'),
('2', '5', '2', 'pendiente'),
('3', '6', '3', 'rechazada');

select * from usuarios;
select * from perfiles;
select * from vehiculos;
select * from disponibilidad;
select * from trayectorias;
describe trayectorias;
select * from usuarios;


select * from detalleTrayectoria;
select * from avisos;
select * from solicitudes;

SELECT 
        t.id, 
        t.origen, 
        t.destino, 
        t.referencias, 
        t.capacidad, 
        u.nombre AS conductor, 
        v.marca, 
        v.modelo, 
        v.anio, 
        v.placas
    FROM trayectorias t
    JOIN usuarios u ON t.idConductor = u.id
    JOIN vehiculos v ON t.idVehiculo = v.id;
    
    
    SELECT 
    s.fechaSolicitud,
    s.estado,
    u1.nombre AS nombre_alumno,
    u1.correo AS email_alumno,
    u2.nombre AS nombre_conductor,
    t.origen,
    t.destino,
    v.marca,
    v.modelo,
    v.anio,
    t.capacidad,
    t.referencias
FROM solicitudes s
JOIN usuarios u1 ON s.idAlumno = u1.id
JOIN trayectorias t ON s.idTrayectoria = t.id
JOIN usuarios u2 ON t.idConductor = u2.id
JOIN vehiculos v ON t.idVehiculo = v.id;

select * from trayectorias;

drop trigger if exists after_update_solicitud;
DROP TRIGGER IF EXISTS after_update_solicitud;
DELIMITER //2

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

        INSERT INTO avisos (idAlumno, titulo, mensaje)
        VALUES 
            (NEW.idAlumno, 'Seguridad', 'Usa el cinturón, aunque sea un viaje corto'),
            (NEW.idAlumno, 'Seguridad', 'Presta atención a los señalamientos'),
            (NEW.idAlumno, 'Seguridad', 'No olvides tus pertenencias en el vehículo');

        -- Consulta del metodoPago solo si idTrayectoria existe en trayectorias
        SELECT pago INTO metodo_pago
        FROM trayectorias
        WHERE id = NEW.idTrayectoria;

        -- Insertar el aviso con el metodo_pago solo si no es NULL
        IF metodo_pago IS NOT NULL THEN
            INSERT INTO avisos (idAlumno, titulo, mensaje)
            VALUES (NEW.idAlumno, 'Información', CONCAT('Recuerda pagarle al conductor. Este viaje se paga por ', metodo_pago));
        END IF;

        -- Disminuir la capacidad de la trayectoria
        UPDATE trayectorias
        SET capacidad = capacidad - 1
        WHERE id = NEW.idTrayectoria AND capacidad > 0;
    END IF;
END //

DELIMITER ;




select * from solicitudes;


select * from detalletrayectoria;

select * from avisos;
SELECT * FROM trayectorias;


    SELECT 
        t.id, 
        t.origen, 
        t.destino, 
        t.referencias, 
        t.capacidad, 
        u.nombre AS conductor, 
        v.marca, 
        v.modelo, 
        v.anio, 
        v.placas
    FROM trayectorias t
    JOIN usuarios u ON t.idConductor = u.id
    JOIN vehiculos v ON t.idVehiculo = v.id
    WHERE t.capacidad > 0;
    
    select * from trayectorias;
    select * from
    select * from detalletrayectoria;
    














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
    nombreUser TEXT NOT NULL,
    matricula TEXT NOT NULL,
    telefono TEXT NOT NULL,
    viajes INT NOT NULL,
    informacion TEXT NOT NULL,
    imagen VARCHAR(255) NULL,
    FOREIGN KEY (idAlumno) REFERENCES usuarios(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
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
  ON DELETE CASCADE 
  ON UPDATE CASCADE
);

CREATE TABLE disponibilidad (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idConductor INT NOT NULL,
    dia ENUM('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo') NOT NULL,
    horaInicio TIME NOT NULL,
    horaFin TIME NOT NULL,
    FOREIGN KEY (idConductor) REFERENCES usuarios(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
);

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
    FOREIGN KEY (idConductor) REFERENCES usuarios(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
    FOREIGN KEY (idVehiculo) REFERENCES vehiculos(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
);

CREATE TABLE detalleTrayectoria (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idTrayectoria INT NOT NULL,
    idAlumno INT NOT NULL,
    estado_viaje ENUM('ninguno', 'iniciado', 'finalizado') DEFAULT 'ninguno',
    FOREIGN KEY (idTrayectoria) REFERENCES trayectorias2(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
    FOREIGN KEY (idAlumno) REFERENCES usuarios(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
);

CREATE TABLE avisos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idAlumno INT NOT NULL,
    titulo TEXT NOT NULL,
    mensaje TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idAlumno) REFERENCES usuarios(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
);

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
    FOREIGN KEY (idAlumno) REFERENCES usuarios(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
    FOREIGN KEY (idTrayectoria) REFERENCES trayectorias2(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
);

-- DISPARADORES

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
        FROM trayectorias2
        WHERE id = NEW.idTrayectoria;

        -- Disminuir la capacidad de la trayectoria
        UPDATE trayectorias2
        SET capacidad = capacidad - 1
        WHERE id = NEW.idTrayectoria AND capacidad > 0;
    END IF;
END //
DELIMITER ;

DROP TRIGGER IF EXISTS actualizarViajesYCrearAvisos;
DELIMITER //
CREATE TRIGGER actualizarViajesYCrearAvisos
AFTER UPDATE ON detalleTrayectoria
FOR EACH ROW
BEGIN
    -- Verificar que el estado cambió a 'finalizado'
    IF NEW.estado_viaje = 'finalizado' THEN
        -- Incrementar viajes del conductor asociado a la trayectoria
        UPDATE perfiles p
        JOIN trayectorias2 t ON t.id = NEW.idTrayectoria
        SET p.viajes = COALESCE(p.viajes, 0) + 1
        WHERE p.idAlumno = t.idConductor;

        -- Incrementar viajes de los alumnos asociados a la trayectoria
        UPDATE perfiles p
        JOIN detalleTrayectoria dt ON dt.idTrayectoria = NEW.idTrayectoria
        SET p.viajes = COALESCE(p.viajes, 0) + 1
        WHERE p.idAlumno = dt.idAlumno;

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

-- ----------------------------------------------- INSERCIÓN DE DATOS PARA PRUEBAS -----------------------------------------------

INSERT INTO usuarios (id, nombre, apellido, correo, usuario, contrasena, tipo) VALUES 
('1', 'Sandra', 'León', 'admin@upemor.edu.mx', 'admin', '1234', 'administrador'),
('2', 'Patrick', 'Perez', 'admin2@upemor.edu.mx', 'admin2', '1234', 'administrador'),
('3', 'Debanni', 'Morales', 'admin3@upemor.edu.mx', 'admin3', '1234', 'administrador'),
('4', 'Wendy', 'Moreno', 'wenmb@upemor.edu.mx', 'wen', '1234', 'conductor'),
('5', 'Yatziry', 'Serrano', 'yatzsh@upemor.edu.mx', 'yatz', '1234', 'alumno'),
('6', 'Dulce', 'Villega', 'dulvm@upemor.edu.mx', 'dul', '1234', 'alumno'),
('7', 'Jesus', 'Arizmendi', 'yisus@upemor.edu.mx', 'yisus', '1234', 'alumno'),
('8', 'Jorge', 'Alejandro', 'yorch@upemor.edu.mx', 'yorch', '1234', 'conductor'),
('9', 'Gerardo', 'Ascencio', 'gera@upemor.edu.mx', 'gera', '1234', 'conductor'),
('10', 'Jesus', 'Torres', 'jesusatf@upemor.edu.mx', 'jesusatf', '1234', 'alumno'),
('11', 'Fernando', 'Ortiz', 'fer@upemor.edu.mx', 'ferd', '1234', 'alumno'),
('12', 'Diego', 'Rodriguez', 'diegor@upemor.edu.mx', 'diegor', '1234', 'conductor'),
('13', 'Carlos', 'Gonzalez', 'carlosg@upemor.edu.mx', 'carlosg', '1234', 'alumno'),
('14', 'Laura', 'Lopez', 'laural@upemor.edu.mx', 'laural', '1234', 'alumno'),
('15', 'Juan', 'Rodriguez', 'juanr@upemor.edu.mx', 'juanr', '1234', 'alumno'),
('16', 'Ricardo', 'Santos', 'ricardos@upemor.edu.mx', 'ricardos', '1234', 'conductor'),
('17', 'Marta', 'Fernandez', 'martaf@upemor.edu.mx', 'martaf', '1234', 'alumno'),
('18', 'Luis', 'Hernandez', 'luish@upemor.edu.mx', 'luish', '1234', 'alumno'),
('19', 'Sofia', 'Martinez', 'sofia@upemor.edu.mx', 'sofia', '1234', 'alumno'),
('20', 'Ricardo', 'Perez', 'ricardop@upemor.edu.mx', 'ricardop', '1234', 'alumno'),
('21', 'Mariana', 'Gomez', 'marianag@upemor.edu.mx', 'marianag', '1234', 'alumno'),
('22', 'Javier', 'Gomez', 'javierg@upemor.edu.mx', 'javierg', '1234', 'conductor'),
('23', 'Angel', 'Moreno', 'angelm@upemor.edu.mx', 'angelm', '1234', 'alumno'),
('24', 'Esteban', 'Ruiz', 'estebanr@upemor.edu.mx', 'estebanr', '1234', 'alumno'),
('25', 'Santiago', 'Jimenez', 'santiagoj@upemor.edu.mx', 'santiagoj', '1234', 'alumno'),
('26', 'Jorge', 'Vega', 'jorgev@upemor.edu.mx', 'jorgev', '1234', 'conductor'),
('27', 'Antonio', 'Diaz', 'antoniod@upemor.edu.mx', 'antoniod', '1234', 'alumno'),
('28', 'Elena', 'Vazquez', 'elena@upemor.edu.mx', 'elena', '1234', 'alumno'),
('29', 'Fernando', 'Sanchez', 'fernandos@upemor.edu.mx', 'fernandos', '1234', 'alumno'),
('30', 'Berta', 'Sanchez', 'bertas@upemor.edu.mx', 'bertas', '1234', 'conductor'),
('31', 'Ricardo', 'Mendoza', 'ricardom@upemor.edu.mx', 'ricardom', '1234', 'alumno'),
('32', 'Valeria', 'Castillo', 'valeriac@upemor.edu.mx', 'valeriac', '1234', 'alumno'),
('33', 'Javier', 'Torres', 'javiert@upemor.edu.mx', 'javiert', '1234', 'alumno'),
('34', 'Raul', 'Jimenez', 'raulj@upemor.edu.mx', 'raulj', '1234', 'alumno'),
('35', 'Marcos', 'Moreno', 'marcosm@upemor.edu.mx', 'marcosm', '1234', 'conductor'),
('36', 'Vanessa', 'Morales', 'vanessam@upemor.edu.mx', 'vanessam', '1234', 'alumno'),
('37', 'Felipe', 'Garcia', 'felipeg@upemor.edu.mx', 'felipeg', '1234', 'alumno'),
('38', 'Luz', 'Solis', 'luzs@upemor.edu.mx', 'luzs', '1234', 'alumno'),
('39', 'Antonio', 'Rivas', 'antonior@upemor.edu.mx', 'antonior', '1234', 'alumno'),
('40', 'David', 'Navarro', 'davidn@upemor.edu.mx', 'davidn', '1234', 'alumno'),
('41', 'Olga', 'Perez', 'olgap@upemor.edu.mx', 'olgap', '1234', 'alumno'),
('42', 'Paola', 'Morales', 'paolam@upemor.edu.mx', 'paolam', '1234', 'alumno'),
('43', 'Fernando', 'Alvarez', 'fernandoa@upemor.edu.mx', 'fernandoa', '1234', 'alumno'),
('44', 'Camila', 'Rodriguez', 'camilar@upemor.edu.mx', 'camilar', '1234', 'alumno'),
('45', 'Diego', 'Gomez', 'diegog@upemor.edu.mx', 'diegog', '1234', 'conductor'),
('46', 'Hilda', 'Gonzalez', 'hildag@upemor.edu.mx', 'hildag', '1234', 'conductor'),
('47', 'Ricardo', 'Cruz', 'ricardoc@upemor.edu.mx', 'ricardoc', '1234', 'conductor'),
('48', 'Patricia', 'Lopez', 'patricial@upemor.edu.mx', 'patricial', '1234', 'conductor'),
('49', 'Jorge', 'Hernandez', 'jorgeh@upemor.edu.mx', 'jorgeh', '1234', 'conductor'),
('50', 'Nadia', 'Hernandez', 'nadiah@upemor.edu.mx', 'nadiah', '1234', 'conductor'),
('51', 'Javier', 'Cordero', 'javierc@upemor.edu.mx', 'javierc', '1234', 'conductor'),
('52', 'Andres', 'Cordero', 'andresc@upemor.edu.mx', 'andresc', '1234', 'conductor'),
('53', 'Jose', 'Diaz', 'josed@upemor.edu.mx', 'josed', '1234', 'conductor'),
('54', 'Marcos', 'Serrano', 'marcosserrano@upemor.edu.mx', 'marcosserrano', '1234', 'conductor'),
('55', 'Berenice', 'Ruiz', 'bertar@upemor.edu.mx', 'berer', '1234', 'conductor');


-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------

INSERT INTO perfiles (idAlumno, nombreUser, matricula, telefono, viajes, informacion, imagen) VALUES
(4, 'Wendy', 'MORWO229875', '7771234567', 14, 'Conductor alegre y divertido.', 'perfil.svg'),
(5, 'Yatziry', 'SEYO221234', '7771234577', 7, 'Estudiante de la carrera de ITI, apasionada por la tecnología y programación.', 'perfil.svg'),
(6, 'Dulce', 'VIDO221567', '7772345678', 3, 'Estudiante de la carrera de ITI, le gusta la innovación y el desarrollo web.', 'perfil.svg'),
(7, 'Jesus', 'MAYO221890', '7773456789', 1, 'Estudiante de la carrera de ITI, interesado en el análisis de datos y IA.', 'perfil.svg'),
(8, 'Jorge', 'ALEO221345', '7774567890', 12, 'Conductor con más de 3 años de experiencia, siempre puntual.', 'perfil.svg'),
(9, 'Gerardo', 'ASCY221678', '7775678901', 5, 'Conductor con licencia vigente, responsable y amable.', 'perfil.svg'),
(10, 'Jesus', 'TORE221234', '7776789012', 8, 'Estudiante de ITI, amante de la informática y los videojuegos.', 'perfil.svg'),
(11, 'Fernando', 'ORIE221345', '7777890123', 0, 'Estudiante de ITI, enfocado en la ciberseguridad y redes.', 'perfil.svg'),
(12, 'Diego', 'RODY221678', '7778901234', 15, 'Conductor experimentado, siempre dispuesto a ayudar a los pasajeros.', 'perfil.svg'),
(13, 'Carlos', 'GOLE221901', '7779012345', 4, 'Estudiante de ITI, interesado en el desarrollo de aplicaciones móviles.', 'perfil.svg'),
(14, 'Laura', 'LOPE221234', '7770123456', 9, 'Estudiante de ITI, entusiasta del diseño de interfaces de usuario.', 'perfil.svg'),
(15, 'Juan', 'RODR221567', '7771234501', 6, 'Estudiante de ITI, fascinado por la inteligencia artificial.', 'perfil.svg'),
(16, 'Ricardo', 'SANO221890', '7772345612', 2, 'Conductor con un estilo de conducción seguro y cómodo.', 'perfil.svg'),
(17, 'Marta', 'FERN221234', '7773456723', 11, 'Estudiante de ITI, interesada en el desarrollo de software de alto rendimiento.', 'perfil.svg'),
(18, 'Luis', 'HERA221345', '7774567834', 10, 'Estudiante de ITI, apoya a sus compañeros en proyectos colaborativos.', 'perfil.svg'),
(19, 'Sofia', 'MART221678', '7775678945', 0, 'Estudiante de ITI, apasionada por la computación en la nube.', 'perfil.svg'),
(20, 'Ricardo', 'PERE221234', '7776789056', 13, 'Conductor con años de experiencia en la ruta, siempre garantizando la seguridad.', 'perfil.svg'),
(21, 'Wendy', 'MOER221567', '7772345678', 4, 'Conductor con una excelente actitud hacia los estudiantes y pasajeros.', 'perfil.svg'),
(22, 'Santiago', 'JIME221234', '7773456789', 2, 'Estudiante, interesado en la ingeniería de software y la investigación.', 'perfil.svg'),
(23, 'Antonio', 'DIAZ221890', '7774567890', 7, 'Estudiante, enfocado en el desarrollo web y aplicaciones móviles.', 'perfil.svg'),
(24, 'Elena', 'VAZE221345', '7775678901', 10, 'Estudiante de ITI, le gusta el desarrollo de inteligencia artificial y la automatización.', 'perfil.svg'),
(25, 'Fernando', 'ALVA221678', '7776789012', 12, 'Estudiante, interesado en el mundo de la ciberseguridad y redes.', 'perfil.svg'),
(26, 'Berta', 'SANC221234', '7777890123', 0, 'Conductor, comprometida con la seguridad y bienestar de sus pasajeros.', 'perfil.svg'),
(27, 'Ricardo', 'MEND221567', '7778901234', 3, 'Estudiante de ITI, le gusta trabajar en proyectos colaborativos de tecnología.', 'perfil.svg'),
(28, 'Valeria', 'CAST221890', '7779012345', 5, 'Estudiante, interesada en el diseño de interfaces de usuario y experiencias digitales.', 'perfil.svg'),
(29, 'Javier', 'TORR221234', '7770123456', 6, 'Estudiante de ITI, le apasiona la investigación en tecnologías emergentes.', 'perfil.svg'),
(30, 'Raul', 'JIME221567', '7771234501', 9, 'Estudiante de ITI, interesado en el análisis de datos y la inteligencia artificial.', 'perfil.svg'),
(31, 'Marcos', 'MORE221890', '7772345612', 11, 'Conductor, siempre dispuesto a ofrecer un buen servicio y ayuda a los estudiantes.', 'perfil.svg'),
(32, 'Vanessa', 'MORA221234', '7773456723', 0, 'Estudiante de ITI, le interesa el diseño de sistemas y desarrollo de software.', 'perfil.svg'),
(33, 'Felipe', 'GARC221345', '7774567834', 2, 'Estudiante de ITI, apasionado por la tecnología y el software libre.', 'perfil.svg'),
(34, 'Luz', 'SOLI221678', '7775678945', 4, 'Estudiante, interesada en la programación de aplicaciones móviles y videojuegos.', 'perfil.svg'),
(35, 'Antonio', 'RIVA221901', '7776789056', 8, 'Estudiante, siempre dispuesto a aprender sobre nuevas tecnologías.', 'perfil.svg'),
(36, 'David', 'NAVA221234', '7777890123', 6, 'Estudiante de ITI, le apasiona la tecnología y la ciencia de datos.', 'perfil.svg'),
(37, 'Olga', 'PERE221567', '7778901234', 3, 'Estudiante de ITI, interesada en la automatización y el Internet de las Cosas (IoT).', 'perfil.svg'),
(38, 'Paola', 'MORA221890', '7779012345', 0, 'Estudiante de ITI, centrada en la programación de aplicaciones y videojuegos.', 'perfil.svg'),
(39, 'Camila', 'RODR221234', '7770123456', 10, 'Estudiante de ITI, fascinada por la inteligencia artificial y el análisis de datos.', 'perfil.svg'),
(40, 'Diego', 'GOME221567', '7771234501', 14, 'Conductor con vasta experiencia y gran conocimiento del área local.', 'perfil.svg'),
(41, 'Hilda', 'GONZ221890', '7772345612', 0, 'Conductor con buena disposición para servir a la comunidad universitaria.', 'perfil.svg'),
(42, 'Ricardo', 'CRUZ221234', '7773456723', 5, 'Conductor, con enfoque en la seguridad y comodidad de los pasajeros.', 'perfil.svg'),
(43, 'Patricia', 'LOPE221567', '7774567834', 1, 'Conductor comprometida con la puntualidad y el buen trato a los estudiantes.', 'perfil.svg'),
(44, 'Jorge', 'HERN221890', '7775678945', 9, 'Conductor con años de experiencia, siempre pendiente de la seguridad de sus pasajeros.', 'perfil.svg'),
(45, 'Nadia', 'HERN221234', '7776789056', 3, 'Conductor, excelente disposición para apoyar a los estudiantes con sus traslados.', 'perfil.svg'),
(46, 'Javier', 'CORR221567', '7777890123', 6, 'Conductor, apasionado por el servicio al cliente y la seguridad vial.', 'perfil.svg'),
(47, 'Andres', 'CORD221890', '7778901234', 7, 'Conductor, dedicado a ofrecer un viaje cómodo y seguro a todos sus pasajeros.', 'perfil.svg'),
(48, 'Jose', 'DIAZ221234', '7779012345', 0, 'Conductor, comprometido con el bienestar de los estudiantes y su puntualidad.', 'perfil.svg'),
(49, 'Marcos', 'SERR221567', '7770123456', 10, 'Conductor, amable, respetuoso y siempre dispuesto a ayudar en el viaje.', 'perfil.svg'),
(50, 'Berenice', 'RUIZ221890', '7771234501', 4, 'Conductor con un historial de seguridad ejemplar, ideal para traslados universitarios.', 'perfil.svg');



-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------

INSERT INTO vehiculos (idConductor, marca, modelo, anio, placas, color) VALUES
(4, 'Toyota', 'Corolla', 2015, 'XYZ-123', 'Rojo'),
(4, 'Mazda', 'CX-5', 2018, 'HJK-234', 'Negro'),
(8, 'Honda', 'Civic', 2020, 'LMN-789', 'Azul'),
(9, 'Chevrolet', 'Malibu', 2017, 'PQR-234', 'Negro'),
(9, 'Ford', 'Fiesta', 2016, 'LMO-567', 'Verde'),
(12, 'Hyundai', 'Elantra', 2021, 'MNO-456', 'Plata'),
(12, 'Kia', 'Optima', 2022, 'ABC-123', 'Blanco'),
(16, 'Volkswagen', 'Golf', 2014, 'RST-789', 'Azul'),
(22, 'Ford', 'Focus', 2019, 'ABC-456', 'Blanco'),
(22, 'BMW', 'Serie 1', 2021, 'DEF-234', 'Rojo'),
(26, 'Nissan', 'Altima', 2013, 'DEF-567', 'Gris'),
(26, 'Toyota', 'RAV4', 2022, 'GHI-234', 'Azul'),
(30, 'Chevrolet', 'Cruze', 2018, 'WXY-567', 'Verde'),
(30, 'Hyundai', 'Sonata', 2016, 'JKL-890', 'Plata'),
(35, 'BMW', 'Serie 3', 2020, 'ZAB-890', 'Rojo'),
(35, 'Audi', 'A4', 2017, 'CDE-123', 'Negro'),
(45, 'Audi', 'A4', 2015, 'CDE-234', 'Plata'),
(45, 'Mercedes-Benz', 'Clase C', 2019, 'FGH-456', 'Negro'),
(46, 'Mercedes-Benz', 'GLC', 2021, 'IJK-789', 'Blanco'),
(47, 'Mazda', 'CX-5', 2020, 'IJK-234', 'Gris'),
(47, 'Toyota', 'Highlander', 2017, 'LMN-678', 'Rojo'),
(48, 'Honda', 'Accord', 2018, 'LMN-890', 'Rojo'),
(48, 'Chevrolet', 'Equinox', 2020, 'OPQ-123', 'Verde'),
(49, 'Ford', 'Mustang', 2022, 'OPQ-234', 'Amarillo'),
(49, 'Nissan', '370Z', 2014, 'RST-234', 'Azul'),
(50, 'Nissan', 'Versa', 2019, 'RST-345', 'Azul'),
(50, 'Kia', 'Seltos', 2021, 'UVW-567', 'Blanco'),
(51, 'Chevrolet', 'Traverse', 2020, 'UVW-678', 'Negro'),
(51, 'Mazda', 'MX-5 Miata', 2022, 'WXY-789', 'Rojo'),
(52, 'Toyota', 'Highlander', 2023, 'XYZ-890', 'Gris'),
(53, 'Ford', 'Escape', 2015, 'BCD-123', 'Blanco'),
(54, 'Mazda', 'MX-5 Miata', 2019, 'EFG-456', 'Rojo'),
(54, 'Hyundai', 'Sonata', 2021, 'HIJ-789', 'Plata'),
(55, 'Honda', 'Pilot', 2020, 'JKL-890', 'Azul');

-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------

INSERT INTO disponibilidad (idConductor, dia, horaInicio, horaFin) VALUES
(4, 'Lunes', '07:00:00', '09:00:00'),
(4, 'Miércoles', '10:00:00', '12:00:00'),
(4, 'Viernes', '15:00:00', '17:00:00'),
(8, 'Lunes', '08:00:00', '10:00:00'),
(8, 'Miércoles', '11:00:00', '13:00:00'),
(9, 'Miércoles', '09:00:00', '11:00:00'),
(9, 'Viernes', '14:00:00', '16:00:00'),
(12, 'Lunes', '08:00:00', '10:00:00'),
(12, 'Martes', '11:00:00', '13:00:00'),
(12, 'Jueves', '15:00:00', '17:00:00'),
(16, 'Lunes', '07:00:00', '09:00:00'),
(16, 'Miércoles', '10:00:00', '12:00:00'),
(22, 'Martes', '08:00:00', '10:00:00'),
(22, 'Jueves', '11:00:00', '13:00:00'),
(26, 'Lunes', '09:00:00', '11:00:00'),
(26, 'Miércoles', '14:00:00', '16:00:00'),
(30, 'Martes', '07:00:00', '09:00:00'),
(30, 'Jueves', '10:00:00', '12:00:00'),
(35, 'Lunes', '08:00:00', '10:00:00'),
(35, 'Miércoles', '09:00:00', '11:00:00'),
(45, 'Martes', '07:00:00', '09:00:00'),
(45, 'Jueves', '10:00:00', '12:00:00'),
(46, 'Lunes', '10:00:00', '12:00:00'),
(46, 'Miércoles', '14:00:00', '16:00:00'),
(47, 'Martes', '08:00:00', '10:00:00'),
(47, 'Viernes', '13:00:00', '15:00:00'),
(48, 'Lunes', '09:00:00', '11:00:00'),
(48, 'Miércoles', '12:00:00', '14:00:00'),
(49, 'Jueves', '07:00:00', '09:00:00'),
(49, 'Viernes', '10:00:00', '12:00:00'),
(50, 'Lunes', '08:00:00', '10:00:00'),
(50, 'Miércoles', '11:00:00', '13:00:00'),
(51, 'Martes', '07:00:00', '09:00:00'),
(51, 'Jueves', '10:00:00', '12:00:00'),
(52, 'Lunes', '09:00:00', '11:00:00'),
(52, 'Miércoles', '13:00:00', '15:00:00'),
(53, 'Martes', '07:00:00', '09:00:00'),
(53, 'Jueves', '10:00:00', '12:00:00'),
(54, 'Lunes', '08:00:00', '10:00:00'),
(54, 'Miércoles', '11:00:00', '13:00:00'),
(55, 'Viernes', '08:00:00', '10:00:00');

-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------

INSERT INTO trayectorias2 (idConductor, idVehiculo, capacidad, origen, destino, referencias, pago, estado_viaje) VALUES
(4, 1, 4, 'UPEMOR', 'Fraccionamiento Rincón del Orujo', 'Cerca de la iglesia de Zapata', 'Transferencia', 'ninguno'),
(8, 2, 3, 'Zócalo de Jiutepec', 'UPEMOR', 'Cerca de la tienda Soriana', 'Efectivo', 'iniciado'),
(9, 3, 2, 'Parque Ecológico San Miguel Acapantzingo', 'UPEMOR', 'Frente a la tienda OXXO', 'Transferencia', 'finalizado'),
(12, 4, 1, 'Centro Cultural Teopanzolco', 'UPEMOR', 'Cerca de la pirámide de Teopanzolco', 'Efectivo', 'ninguno'),
(16, 5, 4, 'Fuente Civac', 'UPEMOR', 'Frente a la gasolinera', 'Transferencia', 'iniciado'),
(22, 6, 2, 'UPEMOR', 'Crucero de Tejalpa', 'Cruzando el puente del Mega', 'Efectivo', 'finalizado'),
(26, 7, 3, 'UPEMOR', 'Mercado Adolfo López Mateos', 'Cerca del mercado de La Selva', 'Transferencia', 'ninguno'),
(30, 8, 4, 'Nissan Civac', 'UPEMOR', 'En la parada del Walmart', 'Efectivo', 'iniciado'),
(35, 9, 2, 'Glorieta Paloma de la Paz', 'UPEMOR', 'En la parada frente al CUADEM', 'Transferencia', 'finalizado'),
(45, 10, 3, 'UPEMOR', 'Súper Chedraui Chamilpa', 'Frente al OXXO', 'Efectivo', 'ninguno'),
(46, 11, 1, 'Costco Wholesale Cuernavaca', 'UPEMOR', 'Cerca del Papalote', 'Transferencia', 'iniciado'),
(47, 12, 4, 'Zócalo de Cuernavaca', 'UPEMOR', 'Frente al Palacio de Cortés', 'Efectivo', 'finalizado');

-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------

INSERT INTO avisos (idAlumno, titulo, mensaje) VALUES
(4, 'Usa el cinturón de seguridad', 'Por favor, asegúrate de utilizar el cinturón durante el viaje para tu seguridad.'),
(5, 'Recuerda tu pago', 'No olvides realizar el pago correspondiente al conductor al finalizar tu trayecto.'),
(6, 'No olvides tus pertenencias', 'Antes de bajar del vehículo, verifica que no dejes nada en el asiento.'),
(7, 'Viaje finalizado', 'Tu viaje ha concluido. ¡Gracias por usar nuestro servicio!'),
(8, 'Sé puntual', 'Llega a tiempo al punto de encuentro para evitar retrasos.'),
(9, 'Comunica cambios', 'Si tienes un cambio de planes, avisa a tu conductor con tiempo.'),
(10, 'Mantén el vehículo limpio', 'Ayuda al conductor manteniendo el vehículo en buen estado durante el trayecto.'),
(11, 'Respeta las normas de tránsito', 'Por favor, colabora respetando las indicaciones del conductor.'),
(12, 'Actualiza tu disponibilidad', 'Si eres conductor, actualiza tu disponibilidad para ofrecer más trayectos.'),
(13, 'Viaje compartido', 'Se ha añadido un nuevo pasajero a tu trayecto.');

-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------

INSERT INTO avisosGeneral (titulo, mensaje) VALUES
('Periodo vacacional', 'El periodo vacacional será del 14 de diciembre al 5 de enero.'),
('Compartir vehículos ayuda al ambiente', 'Por cada viaje compartido, se reduce el CO2 emitido al medio ambiente. ¡Sigue así!'),
('Registra tu disponibilidad', 'Si eres conductor, recuerda registrar tu disponibilidad para nuevos trayectos.'),
('Apoya la puntualidad', 'Llegar a tiempo al punto de encuentro asegura un trayecto más ágil para todos.'),
('Protocolo de seguridad', 'Usar cinturón de seguridad es obligatorio en todos los viajes.'),
('Apoyo comunitario', 'Compartir tu trayecto ayuda a estudiantes que necesitan transporte económico y seguro.'),
('Cuida el vehículo', 'Mantener el vehículo en buenas condiciones asegura un servicio de calidad.'),
('Evita cancelar de último momento', 'Los cambios repentinos afectan la planificación del conductor y otros pasajeros.'),
('Nuevas rutas disponibles', 'Revisa las nuevas rutas añadidas por conductores. ¡Explora tus opciones!'),
('Recompensa para los conductores', 'Al compartir su trayecto, los conductores reciben beneficios económicos y ayudan al ambiente.');
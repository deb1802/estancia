SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS sustentable;

USE sustentable;

DROP TABLE IF EXISTS avisos;

CREATE TABLE `avisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAlumno` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idAlumno` (`idAlumno`),
  CONSTRAINT `avisos_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=392 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO avisos VALUES("328","6","Información","El conductor ha aceptado tu solicitud el 2024-11-13 16:03:24","2024-11-13 16:03:24");
INSERT INTO avisos VALUES("329","6","Seguridad","Usa el cinturón, aunque sea un viaje corto","2024-11-13 16:03:24");
INSERT INTO avisos VALUES("330","6","Seguridad","Presta atención a los señalamientos","2024-11-13 16:03:24");
INSERT INTO avisos VALUES("331","6","Seguridad","No olvides tus pertenencias en el vehículo","2024-11-13 16:03:24");
INSERT INTO avisos VALUES("332","6","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-13 16:03:24");
INSERT INTO avisos VALUES("333","6","Información","El conductor ha aceptado tu solicitud el 2024-11-13 16:04:17","2024-11-13 16:04:17");
INSERT INTO avisos VALUES("334","6","Seguridad","Usa el cinturón, aunque sea un viaje corto","2024-11-13 16:04:17");
INSERT INTO avisos VALUES("335","6","Seguridad","Presta atención a los señalamientos","2024-11-13 16:04:17");
INSERT INTO avisos VALUES("336","6","Seguridad","No olvides tus pertenencias en el vehículo","2024-11-13 16:04:17");
INSERT INTO avisos VALUES("337","6","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-13 16:04:17");
INSERT INTO avisos VALUES("338","6","Información","El conductor ha aceptado tu solicitud el 2024-11-13 16:18:45","2024-11-13 16:18:45");
INSERT INTO avisos VALUES("339","6","Seguridad","Usa el cinturón, aunque sea un viaje corto","2024-11-13 16:18:45");
INSERT INTO avisos VALUES("340","6","Seguridad","Presta atención a los señalamientos","2024-11-13 16:18:45");
INSERT INTO avisos VALUES("341","6","Seguridad","No olvides tus pertenencias en el vehículo","2024-11-13 16:18:45");
INSERT INTO avisos VALUES("342","6","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-13 16:18:45");
INSERT INTO avisos VALUES("343","6","Información","El conductor ha aceptado tu solicitud el 2024-11-13 20:38:30","2024-11-13 20:38:30");
INSERT INTO avisos VALUES("344","6","Seguridad","Usa el cinturón, aunque sea un viaje corto","2024-11-13 20:38:30");
INSERT INTO avisos VALUES("345","6","Seguridad","Presta atención a los señalamientos","2024-11-13 20:38:30");
INSERT INTO avisos VALUES("346","6","Seguridad","No olvides tus pertenencias en el vehículo","2024-11-13 20:38:30");
INSERT INTO avisos VALUES("347","6","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-13 20:38:30");
INSERT INTO avisos VALUES("348","6","Información","El conductor ha aceptado tu solicitud el 2024-11-13 20:58:10","2024-11-13 20:58:10");
INSERT INTO avisos VALUES("349","6","Seguridad","Usa el cinturón, aunque sea un viaje corto","2024-11-13 20:58:10");
INSERT INTO avisos VALUES("350","6","Seguridad","Presta atención a los señalamientos","2024-11-13 20:58:10");
INSERT INTO avisos VALUES("351","6","Seguridad","No olvides tus pertenencias en el vehículo","2024-11-13 20:58:10");
INSERT INTO avisos VALUES("352","6","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-13 20:58:10");
INSERT INTO avisos VALUES("353","6","Información","El conductor ha aceptado tu solicitud el 2024-11-16 11:31:47","2024-11-16 11:31:47");
INSERT INTO avisos VALUES("354","6","Seguridad","Usa el cinturón, aunque sea un viaje corto","2024-11-16 11:31:47");
INSERT INTO avisos VALUES("355","6","Seguridad","Presta atención a los señalamientos","2024-11-16 11:31:47");
INSERT INTO avisos VALUES("356","6","Seguridad","No olvides tus pertenencias en el vehículo","2024-11-16 11:31:47");
INSERT INTO avisos VALUES("357","6","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-16 11:31:47");
INSERT INTO avisos VALUES("358","6","Información","El conductor ha aceptado tu solicitud el 2024-11-16 11:44:20","2024-11-16 11:44:20");
INSERT INTO avisos VALUES("359","6","Seguridad","Usa el cinturón, aunque sea un viaje corto","2024-11-16 11:44:20");
INSERT INTO avisos VALUES("360","6","Seguridad","Presta atención a los señalamientos","2024-11-16 11:44:20");
INSERT INTO avisos VALUES("361","6","Seguridad","No olvides tus pertenencias en el vehículo","2024-11-16 11:44:20");
INSERT INTO avisos VALUES("362","6","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-16 11:44:20");
INSERT INTO avisos VALUES("363","6","Información","El conductor ha aceptado tu solicitud el 2024-11-16 11:44:32","2024-11-16 11:44:32");
INSERT INTO avisos VALUES("364","6","Seguridad","Usa el cinturón, aunque sea un viaje corto","2024-11-16 11:44:32");
INSERT INTO avisos VALUES("365","6","Seguridad","Presta atención a los señalamientos","2024-11-16 11:44:32");
INSERT INTO avisos VALUES("366","6","Seguridad","No olvides tus pertenencias en el vehículo","2024-11-16 11:44:32");
INSERT INTO avisos VALUES("367","6","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-16 11:44:32");
INSERT INTO avisos VALUES("368","6","Información","El conductor ha aceptado tu solicitud el 2024-11-16 11:44:45","2024-11-16 11:44:45");
INSERT INTO avisos VALUES("369","6","Seguridad","Usa el cinturón, aunque sea un viaje corto","2024-11-16 11:44:45");
INSERT INTO avisos VALUES("370","6","Seguridad","Presta atención a los señalamientos","2024-11-16 11:44:45");
INSERT INTO avisos VALUES("371","6","Seguridad","No olvides tus pertenencias en el vehículo","2024-11-16 11:44:45");
INSERT INTO avisos VALUES("372","6","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-16 11:44:45");
INSERT INTO avisos VALUES("373","5","Información","El conductor ha aceptado tu solicitud el 2024-11-16 12:19:12","2024-11-16 12:19:12");
INSERT INTO avisos VALUES("374","5","Seguridad","Usa el cinturón, aunque sea un viaje corto","2024-11-16 12:19:12");
INSERT INTO avisos VALUES("375","5","Seguridad","Presta atención a los señalamientos","2024-11-16 12:19:12");
INSERT INTO avisos VALUES("376","5","Seguridad","No olvides tus pertenencias en el vehículo","2024-11-16 12:19:12");
INSERT INTO avisos VALUES("377","5","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-16 12:19:12");
INSERT INTO avisos VALUES("378","10","Información","El conductor ha aceptado tu solicitud el 2024-11-16 17:03:56","2024-11-16 17:03:56");
INSERT INTO avisos VALUES("379","10","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-16 17:03:56");
INSERT INTO avisos VALUES("380","11","Información","El conductor ha aceptado tu solicitud el 2024-11-16 17:20:12","2024-11-16 17:20:12");
INSERT INTO avisos VALUES("381","11","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-16 17:20:12");
INSERT INTO avisos VALUES("382","11","Información","El conductor ha aceptado tu solicitud el 2024-11-16 17:36:34","2024-11-16 17:36:34");
INSERT INTO avisos VALUES("383","11","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-16 17:36:34");
INSERT INTO avisos VALUES("384","11","Información","El conductor ha aceptado tu solicitud el 2024-11-16 17:52:35","2024-11-16 17:52:35");
INSERT INTO avisos VALUES("385","11","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-16 17:52:35");
INSERT INTO avisos VALUES("386","11","Información","El conductor ha aceptado tu solicitud el 2024-11-17 07:58:13","2024-11-17 07:58:13");
INSERT INTO avisos VALUES("387","11","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-17 07:58:13");
INSERT INTO avisos VALUES("388","11","Información","El conductor ha aceptado tu solicitud el 2024-11-17 09:07:56","2024-11-17 09:07:56");
INSERT INTO avisos VALUES("389","11","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-17 09:07:56");
INSERT INTO avisos VALUES("390","11","Información","Recuerda pagarle al conductor. Este viaje se paga por Efectivo","2024-11-18 09:08:57");
INSERT INTO avisos VALUES("391","11","Viaje Finalizado","Tu viaje finalizó el día 2024-11-18 a las 09:08:57","2024-11-18 09:08:57");



DROP TABLE IF EXISTS avisosgeneral;

CREATE TABLE `avisosgeneral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO avisosgeneral VALUES("1","Información general","buen fin para todosssss en upemorv\n","2024-11-19 10:41:05");



DROP TABLE IF EXISTS detalletrayectoria;

CREATE TABLE `detalletrayectoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTrayectoria` int(11) NOT NULL,
  `idAlumno` int(11) NOT NULL,
  `estado_viaje` enum('ninguno','iniciado','finalizado') DEFAULT 'ninguno',
  PRIMARY KEY (`id`),
  KEY `idTrayectoria` (`idTrayectoria`),
  CONSTRAINT `detalletrayectoria_ibfk_1` FOREIGN KEY (`idTrayectoria`) REFERENCES `trayectorias2` (`id`),
  CONSTRAINT `idTrayectoria` FOREIGN KEY (`idTrayectoria`) REFERENCES `trayectorias2` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO detalletrayectoria VALUES("2","4","11","finalizado");



DROP TABLE IF EXISTS disponibilidad;

CREATE TABLE `disponibilidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idConductor` int(11) NOT NULL,
  `dia` enum('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo') NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idConductor` (`idConductor`),
  CONSTRAINT `disponibilidad_ibfk_1` FOREIGN KEY (`idConductor`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO disponibilidad VALUES("1","3","Lunes","09:30:00","12:00:00");
INSERT INTO disponibilidad VALUES("2","7","Martes","12:00:00","16:00:00");
INSERT INTO disponibilidad VALUES("3","8","Miércoles","08:00:00","12:00:00");
INSERT INTO disponibilidad VALUES("4","3","Jueves","15:00:00","19:00:00");



DROP TABLE IF EXISTS perfiles;

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAlumno` int(11) NOT NULL,
  `nombreUser` text DEFAULT NULL,
  `matricula` text DEFAULT NULL,
  `telefono` text NOT NULL,
  `valoracion` enum('1','2','3','4','5') DEFAULT NULL,
  `viajes` int(11) DEFAULT NULL,
  `informacion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAlumno` (`idAlumno`),
  CONSTRAINT `perfiles_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO perfiles VALUES("4","6","yisuscry18","OSDO240095","7773838392","","0","ME GUSTA YATZ","../../estancia/uploads/fotosperfil/jesus.jpg");
INSERT INTO perfiles VALUES("10","3","weny","MBWO220238","7773838392","","0","Me gusta robert","../../estancia/uploads/fotosperfil/wendys.jpg");
INSERT INTO perfiles VALUES("11","5","dulYess","VMDO220377","7776895461","","0","Holi","../../estancia/uploads/fotosperfil/dul.jpg");



DROP TABLE IF EXISTS solicitudes;

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAlumno` int(11) NOT NULL,
  `idTrayectoria` int(11) NOT NULL,
  `fechaSolicitud` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','aceptada','rechazada') NOT NULL DEFAULT 'pendiente',
  PRIMARY KEY (`id`),
  KEY `idAlumno` (`idAlumno`),
  KEY `idTrayectoria` (`idTrayectoria`),
  CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `solicitudes_ibfk_2` FOREIGN KEY (`idTrayectoria`) REFERENCES `trayectorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO solicitudes VALUES("43","6","1","2024-11-16 11:31:07","aceptada");
INSERT INTO solicitudes VALUES("44","5","1","2024-11-16 12:18:46","aceptada");
INSERT INTO solicitudes VALUES("45","10","1","2024-11-16 17:03:38","aceptada");
INSERT INTO solicitudes VALUES("46","11","1","2024-11-16 17:20:00","aceptada");
INSERT INTO solicitudes VALUES("47","11","3","2024-11-16 17:36:15","aceptada");
INSERT INTO solicitudes VALUES("48","11","3","2024-11-16 17:52:21","aceptada");
INSERT INTO solicitudes VALUES("49","11","3","2024-11-17 07:58:00","aceptada");
INSERT INTO solicitudes VALUES("50","11","4","2024-11-17 09:05:19","aceptada");



DROP TABLE IF EXISTS trayectorias;

CREATE TABLE `trayectorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idConductor` int(11) NOT NULL,
  `idVehiculo` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `origen` text NOT NULL,
  `destino` text NOT NULL,
  `referencias` text DEFAULT NULL,
  `pago` enum('Efectivo','Transferencia') NOT NULL,
  `lat_origen` decimal(9,6) NOT NULL,
  `lon_origen` decimal(9,6) NOT NULL,
  `lat_destino` decimal(9,6) NOT NULL,
  `lon_destino` decimal(9,6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idVehiculo` (`idVehiculo`),
  CONSTRAINT `trayectorias_ibfk_1` FOREIGN KEY (`idVehiculo`) REFERENCES `vehiculos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO trayectorias VALUES("1","8","3","0","la alameda jiutepec","upemor","en el banco banamex","Efectivo","18.890534","-99.143633","0.000000","0.000000");
INSERT INTO trayectorias VALUES("2","0","3","1","Chedraui, Plaza Chedraui, Cuernavaca, Morelos 62430, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","fuera de la asa","Efectivo","0.000000","0.000000","0.000000","0.000000");
INSERT INTO trayectorias VALUES("3","0","3","2","Chedraui, Plaza Chedraui, Cuernavaca, Morelos 62430, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","fuera de la asa","Efectivo","0.000000","0.000000","0.000000","0.000000");
INSERT INTO trayectorias VALUES("4","0","3","2","Chedraui, Plaza Chedraui, Cuernavaca, Morelos 62430, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","fuera de la asa","Efectivo","0.000000","0.000000","0.000000","0.000000");
INSERT INTO trayectorias VALUES("5","0","3","3","IMSS Jiutepec, Zócalo, Jiutepec, Morelos 62550, Mexico","Boulevard Paseo Cuauhnáhuac 566, 62577 Jiutepec, Morelos, Mexico","prueba","Efectivo","0.000000","0.000000","0.000000","0.000000");
INSERT INTO trayectorias VALUES("6","8","3","0","IMSS Jiutepec, Zócalo, Jiutepec, Morelos 62550, Mexico","Boulevard Paseo Cuauhnáhuac 566, 62577 Jiutepec, Morelos, Mexico","jjjk","Efectivo","0.000000","0.000000","0.000000","0.000000");
INSERT INTO trayectorias VALUES("9","8","3","5","Chedraui, Plaza Chedraui, Cuernavaca, Morelos 62430, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","jjjk","Efectivo","0.000000","0.000000","0.000000","0.000000");
INSERT INTO trayectorias VALUES("10","7","2","0","IMSS Jiutepec, Zócalo, Jiutepec, Morelos 62550, Mexico","Boulevard Paseo Cuauhnáhuac 566, 62577 Jiutepec, Morelos, Mexico","deba fer","Efectivo","0.000000","0.000000","0.000000","0.000000");



DROP TABLE IF EXISTS trayectorias1;

CREATE TABLE `trayectorias1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idConductor` int(11) NOT NULL,
  `idVehiculo` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `origen` text NOT NULL,
  `destino` text NOT NULL,
  `referencias` text DEFAULT NULL,
  `pago` enum('Efectivo','Transferencia') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idVehiculo` (`idVehiculo`),
  CONSTRAINT `trayectorias1_ibfk_1` FOREIGN KEY (`idVehiculo`) REFERENCES `vehiculos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO trayectorias1 VALUES("1","8","3","2","IMSS Jiutepec, Zócalo, Jiutepec, Morelos 62550, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","hola","Efectivo");
INSERT INTO trayectorias1 VALUES("2","8","3","1","Jiutepec, Morelos, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","hola","Efectivo");
INSERT INTO trayectorias1 VALUES("3","8","3","2","IMSS Cuernavaca, Plan de Ayala, Cuernavaca, Morelos 62430, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","hola","Efectivo");
INSERT INTO trayectorias1 VALUES("4","8","3","18","Jiutepec, Morelos, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","hola","Efectivo");
INSERT INTO trayectorias1 VALUES("5","8","3","1","Jiutepec, Morelos, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","hola","Efectivo");
INSERT INTO trayectorias1 VALUES("6","8","3","1","Jiutepec, Morelos, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","holaaa","Efectivo");
INSERT INTO trayectorias1 VALUES("7","8","3","1","Jiutepec, Morelos, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","holaaa","Efectivo");
INSERT INTO trayectorias1 VALUES("8","8","3","1","Jiutepec, Morelos, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","hola fer","Efectivo");
INSERT INTO trayectorias1 VALUES("9","8","3","1","Jiutepec, Morelos, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","holaaa","Efectivo");
INSERT INTO trayectorias1 VALUES("10","8","3","2","Jiutepec, Morelos, Mexico","UPEMOR, Boulevard Cuauhnáhuac #566, Col. Lomas del Texcal, Jiutepec, Morelos 62574, Mexico","hola","Efectivo");



DROP TABLE IF EXISTS trayectorias2;

CREATE TABLE `trayectorias2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idConductor` int(11) NOT NULL,
  `idVehiculo` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `origen` text NOT NULL,
  `destino` text NOT NULL,
  `referencias` text DEFAULT NULL,
  `pago` enum('Efectivo','Transferencia') NOT NULL,
  `estado_viaje` enum('ninguno','iniciado','finalizado') DEFAULT 'ninguno',
  PRIMARY KEY (`id`),
  KEY `idVehiculo` (`idVehiculo`),
  CONSTRAINT `trayectorias2_ibfk_1` FOREIGN KEY (`idVehiculo`) REFERENCES `vehiculos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO trayectorias2 VALUES("4","7","2","2","Av. San Isidro 21, San Francisco Tetecala, Azcapotzalco, 02730 Ciudad de México, CDMX","upemor","hola","Efectivo","ninguno");
INSERT INTO trayectorias2 VALUES("8","3","1","30","chedraui tejalpa","upemor","","Efectivo","ninguno");



DROP TABLE IF EXISTS usuarios;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `correo` text NOT NULL,
  `usuario` text NOT NULL,
  `contrasena` text NOT NULL,
  `tipo` enum('alumno','conductor','administrador') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO usuarios VALUES("1","Debanni","Morales","admin@upemor.edu.mx","admin","1234","administrador");
INSERT INTO usuarios VALUES("2","Patrick","Perez","admin2@upemor.edu.mx","admin2","1234","administrador");
INSERT INTO usuarios VALUES("3","Wendy","Moreno","wenmb@upemor.edu.mx","wen","1234","conductor");
INSERT INTO usuarios VALUES("4","Yatziry","Serrano","yatzsh@upemor.edu.mx","yatz","1234","alumno");
INSERT INTO usuarios VALUES("5","Dulce","Villega","dulvm@upemor.edu.mx","dul","1234","alumno");
INSERT INTO usuarios VALUES("6","Jesus","Arizmendi","yisus@upemor.edu.mx","yisus","1234","alumno");
INSERT INTO usuarios VALUES("7","Jorge","Alejandro","yorch@upemor.edu.mx","yorch","1234","conductor");
INSERT INTO usuarios VALUES("8","Gerardo","Ascencio","gera@upemor.edu.mx","gera","1234","conductor");
INSERT INTO usuarios VALUES("9","Jesus","Torres","jesusatf@upemor.edu.mx","jesusatf","1234","alumno");
INSERT INTO usuarios VALUES("10","Fernando","Ortiz","fer@upemor.edu.mx","ferso","1234","alumno");
INSERT INTO usuarios VALUES("11","Debanni","Morales","debannimorales.15@gmail.com","debanni","deba1802","alumno");
INSERT INTO usuarios VALUES("12","Debanni","Morales","debannimorales.15@gmail.com","debafer","deba1802","alumno");



DROP TABLE IF EXISTS vehiculos;

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idConductor` int(11) NOT NULL,
  `marca` text NOT NULL,
  `modelo` text NOT NULL,
  `anio` int(11) NOT NULL,
  `placas` text NOT NULL,
  `color` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idConductor` (`idConductor`),
  CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`idConductor`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO vehiculos VALUES("1","3","Volkswagen","Jetta","2000","HBC-405-B","Rojo");
INSERT INTO vehiculos VALUES("2","7","Volkswagen","Clasico","2014","PYA-45-06","Gris");
INSERT INTO vehiculos VALUES("3","8","Volkswagen","Beetle","1987","RNB-88-54","Blanco");



SET FOREIGN_KEY_CHECKS=1;
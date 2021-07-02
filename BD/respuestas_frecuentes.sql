CREATE TABLE `respuestas_frecuentes` (
  `tipo_id` int(1) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `id_respuesta` int(11) NOT NULL AUTO_INCREMENT,
  `respuesta` varchar(3000) NOT NULL,
  `link` varchar(3000) DEFAULT NULL,
  `orden_aparicion` int(3) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_respuesta`),
  KEY `id_pregunta` (`id_pregunta`),
  CONSTRAINT `respuestas_frecuentes_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas_frecuentes` (`id_pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
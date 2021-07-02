CREATE TABLE `preguntas_frecuentes` (
  `Tipo_id` int(1) NOT NULL,
  `id_pregunta` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(3000) NOT NULL,
  `orden_aparicion` int(3) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
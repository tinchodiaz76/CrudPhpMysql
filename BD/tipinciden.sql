CREATE TABLE `tipinciden` (
  `Tipo_id` int(1) unsigned zerofill NOT NULL,
  `Id_area` int(11) NOT NULL,
  `Tipo_incidencia` int(11) NOT NULL AUTO_INCREMENT,
  `descrip_inciden` varchar(3000) NOT NULL,
  `texto_resolucion` varchar(3000) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `mas_informacion` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Tipo_incidencia`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

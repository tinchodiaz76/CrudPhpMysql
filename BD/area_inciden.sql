CREATE TABLE `area_inciden` (
  `Tipo_id` int(1) DEFAULT NULL,
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `descrip_area` varchar(3000) NOT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
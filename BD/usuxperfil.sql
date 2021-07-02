CREATE TABLE `usuxperfil` (
  `username` varchar(20) NOT NULL,
  `tipo_incidencia` int(1) NOT NULL,
  PRIMARY KEY (`username`,`tipo_incidencia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
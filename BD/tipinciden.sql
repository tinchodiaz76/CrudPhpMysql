create table ywayqssx_MA.tipinciden (
	
	Tipo_id	 int(1)  not null,
	Id_area  int(11)  not null,
 
	Tipo_incidencia  int(11) AUTO_INCREMENT primary key,

	descrip_inciden varchar(3000)  not null,
 
	texto_resolucion varchar(3000),
	estado   int(1)
	);
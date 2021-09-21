create table unaj.tipinciden (	
	Tipo_id	 int(1)  not null,
	Id_area  int(11)  not null,
	Tipo_incidencia  int(11) AUTO_INCREMENT primary key,
	descrip_inciden varchar(3000)  not null,
	texto_resolucion varchar(3000),
	mas_informacion  int(1) not null default 0,
	estado   int(1)
);
create table unaj.resoluciones_incidencias (
id int(11) AUTO_INCREMENT primary key,
	
tipo_id	int not null,
	
area_id int not null,
	
descripcion varchar(3000) not null,
	
resolucion varchar(3000),
	
informacion_adicional int(1) default 0 not null,
	
estado int(1) default 1 not null
);
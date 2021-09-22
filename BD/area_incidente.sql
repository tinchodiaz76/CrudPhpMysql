create table unaj.area_incidente (	
	id int AUTO_INCREMENT primary key,
	tipo_id int,	
	descripcion varchar(3000) not null,
 	estado int(1) not null default 1
);
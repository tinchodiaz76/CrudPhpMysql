create table unaj.incidencias (
	Tipo_id int(1) not null,
	id int(11) AUTO_INCREMENT primary key,
	email varchar(50) not null,
	apellido varchar(50) not null,
	nombre varchar(70) not null,
	dni varchar(12) not null,
	propuesta_codigo varchar(10),
	elemento_codigo  varchar(100),
	id_area int(1),
	tipo_incidencia int(1) not null,
	descrip_incidencia varchar(3000),
	estado int(1) not null,
	fecha_creacion	date not null,
	nota varchar(4000),
	username varchar(20),
	fecha_cerrado date,
	resolucion varchar(3000)
);

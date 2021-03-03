create table ywayqssx_MA.incidencias (


	Tipo_id int(1) not null,
	id int(11) AUTO_INCREMENT primary key,
 
	email varchar(50) not null,
	apellido varchar(50) not null,
	nombre varchar(70) not null,
	dni varchar(12) not null,
	telefono varchar(14),
	Id_area int(1),
	tipo_incidencia int(1) not null,
	descrip_incidencia varchar(3000),
	estado int(1) not null,					//0 Abierta //1 Nota //2 Cerrada
	nota varchar(4000),
	fecha_creacion	date not null,
	username varchar(20),
	fecha_cerrado date,
	resolucion varchar(3000)
);

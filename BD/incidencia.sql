create table ywayqssx_MA.incidencias (


	Tipo_id int(1) not null,
	id int(11) AUTO_INCREMENT primary key,
 
	email varchar(50) not null,
	apellido varchar(50) not null,
	nombre varchar(70) not null,
	dni varchar(12) not null,
	propuesta_codigo varchar2(10),				//codigo de la carrera
	propuesta_descripcion varchar2(200)			//descripcion es la carrera
	elemento_codigo  varchar2(100),				//Codigo de la materia
	elemento_descripcion varchar2(200)			//descripcion de la materia
	telefono varchar(14),
	Id_area int(1),
	tipo_incidencia int(1) not null,
	descrip_incidencia varchar(3000),
	estado int(1) not null,					//0 Abierta //1 Nota //2 Cerrada
	fecha_creacion	date not null,
	username varchar(20),
	fecha_cerrado date,
	resolucion varchar(3000),
	nota varchar(4000)					//se puede ingresar un comentario, sin cerrar el incidente
);

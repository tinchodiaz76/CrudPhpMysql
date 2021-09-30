create table unaj.respuestas_frecuentes (	
	tipo_id  int(1)  not null,
	id_pregunta int(11) not null,
	id_respuesta int(11) AUTO_INCREMENT primary key,
	respuesta varchar(3000) not null,
	link  varchar(3000), 
	orden_aparicion int(3) not null, 
	activo int(1) not null default 1,
	primary key(id_respuesta)
);
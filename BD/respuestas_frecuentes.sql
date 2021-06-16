create table unaj.respuestas_frecuentes (
	
	tipo_id  int(1)  not null,
	id_pregunta int(11) not null,
	respuesta varchar(3000)not null,

	link varchar(3000),

	orden_aparicion int(3) not null, 

	primary key(id_pregunta,respuesta)

);
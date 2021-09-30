create table unaj.preguntas_frecuentes (
	Tipo_id int(1)  not null,     
	id_pregunta int(11)  AUTO_INCREMENT primary key,
	pregunta varchar(3000) not null,
	orden_aparicion int(3) not null	,
	activo int(1) not nulll default 1
);
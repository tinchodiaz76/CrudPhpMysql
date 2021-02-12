create table ywayqssx_MA.preguntas_frecuentes (

	Tipo_id int(11)  not null, 
    
	id_pregunta int(11)  AUTO_INCREMENT primary key,

	pregunta varchar(3000) not null
,
	orden_aparicion int(3)
 not null	
);
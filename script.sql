
create table empresa
(
id_empresa int not null auto_increment,
nombre_empresa varchar(50) not null,
ruc_empresa varchar(11)not null,
url_empresa varchar(50) not null,
correo_empresa varchar(50) not null,
imagen_empresa varchar(50),
PRIMARY KEY (id_empresa)
);

create table categoria
(
id_categoria int not null auto_increment,
nombre_categoria varchar(50) not null,
desc_categoria varchar(100) not null,
imagen_categoria varchar(50),
PRIMARY KEY (id_categoria)
);

create table proyecto
(
id_proyecto int not null auto_increment,
nombre_proyecto varchar(50) not null,
desc_proyecto varchar(100) not null,
fecha_inicio date not null,
fecha_fin date not null,
monto_necesario double not null,
monto_actual double not null,
id_categoria int not null,
imagen_proyecto varchar(50),
PRIMARY KEY (id_proyecto),
FOREIGN KEY (id_categoria) references categoria(id_categoria)
);

create table cliente
(
id_cliente int not null auto_increment,
nombres_cliente varchar(50) not null,
apellidos_cliente varchar(50) not null,
fecha_nacimiento date not null,
correo_cliente varchar (50) not null,
dni_cliente varchar (8) not null,
indicador_cliente bool not null,
fecha_creacion date not null,
token_cliente varchar(200) not null,
imagen_cliente varchar(50) not null,
PRIMARY KEY (id_cliente)
);

create table donacion
(
id_proyecto int not null,
id_empresa int not null,
id_cliente int not null,
id_donacion int not null auto_increment,
importe_donacion double not null,
fecha_donacion datetime not null,
PRIMARY KEY (id_donacion),
FOREIGN KEY (id_proyecto) references proyecto(id_proyecto),
FOREIGN KEY (id_empresa) references empresa(id_empresa),
FOREIGN KEY (id_cliente) references cliente(id_cliente)
);


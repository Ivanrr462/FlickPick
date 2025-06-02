 CREATE DATABASE FlickPick;
 
 USE FlickPick;
 
 CREATE TABLE login (
    usuario VARCHAR(50) NOT NULL,
    contraseña VARCHAR(50) NOT NULL,
    correo VARCHAR(50) NOT NULL,
    hucha int,
    perfil VARCHAR(50),
    PRIMARY KEY (usuario)
 );
 
 CREATE TABLE peliculas (
    id int auto_increment,
    titulo VARCHAR(200) NOT NULL,
    descripcion VARCHAR(600) NOT NULL,
    video VARCHAR(250),
    Año varchar(5),
    trailer VARCHAR(250),
    genero varchar(50),
    autor varchar (50),
    cartel varchar(50),
    baner varchar(50),
    precio_alquilar DECIMAL(5, 2),
    precio_comprar decimal(5,2),
    PRIMARY KEY (id)
 );

 CREATE TABLE codigos(
    codigo varchar(50) NOT NULL,
    valor numeric(3) NOT NULL,
    Primary key (codigo)
 );
 
 CREATE TABLE calificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario varchar(50),
    id_pelicula INT,
    calificacion INT,
    FOREIGN KEY (id_usuario) REFERENCES login(usuario),
    FOREIGN KEY (id_pelicula) REFERENCES peliculas(id)
 );
 
 CREATE TABLE peliculas_adquiridas (
    usuario VARCHAR(50) NOT NULL,
    id_pelicula INT NOT NULL,
    fecha_compra DATE NOT NULL,
    fecha_expiracion DATE,
    modo varchar(2),
    PRIMARY KEY (usuario, id_pelicula),
    FOREIGN KEY (usuario) REFERENCES login(usuario),
    FOREIGN KEY (id_pelicula) REFERENCES peliculas(id)
 );
 
 SET GLOBAL event_scheduler = ON;
 CREATE EVENT IF NOT EXISTS eliminar_peliculas_expiradas
 ON SCHEDULE EVERY 1 DAY
 STARTS NOW()
 DO
 DELETE FROM peliculas_adquiridas
 WHERE fecha_expiracion < CURDATE();
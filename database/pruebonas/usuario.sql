CREATE DATABASE IF NOT EXISTS BD_Usuarios_Escuela_Web;
USE BD_Usuarios_Escuela_Web;

create table usuario(
    nombre VARCHAR(100),
    pass VARCHAR(100)
);

INSERT INTO usuario VALUES(sha1('Ras'), sha1('Acrobacia'));
INSERT INTO usuario VALUES('si', 'si');
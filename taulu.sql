create user harjoitustyoUser@localhost 
    identified by 'tIPOgJc85ThmqgJb';

grant all privileges on kauppalista . * to harjoitustyoUser@localhost;

drop database if exists kauppalista;

create database kauppalista;

use kauppalista;

create table item (
    nro int primary key auto_increment,
    name varchar(20) not null,
    amount int not null
);

INSERT INTO item (name, amount) VALUES ('test', 1);
INSERT INTO item (name, amount) VALUES ('test2', 2);

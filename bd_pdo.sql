create database bd_pdo_sgrh;

use bd_pdo_sgrh;

create table hospede(
id int auto_increment primary key,
nome varchar(100) not null,
email varchar(100),
telefone varchar(20),
data_nascimento DATE);

create table quarto(
id int auto_increment primary key,
numero varchar(10),
tipo varchar(50),
preco decimal(10,2),
status enum('livre', 'ocupado', 'manutencao') default 'livre');

create table reserva(
id int auto_increment primary key,
id_hospede int,
id_quarto int,
checkin date,
checkout date,
status enum('ativa', 'cancelada', 'finalizada') default 'ativa',
foreign key (id_hospede) references hospede(id),
foreign key (id_quarto) references quarto(id));
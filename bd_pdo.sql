create database bd_pdo_sgrh;
use bd_pdo_sgrh;

create table hospede(
idHospede int auto_increment primary key,
nome varchar(100) not null,
email varchar(100),
telefone varchar(20),
data_nascimento DATETIME);

create table quarto(
idQuarto int auto_increment primary key,
numero varchar(10),
tipo varchar(50),
preco decimal(10,2),
status ENUM('livre', 'ocupado', 'manutenção') default 'livre'
);

create table reserva(
idReserva int auto_increment primary key,
id_hospede int,
id_quarto int,
checkin datetime,
checkout datetime,
foreign key (id_hospede) references hospede(idHospede),
foreign key (id_quarto) references quarto(idQuarto));
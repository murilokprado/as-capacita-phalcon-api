create database asdesafio;

use asdesafio;

create table clients ( iClientId int primary key auto_increment, sName varchar(30) not null, sEmail varchar (30));

create table cars (iCarId int primary key auto_increment, iClientId int, sDesc varchar(30) not null, sPlate varchar(10) not null);

alter table cars add constraint fk_Client foreign key (iClientId) REFERENCES clients (IClientId)  ON UPDATE CASCADE ON DELETE CASCADE;	

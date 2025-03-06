DROP DATABASE IF EXISTS MAGIANG;
CREATE DATABASE MAGIANG;
USE MAGIANG;

CREATE TABLE cliente(
   id INT PRIMARY KEY AUTO_INCREMENT,
   email VARCHAR(255),
   nombre_usuario VARCHAR(50)
)ENGINE = InnoDB;


CREATE TABLE productos(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) UNIQUE,
    descripcion VARCHAR(255),
    stock INT,
    precio DECIMAL(10,2),
    tipo ENUM('FISICO','DIGITAL')
)

CREATE TABLE plataformas(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255)
)

CREATE TABLE categorias(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255)
)

CREATE TABLE pro_pla(
    id INT PRIMARY KEY,
    id_plataforma INT,
    FOREIGN KEY (id) REFERENCES productos(id)
)

CREATE TABLE pro_cat(
    id INT PRIMARY KEY,
    id_categoria INT,
    FOREIGN KEY (id) REFERENCES categorias(id)
)
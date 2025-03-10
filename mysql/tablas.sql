DROP DATABASE IF EXISTS MAGIANG;
CREATE DATABASE MAGIANG;
USE MAGIANG;

CREATE TABLE clientes(
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
);

CREATE TABLE plataformas(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255)
);

CREATE TABLE categorias(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255)
);

CREATE TABLE pro_pla(
    id INT PRIMARY KEY,
    id_plataforma INT,
    FOREIGN KEY (id) REFERENCES productos(id),
    FOREIGN KEY (id_plataforma) REFERENCES plataformas(id)
);

CREATE TABLE pro_cat(
    id INT,
    id_categoria INT,
    FOREIGN KEY (id) REFERENCES productos(id),
    FOREIGN KEY (id) REFERENCES categorias(id)
);

CREATE TABLE reseñas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_producto INT,
    estrella INT,
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);

CREATE TABLE carrito(
    id_cliente INT,
    id_producto INT UNIQUE,
    cantidad INT,
    precio_total DECIMAL(10,2),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id),
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);

CREATE TABLE pedidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT,
    nombre VARCHAR(255),
    apellidos VARCHAR(255),
    telefono INT,
    pais VARCHAR(255),
    direccion VARCHAR(255),
    piso_puerta_otro VARCHAR(255),
    codigo_postal INT(5),
    ciudad VARCHAR(100),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id)
);

CREATE TABLE cupones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_producto INT,
    nombre VARCHAR(255),
    codigo VARCHAR(10),
    descuento INT,
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);





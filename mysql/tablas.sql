DROP DATABASE IF EXISTS MAGIANG;
CREATE DATABASE MAGIANG;
USE MAGIANG;

CREATE TABLE cliente(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(15),
    apellido VARCHAR(20),
    usuario VARCHAR(25) UNIQUE,
    contraseña VARCHAR(25) NOT NULL,
    telefono INT(8),
    direccion VARCHAR(255),
    email VARCHAR(255)
)ENGINE = InnoDB;

CREATE TABLE plataforma(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20)
);

CREATE TABLE productos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_plataforma INT,
    precio DECIMAL(10,2),
    producto VARCHAR(255) UNIQUE,
    plataforma VARCHAR(255) UNIQUE,
    stock INT,
    FOREIGN KEY (id_plataforma) REFERENCES plataforma(id)
);

CREATE TABLE promociones(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(255),
    tipo ENUM('NUM','%'),
    descuento INT,
    cupon VARCHAR(10),
    FOREIGN KEY (nombre_producto) REFERENCES productos(producto)
);

CREATE TABLE encargo(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT,
    cantidad INT,
    id_cliente INT,
    FOREIGN KEY(id_producto) REFERENCES productos(id),
    FOREIGN KEY (id_cliente) REFERENCES cliente(id)
);

CREATE TABLE pedido(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_encargo INT,
    import DECIMAL(10,2),
    FOREIGN KEY (id_encargo) REFERENCES encargo(id)
);

CREATE TABLE pago(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    tipo VARCHAR(255) UNIQUE,
    fecha DATETIME,
    total DECIMAL(10,2),
    FOREIGN KEY (id_pedido) REFERENCES pedido(id)
);




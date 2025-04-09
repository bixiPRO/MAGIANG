DROP DATABASE IF EXISTS MAGIANG;
CREATE DATABASE MAGIANG;
USE MAGIANG;

CREATE TABLE clientes(
   id INT PRIMARY KEY AUTO_INCREMENT,
   email VARCHAR(255),
   nombre_usuario VARCHAR(50),
   contrasenya VARCHAR(255)
)ENGINE = InnoDB;


CREATE TABLE productos(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) UNIQUE,
    descripcion VARCHAR(255),
    stock INT,
    precio DECIMAL(10,2),
    tipo ENUM('FISICO','DIGITAL'),
    imagen VARCHAR(255),
    introduccio DATE DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE digital(
    id_producto INT,
    nombre VARCHAR(255),
    codigo VARCHAR(30),
    FOREIGN KEY (id_producto) REFERENCES productos(id)
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
    descuento INT DEFAULT 0,
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);

CREATE TABLE carrito(
    id_cliente INT,
    id_producto INT UNIQUE,
    id_cupones INT UNIQUE DEFAULT NULL,
    cantidad INT,
    precio_total DECIMAL(10,2),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id),
    FOREIGN KEY (id_producto) REFERENCES productos(id),
    FOREIGN KEY (id_cupones) REFERENCES cupones(id)
);


CREATE TABLE pago (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_pedido INT,
    metodo_pago ENUM("VISA/MASTERCARD","PAYPAL","VIZUM"),
    data_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id)
);

CREATE TABLE visa_mastercard (
    id_pago INT,
    num_tarjeta VARCHAR(255),
    fecha_cad VARCHAR(10),
    cod_seg INT(3),
    nombre_titular VARCHAR(255),
    FOREIGN KEY (id_pago) REFERENCES pago(id)
);

CREATE TABLE paypal (
    id_pago INT,
    email VARCHAR(255),
    contrasenya VARCHAR(255),
    FOREIGN KEY (id_pago) REFERENCES pago(id)
);

CREATE TABLE bizum (
    id_pago INT,
    telefono INT,
    FOREIGN KEY (id_pago) REFERENCES pago(id)
);



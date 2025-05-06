CREATE TABLE temp_productos (
    nombre VARCHAR(255),
    descripcion VARCHAR(255),
    tipo ENUM('FISICO', 'DIGITAL'),
    precio DECIMAL(10,2),
    stock INT DEFAULT 0,
    categoria VARCHAR(255),
    plataforma VARCHAR(255)
);

LOAD DATA INFILE '~/Documents/MAGIANG/mysql/productos_informaticos.csv' 
INTO TEMPORARY TABLE temp_productos
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"' 
LINES TERMINATED BY '\n'
(nombre, descripcion, tipo, precio, stock, categoria, plataforma);

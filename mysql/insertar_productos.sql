DROP TABLE IF EXISTS temp_productos;
CREATE TABLE temp_productos (
    nombre VARCHAR(255),
    descripcion VARCHAR(255),
    tipo ENUM('FISICO', 'DIGITAL'),
    precio DECIMAL(10,2),
    stock INT DEFAULT 0,
    categoria VARCHAR(255),
    plataforma VARCHAR(255)
);

"Mover el arxivo sudo cp .csv a /tmp para poder hacer load data sino te pide permisos, si das los permisos se borra la relacion del fichero con el .git y no podras hacer commits /home/admimvm/Documents/MAGIANG/mysql/productos_informaticos.csv /tmp/"
LOAD DATA INFILE '/tmp/productos_informaticos.csv' 
INTO TABLE temp_productos
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"' 
LINES TERMINATED BY '\n'
(nombre, descripcion, tipo, precio, stock, categoria, plataforma);

INSERT INTO productos (nombre, descripcion, tipo, precio, stock)
SELECT nombre, descripcion, tipo, precio, stock
FROM temp_productos;

INSERT INTO plataformas (nombre)
SELECT DISTINCT plataforma
FROM temp_productos
WHERE plataforma IS NOT NULL;
 
INSERT INTO categorias (nombre)
SELECT DISTINCT categoria
FROM temp_productos
WHERE categoria IS NOT NULL;


INSERT INTO pro_pla (id, id_plataforma)
SELECT p.id, pl.id
FROM productos p
JOIN plataformas pl ON p.plataforma = pl.nombre;

INSERT INTO pro_cat (id, id_categoria)
SELECT p.id, c.id
FROM productos p
JOIN categorias c ON p.categoria = c.nombre;

DROP TABLE temp_productos;


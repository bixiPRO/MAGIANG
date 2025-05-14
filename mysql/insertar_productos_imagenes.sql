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

/* Mover el arxivo sudo cp .csv a /tmp para poder hacer load data sino te pide permisos, si das los permisos se borra la relacion del fichero con el .git y no podras hacer commits /home/admimvm/Documents/MAGIANG/mysql/productos_informaticos.csv /tmp/ 
dar permisos de fichero 

sudo chmod 644 /tmp/productos_informaticos.csv
sudo chown mysql:mysql /tmp/productos_informaticos.csv
*/
LOAD DATA INFILE '/tmp/productos_informaticos.csv' 
INTO TABLE temp_productos
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"' 
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(nombre, descripcion, tipo, precio, stock, categoria, plataforma);

INSERT INTO productos (nombre, descripcion, tipo, precio, stock)
SELECT nombre, descripcion, TRIM(tipo), precio, stock
FROM temp_productos;

INSERT INTO plataformas (nombre)
SELECT DISTINCT TRIM(plataforma)
FROM temp_productos
WHERE plataforma IS NOT NULL AND TRIM(plataforma) != '';
 
INSERT INTO categorias (nombre)
SELECT DISTINCT TRIM(categoria)
FROM temp_productos
WHERE categoria IS NOT NULL AND TRIM(categoria) != '';

INSERT INTO pro_pla (id, id_plataforma)
SELECT p.id, pl.id
FROM temp_productos t
JOIN productos p ON t.nombre = p.nombre
JOIN plataformas pl ON t.plataforma = pl.nombre
WHERE t.plataforma IS NOT NULL;

INSERT INTO pro_cat (id, id_categoria)
SELECT p.id, c.id
FROM temp_productos t
JOIN productos p ON t.nombre = p.nombre
JOIN categorias c ON t.categoria = c.nombre
WHERE t.categoria IS NOT NULL;

DROP TABLE temp_productos;


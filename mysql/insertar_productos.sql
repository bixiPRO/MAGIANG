LOAD DATA INFILE '~/Documents/MAGIANG/mysql/productos_informaticos.csv' 
INTO TABLE productos
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"' 
LINES TERMINATED BY '\n'
(nombre, descripcion, tipo, precio, stock);
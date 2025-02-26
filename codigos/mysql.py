#import pymysql
import cupones 
import codigos

nom_host = 'localhost'
usuari = 'root'
contrasenya = '12'
bd_nom = 'MAGIANG'

def main():
    opciones()


def opciones():
    eleccio = input('''Elige uno de los dos opciones:
                  1. Inserir codigo
                  2. Inserir Cupones
                  ''')
    if not eleccio.isnumeric() or int(eleccio) not in [1, 2]:
        error()
    else:
        eleccio = int(eleccio)
        if eleccio == 1:
            inserir_codigo()
        else:
            inserir_cupones()

def error():
    print('Vuelve a introduir un numero válido.')
    opciones() 

def inserir_codigo():
    
    print(nom_host,usuari,contrasenya,bd_nom)
    realizar_connecion = pymysql.connect(host=nom_host, 
                           user=usuari, 
                           passwd=contrasenya, 
                           database=bd_nom)
    cur = realizar_connecion.cursor()
    cur.execute("SHOW TABLES;")
    filas = cur.fetchall()
    print("Tablas en la base de datos:")
    for tabla in filas:
        print(tabla)
    realizar_connecion.commit()
    realizar_connecion.close()


def inserir_cupones():
    nombre_cupon=cupones.usuari()

    if nombre_cupon is None:
        prova=cupones.usuari()
        pass
    else:
        nombre=nombre_cupon[0]
        codigo=nombre_cupon[1]
        print(nombre,codigo)
    
    realizar_connecion = pymysql.connect(host=nom_host, 
                           user=usuari, 
                           passwd=contrasenya, 
                           database=bd_nom)
    cur = realizar_connecion.cursor()
    for i in range(len(nombre)):
        prova.append(nombre[i])
        prova.append(codigo[i])
    
        cur.execute(f"INSERT INTO cupones VALUES ('{nombre[i]}','{codigo[i]}');")
    
    realizar_connecion.commit()
    realizar_connecion.close()


main()
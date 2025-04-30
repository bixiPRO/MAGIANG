import pymysql
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
    nombre_producto,codigos_generados = codigos.main()

    print(nom_host,usuari,contrasenya,bd_nom)
    realizar_connecion = pymysql.connect(host=nom_host, 
                           user=usuari, 
                           passwd=contrasenya, 
                           database=bd_nom)
    cur = realizar_connecion.cursor()
    cur.execute(f"INSERT INTO productos(nombre,tipo) VALUES ('{nombre_producto}','DIGITAL');")
    for codigo in codigos_generados:
        cur.execute(f"INSERT INTO digital(nombre,codigo) VALUES ('{nombre_producto}','{codigo}');")
        cur.execute(f"UPDATE digital d JOIN productos p SET d.id_producto=p.id WHERE p.tipo='DIGITAL' and p.nombre='{nombre_producto}' and d.nombre='{nombre_producto}';")


    
    realizar_connecion.commit()
    realizar_connecion.close()


def inserir_cupones():
    nombre_cupon=cupones.usuari()

    if nombre_cupon is None:
        print("Torna a executar el programa")
    else:
        nombre=nombre_cupon[0]
        codigo=nombre_cupon[1]
    
        realizar_connecion = pymysql.connect(host=nom_host, 
                            user=usuari, 
                            passwd=contrasenya, 
                            database=bd_nom)
        cur = realizar_connecion.cursor()
        
        for i in range(len(nombre)):
            cur.execute(f"INSERT INTO cupones(nombre,codigo) VALUES ('{nombre[i]}','{codigo[i]}');")
        
        realizar_connecion.commit()
        realizar_connecion.close()


main()
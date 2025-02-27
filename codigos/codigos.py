import random
import string 

numeros=['1','2','3','4','5','6','7','8','9','0']

alfabeto = list(string.ascii_uppercase)

def main():
    nombre_producto, codigos_generados = producto()
    print(nombre_producto,codigos_generados)
    return nombre_producto,codigos_generados

    

def numeros_letras():
    numero_letras_juntas=[]

    for i in numeros:
        numero_letras_juntas.append(i)
    
    for a in alfabeto:
        numero_letras_juntas.append(a)
    
    return numero_letras_juntas


def ps4():
    letras=numeros_letras()
    codigo=[]
    codigo_texto= ""
    for a in range(12):
        aleatorio=random.choice(letras)
        codigo.append(aleatorio)
    codigo_texto = ''.join(codigo)
    print(codigo_texto)
    return codigo_texto
 

def tarjeta_regalo():
    letras=numeros_letras()
    codigo=[]
    codigo_texto= ""
    for a in range(16):
        aleatorio=random.choice(letras)
        codigo.append(aleatorio)
    codigo_texto = ''.join(codigo)
    print(codigo_texto)
    return codigo_texto

def licencia_windows():
    letras=numeros_letras()
    codigo=[]
    codigo_texto= ""
    for a in range(25):
        aleatorio=random.choice(letras)
        codigo.append(aleatorio)
    codigo_texto = ''.join(codigo)
    print(codigo_texto)
    return codigo_texto

def xbox():
    letras=numeros_letras()
    codigo=[]
    codigo_texto= ""
    for a in range(25):
        aleatorio=random.choice(letras)
        codigo.append(aleatorio)
    codigo_texto = ''.join(codigo)
    print(codigo_texto)
    return codigo_texto

def steam_keys():
    letras=numeros_letras()
    codigo=[]
    codigo_texto= ""
    for a in range(15):
        aleatorio=random.choice(letras)
        codigo.append(aleatorio)
    codigo_texto = ''.join(codigo)
    print(codigo_texto)
    return codigo_texto

def switch():
    letras=numeros_letras()
    codigo=[]
    codigo_texto= ""
    for a in range(16):
        aleatorio=random.choice(letras)
        codigo.append(aleatorio)
    codigo_texto = ''.join(codigo)
    print(codigo_texto)
    return codigo_texto


def producto():
    nombre_producto=""
    nombre_producto=input("Introduce el nombre del producto: ")

    numero_cod=''
    numero_cod=input("Introduce el numero de codigo que quieres implementar: ")

    print("""Elige entre estas opciones los codigo que quieras generar
          1. Playstation
          2. Tarjeta de Regalo (Apple, Google Play)
          3. Licencia de Windows
          4. Xbox
          5. Switch
          6. Juegos de Steam
          """)
    eleccion=input()

    if numero_cod.isnumeric() == False:
        error()
    elif eleccion.isnumeric() == False:
        error()
    elif int(eleccion) not in range(1,6):
        error()
    else:
        numero_cod=int(numero_cod)
        eleccion=int(eleccion)
        respuestas = introduccion_codigo(numero_cod, eleccion)

    return nombre_producto, respuestas
   

def error():
    print("La seleccion no ha sido valida\n")
    producto()

def introduccion_codigo(numero_cod,eleccion):
    respuestas=[]
    if eleccion==1:
        for i in range (numero_cod):
            respuestas.append(ps4())
    elif eleccion==2:
        for i in range (numero_cod):
            respuestas.append(tarjeta_regalo())
    elif eleccion==3:
        for i in range (numero_cod):
            respuestas.append(licencia_windows())
    elif eleccion==4:
        for i in range (numero_cod):
            respuestas.append(xbox())
    elif eleccion==5:
        for i in range (numero_cod):
            respuestas.append(switch())
    else:
        for i in range (numero_cod):
            respuestas.append(steam_keys)
    return respuestas

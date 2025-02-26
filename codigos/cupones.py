import random
import string 

numeros=['1','2','3','4','5','6','7','8','9','0']

alfabeto = list(string.ascii_uppercase)


def numeros_letras():
    numero_letras_juntas=[]

    for i in numeros:
        numero_letras_juntas.append(i)
    
    for a in alfabeto:
        numero_letras_juntas.append(a)
    
    return numero_letras_juntas

def cupon():
    letras=numeros_letras()
    codigo=[]
    codigo_texto= ""
    for a in range(10):
        aleatorio=random.choice(letras)
        codigo.append(aleatorio)
    codigo_texto = ''.join(codigo)
    return codigo_texto
 
def usuari():
    nombres_de_cupones=[]
    codigo_cupones=[]
    nombres_de_cupones.clear()
    codigo_cupones.clear()
    numero_cod=input("Introduce el numeros de cupon que quieres implementar: ")
    if numero_cod.isnumeric() == False:
        print("Introduiex un numero si us plau\n")
    else:
        numero_cod=int(numero_cod)
        for i in range (numero_cod):
            nombre_producto=input("Introduce el nombre del cupon: ")
            codigo_cupon=cupon()
            nombres_de_cupones.append(nombre_producto)
            codigo_cupones.append(codigo_cupon)
        print('\nMuestra de nombre y codigo de cupon generada\n')
        for i in range (len(nombres_de_cupones)):
            print(nombres_de_cupones[i],':',codigo_cupones[i])
        return nombres_de_cupones,codigo_cupones


def main():
    usuari()
    




    

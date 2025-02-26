import codigos.cupones as cupones

contador=0
nombre_cupon=cupones.usuari()

if nombre_cupon is None:
    prova=cupones.usuari()
    print(prova)
else:
    nombre=nombre_cupon[0]
    codigo=nombre_cupon[1]
    print(nombre,codigo)

print("Funciona")
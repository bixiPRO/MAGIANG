import cupones

contador=0
nombre_cupon=cupones.usuari()

if nombre_cupon is None:
    prova=cupones.usuari()
    pass
else:
    prova=[]
    nombre=nombre_cupon[0]
    codigo=nombre_cupon[1]
    for i in range(len(nombre)):
        print(f"INSERT INTO cupones VALUES ('{nombre[i]}','{codigo[i]}');")
    
   




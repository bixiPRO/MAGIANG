import codigos

codigos_generados = codigos.main()

for codigo in codigos_generados:
        print(f"INSERT INTO codigos(nombre_producto, codigo) VALUES ('{nombre_producto}', '{codigo}');")

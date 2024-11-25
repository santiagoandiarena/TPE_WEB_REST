Integrantes: Santiago Andiarena y Fabian Romero

Endpoints:
    -Obtener todas las prendas: https://localhost/web2/TPE_WEB_REST/api/prendas (metodo GET)

    -Obtener una prenda por id: https://localhost/web2/TPE_WEB_REST/api/prendas/3 (metodo GET)

    -Crear una prenda: https://localhost/web2/TPE_WEB_REST/api/prendas (metodo POST)
        -JSON:
            {
                "nombre": "Campera gris agregada",
                "valor": 625000,
                "descripcion": "Campera gris con capucha agregada",
                "categoria": "campera",
                "imagen": "https://NuevaURL.Agregada"
            }

    -Eliminar una prenda por id: https://localhost/web2/TPE_WEB_REST/api/prendas/5 (metodo DELETE)

    -Editar una prenda por id: https://localhost/web2/TPE_WEB_REST/api/prendas/2 (metodo PUT)
        -JSON:
            {
                "nombre": "Edicion de la prenda remera",
                "valor": 75000,
                "descripcion": "Edicion descripcion de la prenda remera",
                "categoria": "remera",
                "imagen": "https://NuevaURL.Editada"
            }
    
    -Filtrar prendas por categoria: https://localhost/web2/TPE_WEB_REST/api/prendas?categoria=remera (metodo GET)

    -Ordenar por cualquier campo: (metodo GET)
        -https://localhost/web2/TPE_WEB_REST/api/prendas?ordenarPor=nombre
        -https://localhost/web2/TPE_WEB_REST/api/prendas?ordenarPor=valor
        -https://localhost/web2/TPE_WEB_REST/api/prendas?ordenarPor=ID_categoria
        -https://localhost/web2/TPE_WEB_REST/api/prendas?ordenarPor=descripcion

        -Por defecto se ordenan ascendentemente, si quiero ordenar descendentemente:
            -https://localhost/web2/TPE_WEB_REST/api/prendas?ordenarPor=valor&orden=DESC

    -Obtener Token:
        -https://localhost/web2/TPE_WEB_REST/api/usuario/token (metodo GET)
        -Auth => basic 
            -username: webadmin
            -password: admin
        -Tiempo de vida del token: 5 minutos
    
    -Paginado: https://localhost/web2/TPE_WEB_REST/api/prendas?_limit=3&_page=1
        -limite prendas predeterminado: 3


     
<?php
    
    require_once 'libs/router.php';

    require_once 'app/controllers/ropa.api.controller.php';
    $router = new Router();


    #                 endpoint                    verbo       controller              metodo
    $router->addRoute('prendas'      ,            'GET',     'RopaApiController',   'obtenerTodas');
    $router->addRoute('prendas/:id'  ,            'GET',     'RopaApiController',   'obtener');
    $router->addRoute('prendas/:id'  ,            'DELETE',  'RopaApiController',   'eliminar');
    $router->addRoute('prendas'  ,                'POST',    'RopaApiController',   'agregar');
    $router->addRoute('prendas/:id'  ,            'PUT',     'RopaApiController',   'editar');
    
    // $router->addRoute('usuarios/token'    ,            'GET',     'UsuarioApiController',   'getToken');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
 
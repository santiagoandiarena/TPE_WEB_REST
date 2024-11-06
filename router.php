<?php
    
    require_once 'libs/router.php';

    require_once 'app/controllers/ropa.api.controller.php';
    //require_once 'app/controllers/usuario.api.controller.php';
    //require_once 'app/middlewares/jwt.auth.middleware.php';
    $router = new Router();

    //$router->addMiddleware(new JWTAuthMiddleware());

    #                 endpoint                    verbo       controller              metodo
    $router->addRoute('prendas'      ,            'GET',     'RopaApiController',   'obtenerTodas');
    $router->addRoute('prendas/:id'  ,            'GET',     'RopaApiController',   'obtener');
    $router->addRoute('prendas/:id'  ,            'DELETE',  'RopaApiController',   'eliminar');
    $router->addRoute('prendas'  ,                'POST',    'RopaApiController',   'agregar');
    $router->addRoute('prendas/:id'  ,            'PUT',     'RopaApiController',   'editar');
    
    // $router->addRoute('usuarios/token'    ,            'GET',     'UsuarioApiController',   'getToken');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
 
<?php
require_once 'app/views/json.view.php';
require_once 'app/models/usuario.model.php';
require_once 'libs/jwt.php';
class UserApiController
{

    private $model;
    private $view;
    function __construct()
    {

        $this->model = new UsuarioModel();
        $this->view = new JSONView();
    }

    function obtenerToken()
    {


        // obtengo el usuario (webadmin) y la contraseña desde el header (admin)
        $auth_header = $_SERVER['HTTP_AUTHORIZATION'];
        $auth_header = explode(' ', $auth_header);
        if (count($auth_header) != 2) {
            return $this->view->response("Error en los datos ingresados", 400);
        }
        if ($auth_header[0] != 'Basic') {
            return $this->view->response("Error en los datos ingresados", 400);
        }





        $user_pass = base64_decode($auth_header[1]); // "usuario:contraseña"
        $user_pass = explode(':', $user_pass); // ["usuario", "constraseña"]



        $usuario = $this->model->obtenerUsuarioPorNombre($user_pass[0]);

        if ($usuario == null || !password_verify($user_pass[1], $usuario->contraseña)) {
            return $this->view->response("Error en los datos ingresados", 400);
        }

        //generoo el token 



        $token = createJWT(array(
            'sub' => $usuario->ID_usuario,
            'nombreUsuario' => $usuario->nombreUsuario,
            'role' => 'admin',
            'iat' => time(),
            'exp' => time() + 350,
            'Saludo' => 'Hola',
        ));
        return $this->view->response($token);
    }

}







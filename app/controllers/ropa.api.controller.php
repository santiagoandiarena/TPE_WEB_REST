<?php
require_once './app/models/ropa.model.php';
require_once './app/views/json.view.php';

class RopaApiController
{
    private $model;
    private $view;
    private $modelCategoria;

    public function __construct()
    {
        $this->model = new RopaModel();
        $this->view = new JsonView();
        //$this->modelCategoria = new obtenercategorias();
    }



    public function obtenerTodas($req, $res)
    {
        $ordenarPor = $req->query->ordenarPor ?? false;

        $categoria = $req->query->categoria ?? null;
        $filtrarCategoria = null;

        if ($categoria) {
            $filtrarCategoria = $this->model->obtenerIdCategoriaPorNombre($categoria);
            if (!$filtrarCategoria) {
                return $this->view->response("La categoría especificada no existe", 400);
            }
        }

        $prendas = $this->model->obtenerPrendas($ordenarPor, $filtrarCategoria);
        $this->view->response($prendas);
    }




    public function obtener($req, $res)
    {
        $id = $req->params->id;

        $prenda = $this->model->obtenerPrenda($id); // devuelve una única prenda

        if (!$prenda) {
            return  $this->view->response('No existe la prenda', 404);
        }

        //$categorias = $this->modelCategoria->obtenercategorias();

        $this->view->response($prenda); //, $categorias); // Pasa la primera (y única) prenda
    }


    public function eliminar($req, $res)
    {
        $id = $req->params->id;

        $prenda = $this->model->obtenerPrenda($id);

        if (!$prenda) {
            return $this->view->response("No existe la prenda", 404);
        }

        $this->model->eliminarPrenda($id);

        return $this->view->response("la tarea se elimino con exito");
    }




    public function agregar($req, $res)
    {
        $nombre = $req->body->nombre;
        $valor = $req->body->valor;
        $descripcion = $req->body->descripcion;
        $categoriaNombre = $req->body->categoria; // Nombre de la categoría
        $imagen = $req->body->imagen;

        if (empty($nombre) || empty($valor) || empty($descripcion) || empty($categoriaNombre) || empty($imagen)) {
            return $this->view->response("Faltan completar datos", 400);
        }

        // Obtener el ID de la categoría a partir de su nombre
        $ID_categoria = $this->model->obtenerIdCategoriaPorNombre($categoriaNombre);
        if (!$ID_categoria) {
            return $this->view->response("La categoría especificada no existe", 400);
        }

        $id = $this->model->agregararticulo($nombre, $valor, $descripcion, $ID_categoria, $imagen);

        if (!$id) {
            return $this->view->response("Error al agregar la prenda", 500);
        }

        $prenda = $this->model->obtenerPrenda($id);
        return $this->view->response($prenda, 201);
    }




    public function editar($req, $res)
    {
        $id = $req->params->id;

        $prenda = $this->model->obtenerPrenda($id);

        if (!$prenda) {
            return $this->view->response("No existe la prenda", 404);
        }

        $nombre = $req->body->nombre;
        $valor = $req->body->valor;
        $descripcion = $req->body->descripcion;
        $categoriaNombre = $req->body->categoria; // Nombre de la categoría
        $imagen = $req->body->imagen;

        if (empty($nombre) || empty($valor) || empty($descripcion) || empty($categoriaNombre) || empty($imagen)) {
            return $this->view->response("Faltan completar datos", 400);
        }

        // Obtener el ID de la categoría a partir de su nombre
        $ID_categoria = $this->model->obtenerIdCategoriaPorNombre($categoriaNombre);
        if (!$ID_categoria) {
            return $this->view->response("La categoría especificada no existe", 400);
        }

        $this->model->editarArticulo($nombre, $valor, $descripcion, $ID_categoria, $imagen, $id);

        $prenda = $this->model->obtenerPrenda($id);
        return $this->view->response($prenda, 200);
    }
}

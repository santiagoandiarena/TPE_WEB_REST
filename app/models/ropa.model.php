<?php

class RopaModel
{
    private $db;
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=g84_db_tiendaropa;charset=utf8', 'root', '');
    }


    //METODOS

    public function obtenerPrendas($ordenarPor = false, $filtrarCategoria = false)
    {
        $sql = 'SELECT articulo.*, categoria.nombre AS categoria_nombre FROM articulo JOIN categoria ON articulo.ID_categoria = categoria.ID_categoria';

        if ($filtrarCategoria) {
            $sql .= ' WHERE articulo.ID_categoria = ' . intval($filtrarCategoria);
        }

        if ($ordenarPor) {
            switch ($ordenarPor) {
                case 'nombre':
                    $sql .= ' ORDER BY nombre';
                    break;
                case 'valor':
                    $sql .= ' ORDER BY valor';
                    break;
                case 'descripcion':
                    $sql .= ' ORDER BY descripcion';
                    break;
                case 'ID_categoria':
                    $sql .= ' ORDER BY ID_categoria';
                    break;
                case 'imagen':
                    $sql .= ' ORDER BY imagen';
                    break;
            }
        }

        $query = $this->db->prepare($sql);
        $query->execute();

        $prendas = $query->fetchAll(PDO::FETCH_OBJ);

        return $prendas;
    }

    //funcion para verificar que la categoria ingresada exista
    public function existeCategoria($ID_categoria)
    {
        $query = $this->db->prepare('SELECT COUNT(*) FROM categoria WHERE ID_categoria = ?');
        $query->execute([$ID_categoria]);
        return $query->fetchColumn() > 0;
    }




    public function obtenerPrenda($id)
    {
        $query = $this->db->prepare('
        SELECT articulo.*, categoria.nombre AS categoria_nombre 
        FROM articulo 
        JOIN categoria ON articulo.ID_categoria = categoria.ID_categoria 
        WHERE ID_articulo = ?
    ');
        $query->execute([$id]);

        $prenda = $query->fetch(PDO::FETCH_OBJ);

        return $prenda;
    }


    public function eliminarPrenda($id)
    {
        $query = $this->db->prepare('DELETE FROM articulo WHERE ID_articulo = ?');
        $query->execute([$id]);
    }

    function agregararticulo($nombre, $valor, $descripcion, $id, $imagen)
    {
        $query = $this->db->prepare('INSERT INTO articulo (nombre, valor, descripcion, ID_categoria, imagen) VALUES (?,?, ?, ?, ?)');
        $query->execute([$nombre, $valor, $descripcion, $id, $imagen]);

        return $this->db->lastInsertId();
    }

    public function editarArticulo($nombre, $valor, $descripcion, $id_categoria, $imagen, $id)
    {
        $query = $this->db->prepare("UPDATE articulo SET nombre = ?, valor = ?, descripcion = ?, ID_categoria = ? , Imagen = ? WHERE ID_articulo = ?");
        $query->execute([$nombre, $valor, $descripcion, $id_categoria, $imagen, $id]);
    }
}

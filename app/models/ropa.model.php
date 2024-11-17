<?php

class RopaModel
{
    private $db;
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=g84_db_tiendaropa;charset=utf8', 'root', '');
    }


    //METODOS

    public function obtenerPrendas($ordenarPor = false, $filtrarCategoria = false, $paginas, $limite, $orden = 'ASC')
    {
        $inicio = ($paginas - 1) * $limite; // inicia la página
        $sql = "SELECT articulo.*, categoria.nombre AS categoria_nombre 
            FROM articulo 
            JOIN categoria ON articulo.ID_categoria = categoria.ID_categoria";

        if ($filtrarCategoria) {
            $sql .= ' WHERE articulo.ID_categoria = ' . intval($filtrarCategoria);
        }

        // Aplicar orden si está definido
        if ($ordenarPor) {
            $orden = strtoupper($orden); // Convertir a mayúsculas para prevenir errores
            if (!in_array($orden, ['ASC', 'DESC'])) {
                $orden = 'ASC'; // Valor predeterminado
            }
            $sql .= " ORDER BY articulo.$ordenarPor $orden";
        }

        // Agregar LIMIT al final
        $sql .= " LIMIT $inicio, $limite";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }



    public function obtenerIdCategoriaPorNombre($nombreCategoria)
    {
        $query = $this->db->prepare('SELECT ID_categoria FROM categoria WHERE nombre = ?');
        $query->execute([$nombreCategoria]);
        return $query->fetchColumn(); // Retorna el ID_categoria si existe, o `false` si no
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

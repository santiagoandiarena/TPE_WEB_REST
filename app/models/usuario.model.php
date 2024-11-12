<?php



class UsuarioModel  {
    private $db;
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=g84_db_tiendaropa;charset=utf8', 'root', '');
     }
 
    public function obtenerUsuarioPorNombre($nombreUsuario) {    

        
        $query = $this->db->prepare("SELECT * FROM usuario WHERE nombreUsuario = ?");
        $query->execute([$nombreUsuario]);
    
        $usuario = $query->fetch(PDO::FETCH_OBJ);
       
    
        return $usuario;
    }
}
<?php
/**
 * contains properties and methods for "category" database queries.
 */

class Moderador
{
    //db conn and table
    private $conn;
    private $table_name = "tb_moderado_articulos";
    private $table_name2 = "tb_moderado_articulos";

    //object properties
    public $id_moderado;
    public $fk_id_articulo;
    public $estado_moderacion;
    public $fk_id_comentario;
    public $fk_id_usuario;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function publicArticulo(){
        $query = "UPDATE tb_moderado_articulos SET estado_moderacion=1 WHERE fk_id_articulo=?;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->fk_id_articulo=htmlspecialchars(strip_tags($this->fk_id_articulo));
        //bind
        $stmt->bindParam(1, $this->fk_id_articulo);
        //execute
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getModeration(){
        $query = "SELECT * FROM tb_moderado_articulos m LEFT OUTER JOIN tb_articulos a ON m.fk_id_articulo = a.id_articulo WHERE m.estado_moderacion=0;";
        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        if ($stmt->execute()) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function logUsuario(){
        $query = "INSERT INTO tb_moderador_usuario VALUES(0,?,NOW());";
        //prepare
        $stmt = $this->conn->prepare($query);
        //sanitize
        $this->fk_id_usuario=htmlspecialchars(strip_tags($this->fk_id_usuario));
        //bind
        $stmt->bindParam(1, $this->fk_id_usuario);
        //execute
        if ($stmt->execute()) {
            return $stmt;
        } else {
            return false;
        } 
    }

}
